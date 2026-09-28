{include file='header.tpl'}

<body id="page-top">
<div id="wrapper">
    {include file='sidebar.tpl'}

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            {include file='navbar.tpl'}

            <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">{$ASSIGN_BADGES}</h1>
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{$PANEL_INDEX}">{$DASHBOARD}</a></li>
                        <li class="breadcrumb-item"><a href="{$BADGES_LINK}">{$BADGES}</a></li>
                        <li class="breadcrumb-item active">{$NICKNAME}</li>
                    </ol>
                </div>

                {include file='includes/update.tpl'}
                {include file='includes/alerts.tpl'}

                <div class="row">
                    <div class="col-md-4">
                        <div class="card shadow mb-4">
                            <div class="card-body text-center">
                                <img class="profile-user-img rounded-circle mb-3" src="{$AVATAR}" alt="{$USERNAME}">
                                <h4 style="{$USER_STYLE}">{$NICKNAME}</h4>
                                <div class="text-muted">@{$USERNAME}</div>
                            </div>
                        </div>

                        <div class="card shadow mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">{$CURRENT_BADGES}</h5>
                            </div>
                            <div class="card-body">
                                {foreach from=$USER_BADGES item=badge}
                                    <div class="d-flex align-items-center justify-content-between border-bottom py-2">
                                        <div>
                                            <strong>{$badge->name}</strong>
                                            <div class="text-muted small">{$badge->description}</div>
                                        </div>
                                        <form action="" method="post">
                                            <input type="hidden" name="token" value="{$TOKEN}">
                                            <input type="hidden" name="action" value="remove">
                                            <input type="hidden" name="badge_id" value="{$badge->id}">
                                            <button class="btn btn-sm btn-danger">{$REMOVE}</button>
                                        </form>
                                    </div>
                                {foreachelse}
                                    <p class="mb-0 text-muted">{$NO_USER_BADGES}</p>
                                {/foreach}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="card shadow mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">{$AVAILABLE_BADGES}</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    {foreach from=$BADGES_LIST item=badge}
                                        <div class="col-md-6 mb-3">
                                            <form class="border rounded p-3 h-100" action="" method="post">
                                                <input type="hidden" name="token" value="{$TOKEN}">
                                                <input type="hidden" name="action" value="assign">
                                                <input type="hidden" name="badge_id" value="{$badge->id}">
                                                <div class="d-flex align-items-center mb-2">
                                                    <span style="display:inline-flex;align-items:center;justify-content:center;width:38px;height:38px;margin-right:.75rem;border-radius:6px;background:{$badge->colour};color:#111;">
                                                        {if $badge->image}
                                                            <img src="{$CONFIG_PATH}{$badge->image}" alt="{$badge->name}" style="width:28px;height:28px;object-fit:contain;">
                                                        {else}
                                                            <i class="{if $badge->icon}{$badge->icon}{else}fas fa-award{/if}"></i>
                                                        {/if}
                                                    </span>
                                                    <div>
                                                        <strong>{$badge->name}</strong>
                                                        <div class="text-muted small">{$badge->description}</div>
                                                    </div>
                                                </div>
                                                <input class="form-control form-control-sm mb-2" type="text" name="note" placeholder="{$DESCRIPTION}">
                                                <button class="btn btn-sm btn-primary" {if in_array($badge->id, $USER_BADGE_IDS)}disabled{/if}>{$SUBMIT}</button>
                                            </form>
                                        </div>
                                    {foreachelse}
                                        <div class="col-12">
                                            <p class="text-muted mb-0">{$NO_USER_BADGES}</p>
                                        </div>
                                    {/foreach}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {include file='footer.tpl'}
    </div>
</div>

{include file='scripts.tpl'}
</body>
</html>
