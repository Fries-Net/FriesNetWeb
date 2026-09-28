{include file='header.tpl'}

<body id="page-top">
<div id="wrapper">
    {include file='sidebar.tpl'}

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            {include file='navbar.tpl'}

            <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">{$BULK_ASSIGN}</h1>
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{$PANEL_INDEX}">{$DASHBOARD}</a></li>
                        <li class="breadcrumb-item"><a href="{$BADGES_LINK}">{$BADGES}</a></li>
                        <li class="breadcrumb-item active">{$BULK_ASSIGN}</li>
                    </ol>
                </div>

                {include file='includes/update.tpl'}
                {include file='includes/alerts.tpl'}

                <div class="card shadow mb-4">
                    <div class="card-body">
                        <form action="" method="post">
                            <input type="hidden" name="token" value="{$TOKEN}">

                            <div class="form-group">
                                <label for="badge_id">{$BADGE}</label>
                                <select id="badge_id" class="form-control" name="badge_id" required>
                                    {foreach from=$BADGES_LIST item=badge}
                                        <option value="{$badge->id}">{$badge->name}</option>
                                    {/foreach}
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="users">{$BULK_USERS}</label>
                                <textarea id="users" class="form-control" name="users" rows="10" required></textarea>
                                <small class="form-text text-muted">{$BULK_USERS_HELP}</small>
                            </div>

                            <div class="form-group">
                                <label for="note">{$DESCRIPTION}</label>
                                <input id="note" class="form-control" type="text" name="note">
                            </div>

                            <button class="btn btn-primary">{$SUBMIT}</button>
                        </form>
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
