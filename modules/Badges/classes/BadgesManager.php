<?php

class BadgesManager
{
    private const IMAGE_DIRECTORY = 'uploads/badges/';
    private const ALLOWED_EXTENSIONS = ['png', 'jpg', 'jpeg', 'gif', 'webp', 'svg'];

    public static function ensureTables(): void
    {
        $db = DB::getInstance();

        if (!$db->showTables('badges')) {
            $db->createTable('badges', "
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `name` varchar(64) NOT NULL,
                `description` mediumtext,
                `image` varchar(255) DEFAULT NULL,
                `icon` varchar(128) DEFAULT NULL,
                `colour` varchar(16) DEFAULT NULL,
                `display_order` int(11) NOT NULL DEFAULT 0,
                `enabled` tinyint(1) NOT NULL DEFAULT 1,
                `created_at` int(11) NOT NULL,
                `updated_at` int(11) NOT NULL,
                PRIMARY KEY (`id`)
            ");
        }

        if (!$db->showTables('users_badges')) {
            $db->createTable('users_badges', "
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `user_id` int(11) NOT NULL,
                `badge_id` int(11) NOT NULL,
                `awarded_at` int(11) NOT NULL,
                `awarded_by` int(11) DEFAULT NULL,
                `note` varchar(255) DEFAULT NULL,
                PRIMARY KEY (`id`),
                UNIQUE KEY `user_badge` (`user_id`, `badge_id`),
                KEY `user_id` (`user_id`),
                KEY `badge_id` (`badge_id`)
            ");
        }

        $upload_path = ROOT_PATH . '/' . self::IMAGE_DIRECTORY;
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0755, true);
        }
    }

