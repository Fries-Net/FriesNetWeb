<div id="user-popup">
    <div class="header">
        <img class="ui tiny circular image" src="{$AVATAR}" alt="{$USERNAME}" />
        <h4 class="ui header" style="{$STYLE}">{$NICKNAME}</h4>
        {if count($GROUPS)}
            <div class="fn-popover-groups">
            {foreach from=$GROUPS item=group_html}
                {$group_html}
            {/foreach}
            </div>
        {else}
            <div class="ui label">{$GUEST}</div>
        {/if}
        {if isset($USER_POPUP_BADGES) && count($USER_POPUP_BADGES)}
            <div class="fn-popover-badges">
                {foreach from=$USER_POPUP_BADGES item=badge}
                    <span class="fn-profile-badge fn-profile-badge-static" data-tooltip="{$badge.name}: {$badge.description}" style="--badge-colour: {$badge.colour};">
                        {if $badge.image}
                            <img src="{$badge.image}" alt="{$badge.name}">
                        {else}
                            <i class="{$badge.icon}"></i>
                        {/if}
                    </span>
                {/foreach}
            </div>
        {/if}
    </div>
    {if isset($REGISTERED)}
        <div class="ui divider"></div>
        <div class="ui list">
            <div class="item">
                <span class="text">{$REGISTERED|regex_replace:'/[:].*/':''}</span>
                <div class="description right floated" data-tooltip="{$REGISTERED_DATE}"><b>{$REGISTERED|regex_replace:'/^[^:]+:\h*/':''}</b></div>
            </div>
            {if isset($LAST_SEEN)}
                <div class="item">
                    <span class="text">{$LAST_SEEN|regex_replace:'/[:].*/':''}</span>
                    <div class="description right floated" data-tooltip="{$LAST_SEEN_DATE}"><b>{$LAST_SEEN|regex_replace:'/^[^:]+:\h*/':''}</b></div>
                </div>
            {/if}
            {if isset($TOPICS) && isset($POSTS)}
                <div class="item">
                    <span class="text">{$TOPICS|regex_replace:'/[0-9]+/':''|capitalize}</span>
                    <div class="description right floated"><b>{$TOPICS|regex_replace:'/[^0-9]+/':''}</b></div>
                </div>
                <div class="item">
                    <span class="text">{$POSTS|regex_replace:'/[0-9]+/':''|capitalize}</span>
                    <div class="description right floated"><b>{$POSTS|regex_replace:'/[^0-9]+/':''}</b></div>
                </div>
            {/if}
        </div>
    {/if}
</div>
