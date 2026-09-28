<section class="fn-portal">
    <div class="fn-section-heading">
        <span class="fn-eyebrow">Community Hub</span>
        <h2>Everything happening across {$SITE_NAME}</h2>
        <p>Use the links below to get into the live parts of the community. These are pulled from the site navigation, so they stay aligned with the actual routes and permissions.</p>
    </div>

    <div class="fn-portal-grid">
        {foreach from=$NAV_LINKS item=item}
            {if isset($item.items)}
                <div class="fn-route-card">
                    <div class="fn-route-icon">{$item.icon}</div>
                    <h3>{$item.title}</h3>
                    <div class="fn-route-links">
                        {foreach from=$item.items item=dropdown}
                            {if !isset($dropdown.separator)}
                                <a href="{$dropdown.link}" target="{$dropdown.target}">{$dropdown.icon} {$dropdown.title}</a>
                            {/if}
                        {/foreach}
                    </div>
                </div>
            {else}
                <a class="fn-route-card fn-route-card-link" href="{$item.link}" target="{$item.target}">
                    <div class="fn-route-icon">{$item.icon}</div>
                    <h3>{$item.title}</h3>
                    <span>Open section</span>
                </a>
            {/if}
        {/foreach}
    </div>
</section>