    public static function getAll(bool $include_disabled = true): array
    {
        self::ensureTables();

        if ($include_disabled) {
            return DB::getInstance()->query('
                SELECT *
                FROM nl2_badges
                ORDER BY display_order ASC, name ASC
            ')->results();
        }

        return DB::getInstance()->query('
            SELECT *
            FROM nl2_badges
            WHERE enabled = 1
            ORDER BY display_order ASC, name ASC
        ')->results();
    }

    public static function getById(int $id): ?object
    {
        self::ensureTables();
        return DB::getInstance()->get('badges', $id)->first();
    }

    public static function getUserBadges(int $user_id): array
    {
        self::ensureTables();

        $badges = DB::getInstance()->query('
            SELECT b.*, ub.awarded_at, ub.awarded_by, ub.note
            FROM nl2_users_badges ub
            INNER JOIN nl2_badges b ON b.id = ub.badge_id
            WHERE ub.user_id = ? AND b.enabled = 1
            ORDER BY b.display_order ASC, b.name ASC
        ', [$user_id])->results();

        return array_map([self::class, 'formatBadge'], $badges);
    }

    public static function getPanelUserBadges(int $user_id): array
    {
        self::ensureTables();

        return DB::getInstance()->query('
            SELECT b.*, ub.awarded_at, ub.note
            FROM nl2_users_badges ub
            INNER JOIN nl2_badges b ON b.id = ub.badge_id
            WHERE ub.user_id = ?
            ORDER BY b.display_order ASC, b.name ASC
        ', [$user_id])->results();
    }

    public static function create(array $data, ?array $file = null): bool
    {
        self::ensureTables();
        $now = time();

        return DB::getInstance()->insert('badges', [
            'name' => $data['name'],
            'description' => $data['description'],
            'image' => self::uploadImage($file),
            'icon' => $data['icon'],
            'colour' => $data['colour'],
            'display_order' => $data['display_order'],
            'enabled' => $data['enabled'],
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }

    public static function update(int $id, array $data, ?array $file = null): bool
    {
        self::ensureTables();

        $fields = [
            'name' => $data['name'],
            'description' => $data['description'],
            'icon' => $data['icon'],
            'colour' => $data['colour'],
            'display_order' => $data['display_order'],
            'enabled' => $data['enabled'],
            'updated_at' => time(),
        ];

        $image = self::uploadImage($file);
        if ($image !== null) {
            $fields['image'] = $image;
        }

        return DB::getInstance()->update('badges', $id, $fields);
    }

    public static function delete(int $id): void
    {
        self::ensureTables();
        DB::getInstance()->delete('users_badges', ['badge_id', $id]);
        DB::getInstance()->delete('badges', $id);
    }

    public static function assign(int $user_id, int $badge_id, int $awarded_by, string $note = ''): void
    {
        self::ensureTables();

        if (!self::getById($badge_id)) {
            return;
        }

        $exists = DB::getInstance()->get('users_badges', [
            ['user_id', $user_id],
            ['badge_id', $badge_id],
        ])->exists();

        if ($exists) {
            DB::getInstance()->update('users_badges', [
                ['user_id', $user_id],
                ['badge_id', $badge_id],
            ], [
                'note' => $note,
                'awarded_by' => $awarded_by,
            ]);
            return;
        }

        DB::getInstance()->insert('users_badges', [
            'user_id' => $user_id,
            'badge_id' => $badge_id,
            'awarded_at' => time(),
            'awarded_by' => $awarded_by,
            'note' => $note,
        ]);
    }

    public static function remove(int $user_id, int $badge_id): void
    {
        self::ensureTables();
        DB::getInstance()->delete('users_badges', [
            ['user_id', $user_id],
            ['badge_id', $badge_id],
        ]);
    }

    public static function resolveUsers(string $input): array
    {
        $users = [];
        $seen = [];
        $lines = preg_split('/[\r\n,]+/', $input);

        foreach ($lines as $line) {
            $value = trim($line);
            if ($value === '') {
                continue;
            }

            $row = null;
            if (ctype_digit($value)) {
                $row = DB::getInstance()->get('users', (int) $value)->first();
            }

            if (!$row) {
                $row = DB::getInstance()->get('users', ['username', $value])->first();
            }

            if (!$row && filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $row = DB::getInstance()->get('users', ['email', $value])->first();
            }

            if ($row && !isset($seen[$row->id])) {
                $seen[$row->id] = true;
                $users[] = $row;
            }
        }

        return $users;
    }

    public static function normaliseFormData(): array
    {
        return [
            'name' => Output::getClean(trim((string) Input::get('name'))),
            'description' => Output::getClean(trim((string) Input::get('description'))),
            'icon' => Output::getClean(trim((string) Input::get('icon'))),
            'colour' => preg_match('/^#[0-9a-fA-F]{6}$/', (string) Input::get('colour')) ? Input::get('colour') : '#f05a3b',
            'display_order' => is_numeric(Input::get('display_order')) ? (int) Input::get('display_order') : 0,
            'enabled' => Input::get('enabled') ? 1 : 0,
        ];
    }

    private static function uploadImage(?array $file): ?string
    {
        if (!$file || !isset($file['tmp_name']) || $file['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($extension, self::ALLOWED_EXTENSIONS, true)) {
            return null;
        }

        $upload_path = ROOT_PATH . '/' . self::IMAGE_DIRECTORY;
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0755, true);
        }

        $filename = 'badge_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $extension;
        if (!move_uploaded_file($file['tmp_name'], $upload_path . $filename)) {
            return null;
        }

        return self::IMAGE_DIRECTORY . $filename;
    }

    private static function formatBadge(object $badge): array
    {
        return [
            'id' => (int) $badge->id,
            'name' => Output::getClean($badge->name),
            'description' => Output::getClean($badge->description ?? ''),
            'image' => $badge->image ? (defined('CONFIG_PATH') ? CONFIG_PATH . '/' : '/') . Output::getClean($badge->image) : null,
            'icon' => Output::getClean($badge->icon ?: 'fas fa-award'),
            'colour' => Output::getClean($badge->colour ?: '#f05a3b'),
            'note' => Output::getClean($badge->note ?? ''),
            'awarded_at' => isset($badge->awarded_at) ? date(DATE_FORMAT, $badge->awarded_at) : '',
        ];
    }
}
