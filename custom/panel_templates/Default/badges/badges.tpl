{include file='header.tpl'}

<body id="page-top">
<div id="wrapper">
    {include file='sidebar.tpl'}

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            {include file='navbar.tpl'}

            <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">{$MANAGE_BADGES}</h1>
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{$PANEL_INDEX}">{$DASHBOARD}</a></li>
                        <li class="breadcrumb-item active">{$BADGES}</li>
                    </ol>
                </div>

                {include file='includes/update.tpl'}
                {include file='includes/alerts.tpl'}

                <div class="row">
                    <div class="col-lg-5">
                        <div class="card shadow mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">{if isset($EDITING_BADGE)}{$EDIT_BADGE}{else}{$CREATE_BADGE}{/if}</h5>
                            </div>
                            <div class="card-body">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="token" value="{$TOKEN}">
                                    <input type="hidden" name="action" value="save">
                                    <input type="hidden" name="badge_id" value="{if isset($EDITING_BADGE)}{$EDITING_BADGE->id}{else}0{/if}">

                                    <div class="form-group">
                                        <label for="name">{$BADGE_NAME}</label>
                                        <input id="name" class="form-control" type="text" name="name" maxlength="64" required value="{if isset($EDITING_BADGE)}{$EDITING_BADGE->name}{/if}">
                                    </div>

                                    <div class="form-group">
                                        <label for="description">{$DESCRIPTION}</label>
                                        <textarea id="description" class="form-control" name="description" rows="4">{if isset($EDITING_BADGE)}{$EDITING_BADGE->description}{/if}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="image">{$IMAGE}</label>
                                        {if isset($EDITING_BADGE) && $EDITING_BADGE->image}
                                            <div class="mb-2">
                                                <img src="{$CONFIG_PATH}{$EDITING_BADGE->image}" alt="{$EDITING_BADGE->name}" style="width:42px;height:42px;object-fit:contain;">
                                            </div>
                                        {/if}
                                        <input id="image" class="form-control-file" type="file" name="image" accept=".png,.jpg,.jpeg,.gif,.webp,.svg">
                                    </div>

                                    <div class="form-group">
                                        <label for="icon">{$ICON}</label>
                                        <input id="icon" class="form-control" type="text" name="icon" placeholder="fas fa-award" value="{if isset($EDITING_BADGE)}{$EDITING_BADGE->icon}{/if}">
                                        <small class="form-text text-muted">{$ICON_HELP}</small>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="colour">{$COLOUR}</label>
                                                <input id="colour" class="form-control" type="color" name="colour" value="{if isset($EDITING_BADGE) && $EDITING_BADGE->colour}{$EDITING_BADGE->colour}{else}#f05a3b{/if}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="display_order">{$DISPLAY_ORDER}</label>
                                                <input id="display_order" class="form-control" type="number" name="display_order" value="{if isset($EDITING_BADGE)}{$EDITING_BADGE->display_order}{else}0{/if}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="custom-control custom-switch mb-3">
                                        <input id="enabled" class="custom-control-input" type="checkbox" name="enabled" value="1" {if !isset($EDITING_BADGE) || $EDITING_BADGE->enabled}checked{/if}>
                                        <label class="custom-control-label" for="enabled">{$ENABLED}</label>
                                    </div>

                                    <button class="btn btn-primary">{$SUBMIT}</button>
                                    {if isset($EDITING_BADGE)}
                                        <a class="btn btn-secondary" href="{$CONFIG_PATH}panel/badges">{$CANCEL}</a>
                                    {/if}
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="card shadow mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">{$BADGES}</h5>
                                <a class="btn btn-sm btn-primary" href="{$BULK_ASSIGN_LINK}">{$BULK_ASSIGN}</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>{$BADGE_NAME}</th>
                                                <th>{$DISPLAY_ORDER}</th>
                                                <th>{$ENABLED}</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {foreach from=$BADGES_LIST item=badge}
                                                <tr>
                                                    <td>
                                                        <span class="badge-preview" style="display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;margin-right:.5rem;border-radius:6px;background:{$badge->colour};color:#111;">
                                                            {if $badge->image}
                                                                <img src="{$CONFIG_PATH}{$badge->image}" alt="{$badge->name}" style="width:24px;height:24px;object-fit:contain;">
                                                            {else}
                                                                <i class="{if $badge->icon}{$badge->icon}{else}fas fa-award{/if}"></i>
                                                            {/if}
                                                        </span>
                                                        <strong>{$badge->name}</strong>
                                                        <div class="text-muted small">{$badge->description}</div>
                                                    </td>
                                                    <td>{$badge->display_order}</td>
                                                    <td>{if $badge->enabled}<i class="fa fa-check-circle text-success"></i>{else}<i class="fa fa-times-circle text-danger"></i>{/if}</td>
                                                    <td class="text-right">
                                                        <a class="btn btn-sm btn-primary" href="{$CONFIG_PATH}panel/badges?edit={$badge->id}">{$EDIT}</a>
                                                        <form action="" method="post" style="display:inline;">
                                                            <input type="hidden" name="token" value="{$TOKEN}">
                                                            <input type="hidden" name="action" value="delete">
                                                            <input type="hidden" name="badge_id" value="{$badge->id}">
                                                            <button class="btn btn-sm btn-danger" onclick="return confirm('{$ARE_YOU_SURE}');">{$DELETE}</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            {foreachelse}
                                                <tr>
                                                    <td colspan="4" class="text-center">{$NO_BADGES}</td>
                                                </tr>
                                            {/foreach}
                                        </tbody>
                                    </table>
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
