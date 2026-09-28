{include file='header.tpl'}
{include file='navbar.tpl'}

<section class="fn-staff-page">
    <div class="fn-section-heading centered">
        <span class="fn-eyebrow">FriesNet Team</span>
        <h2>{$STAFF_TITLE}</h2>
        <p>{$STAFF_SUBTITLE}</p>
    </div>

    {if count($STAFF_SECTIONS)}
        <div class="fn-staff-sections">
            {foreach from=$STAFF_SECTIONS item=section}
                <section class="fn-staff-rank">
                    <div class="fn-staff-rank-heading">
                        {$section.html}
                    </div>
                    <div class="fn-staff-grid">
                        {foreach from=$section.members item=member}
                            <a class="fn-staff-card" href="{$member.profile}">
                                <img src="{$member.avatar}" alt="{$member.displayname}">
                                <span style="{$member.username_style}">{$member.displayname}</span>
                            </a>
                        {/foreach}
                    </div>
                </section>
            {/foreach}
        </div>
    {else}
        <div class="ui info message">
            <div class="content">{$NO_STAFF}</div>
        </div>
    {/if}
</section>

{include file='footer.tpl'}
