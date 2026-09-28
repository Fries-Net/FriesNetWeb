<?php
/* Smarty version 4.5.6, created on 2026-09-28 03:16:40
  from '/data/custom/templates/DefaultRevamp/members/members.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.6',
  'unifunc' => 'content_6ab9ce08a3d422_69557530',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fdef5dbd06dd76349dff94823e93ea8449b5def0' => 
    array (
      0 => '/data/custom/templates/DefaultRevamp/members/members.tpl',
      1 => 1790558301,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:navbar.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_6ab9ce08a3d422_69557530 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/data/vendor/smarty/smarty/libs/plugins/modifier.count.php','function'=>'smarty_modifier_count',),));
$_smarty_tpl->_subTemplateRender('file:header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:navbar.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<h2 class="ui header">
    <?php echo $_smarty_tpl->tpl_vars['MEMBERS']->value;?>

</h2>

<br />

<?php if ((isset($_smarty_tpl->tpl_vars['ERROR']->value))) {?>
<div class="ui error icon message">
    <i class="x icon"></i>
    <div class="content">
        <div class="header"><?php echo $_smarty_tpl->tpl_vars['ERROR_TITLE']->value;?>
</div>
        <?php echo $_smarty_tpl->tpl_vars['ERROR']->value;?>

    </div>
</div>
<?php }?>

<div class="ui stackable equal width grid">
    <div class="ui centered row">
        <div class="ui four wide column">
            <div class="ui fluid vertical menu pointing">
                <a class="item <?php if ($_smarty_tpl->tpl_vars['VIEWING_LIST']->value == "overview") {?>active<?php }?>" href="<?php echo $_smarty_tpl->tpl_vars['MEMBER_LIST_URL']->value;?>
">
                    <i class="ellipsis horizontal icon"></i><?php echo $_smarty_tpl->tpl_vars['OVERVIEW']->value;?>

                </a>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['SIDEBAR_MEMBER_LISTS']->value, 'list');
$_smarty_tpl->tpl_vars['list']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['list']->value) {
$_smarty_tpl->tpl_vars['list']->do_else = false;
?>
                    <a class="item <?php if ($_smarty_tpl->tpl_vars['VIEWING_LIST']->value == $_smarty_tpl->tpl_vars['list']->value->getName()) {?>active<?php }?>" href="<?php echo $_smarty_tpl->tpl_vars['list']->value->url();?>
">
                        <i class="<?php if ($_smarty_tpl->tpl_vars['list']->value->getIcon()) {
echo $_smarty_tpl->tpl_vars['list']->value->getIcon();
} else { ?>dot circle icon<?php }?>"></i> <?php echo $_smarty_tpl->tpl_vars['list']->value->getFriendlyName();?>

                    </a>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </div>
            <div class="ui fluid card">
                <div class="content">
                    <h4 class="ui header"><?php echo $_smarty_tpl->tpl_vars['FIND_MEMBER']->value;?>
</h4>
                    <div class="description">
                        <div class="ui search">
                            <div class="ui icon fluid input">
                                <input class="prompt" type="text" minlength="2" required placeholder="<?php echo $_smarty_tpl->tpl_vars['NAME']->value;?>
" autocomplete="off">
                                <i class="search icon"></i>
                            </div>
                            <div class="results"></div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if (smarty_modifier_count($_smarty_tpl->tpl_vars['GROUPS']->value)) {?>
                <div class="ui fluid card">
                    <div class="content">
                        <h4 class="ui header"><?php echo $_smarty_tpl->tpl_vars['VIEW_GROUP']->value;?>
</h4>
                        <div class="description">
                            <select class="ui selection fluid dropdown" onchange="viewGroup(this)">
                                <option value=""><?php echo $_smarty_tpl->tpl_vars['GROUP']->value;?>
</option>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['GROUPS']->value, 'group');
$_smarty_tpl->tpl_vars['group']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['group']->value) {
$_smarty_tpl->tpl_vars['group']->do_else = false;
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['group']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['VIEWING_GROUP']->value['id'] == $_smarty_tpl->tpl_vars['group']->value['id']) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['group']->value['name'];?>
</option>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </select>
                        </div>
                    </div>
                </div>
            <?php }?>
            <div class="ui fluid card">
                <div class="content">
                    <h4 class="ui header"><?php echo $_smarty_tpl->tpl_vars['NEW_MEMBERS']->value;?>
</h4>
                    <div class="description">
                        <div class="ui four column grid" id="new-members-grid">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['NEW_MEMBERS_VALUE']->value, 'member');
$_smarty_tpl->tpl_vars['member']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['member']->value) {
$_smarty_tpl->tpl_vars['member']->do_else = false;
?>
                                <div class="column">
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['member']->value->getProfileUrl();?>
" data-toggle="popup" data-poload="<?php echo $_smarty_tpl->tpl_vars['USER_INFO_URL']->value;
echo $_smarty_tpl->tpl_vars['member']->value->data()->id;?>
">
                                        <img class="ui circular image" src="<?php echo $_smarty_tpl->tpl_vars['member']->value->getAvatar();?>
" alt="<?php echo $_smarty_tpl->tpl_vars['member']->value->getDisplayname();?>
">
                                    </a>
                                </div>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ui column">
            <?php if ($_smarty_tpl->tpl_vars['VIEWING_LIST']->value == "group" || smarty_modifier_count($_smarty_tpl->tpl_vars['MEMBER_LISTS_VIEWING']->value)) {?>
                <div class="ui stackable equal width left aligned three column grid segment" style="margin-top: 0">
                    <?php if ($_smarty_tpl->tpl_vars['VIEWING_LIST']->value == "group") {?>
                        <div class="ui column">
                            <h3><?php echo $_smarty_tpl->tpl_vars['VIEWING_GROUP']->value['name'];?>
</h3>
                            <div>
                                <ul id="member_list_group_<?php echo $_smarty_tpl->tpl_vars['VIEWING_GROUP']->value['id'];?>
" class="ui list large selection" style="margin-left: -10px;">
                                </ul>
                                <?php echo $_smarty_tpl->tpl_vars['PAGINATION']->value;?>

                            </div>
                        </div>
                    <?php } else { ?>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['MEMBER_LISTS_VIEWING']->value, 'list');
$_smarty_tpl->tpl_vars['list']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['list']->value) {
$_smarty_tpl->tpl_vars['list']->do_else = false;
?>
                            <div class="ui column">
                                <h3><?php echo $_smarty_tpl->tpl_vars['list']->value->getFriendlyName();?>
</h3>
                                <div>
                                    <ul id="member_list_<?php echo $_smarty_tpl->tpl_vars['list']->value->getName();?>
" class="ui list large selection" style="margin-left: -10px;">
                                    </ul>
                                    <?php if ($_smarty_tpl->tpl_vars['VIEWING_LIST']->value == "overview") {?>
                                        <a class="fluid ui grey basic button" href="<?php echo $_smarty_tpl->tpl_vars['list']->value->url();?>
"><?php echo $_smarty_tpl->tpl_vars['VIEW_ALL']->value;?>
</a>
                                    <?php } else { ?>
                                        <?php echo $_smarty_tpl->tpl_vars['PAGINATION']->value;?>

                                    <?php }?>
                                </div>
                            </div>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    <?php }?>
                </div>
            <?php } else { ?>
                <div class="ui orange message"><?php echo $_smarty_tpl->tpl_vars['NO_OVERVIEW_LISTS_ENABLED']->value;?>
</div>
            <?php }?>
        </div>
    </div>
</div>

<?php echo '<script'; ?>
 type="text/javascript">
    const viewGroup = (e) => {
        window.location.href = '<?php echo $_smarty_tpl->tpl_vars['VIEW_GROUP_URL']->value;?>
' + e.value;
    }

    const renderList = (name) => {
        const list = document.getElementById('member_list_' + name);
        list.innerHTML = '<div class="ui active centered inline loader"></div>';

        fetch(
            '<?php echo $_smarty_tpl->tpl_vars['QUERIES_URL']->value;?>
'
                .replace('{{list}}', name)
                .replace('{{page}}', new URLSearchParams(window.location.search).get('p') ?? 1)
        )
            .then(async response => {
                const data = await response.json();
                if (data.length === 0) {
                    list.parentElement.innerHTML = '<div class="ui orange message"><?php echo $_smarty_tpl->tpl_vars['NO_MEMBERS_FOUND']->value;?>
</div>';
                    return;
                }

                list.innerHTML = '';

                for (const member of data) {
                    const mainDiv = document.createElement('div');
                    mainDiv.classList.add('item');
                    mainDiv.onclick = () => window.location.href = member.profile_url;

                    const countDiv = document.createElement('div');
                    countDiv.classList.add('right', 'floated', 'content');

                    if (member.count !== null) {
                        const countHeader = document.createElement('h3');
                        countHeader.classList.add('ui', 'header');
                        countHeader.innerText = member.count;
                        countDiv.appendChild(countHeader);
                        mainDiv.appendChild(countDiv);
                    }

                    const contentDiv = document.createElement('div');
                    contentDiv.classList.add('middle', 'aligned', 'content');
                    contentDiv.style.whiteSpace = 'nowrap';
                    contentDiv.style.overflow = 'hidden';
                    contentDiv.style.textOverflow = 'ellipsis';

                    const avatarDiv = document.createElement('img');
                    avatarDiv.classList.add('ui', 'avatar', 'image');
                    avatarDiv.setAttribute('src', member.avatar_url);
                    <?php if ($_smarty_tpl->tpl_vars['VIEWING_LIST']->value == "overview") {?>
                        contentDiv.appendChild(avatarDiv);
                    <?php } else { ?>
                        mainDiv.appendChild(avatarDiv);
                    <?php }?>

                    const nameDiv = document.createElement('span');
                    nameDiv.style = member.group_style?.replace('&#039;', "'")?.replace('&quot;', '"');
                    <?php if ($_smarty_tpl->tpl_vars['VIEWING_LIST']->value != "overview") {?>
                        nameDiv.innerHTML = member.username + '&nbsp;' + member.group_html.join('');
                    <?php } else { ?>
                        nameDiv.innerText = member.username;
                    <?php }?>
                    contentDiv.appendChild(nameDiv);

                    <?php if ($_smarty_tpl->tpl_vars['VIEWING_LIST']->value != "overview") {?>
                        const metaDiv = document.createElement('div');
                        metaDiv.classList.add('description');

                        const metaSpan = document.createElement('span');
                        metaSpan.classList.add('ui', 'text', 'small');
                        const memberMeta = member.metadata;
                        metaSpan.innerHTML = Object.keys(memberMeta).map(key => key + ': ' + memberMeta[key]).join(' &middot; ');

                        metaDiv.appendChild(metaSpan);
                        contentDiv.appendChild(metaDiv);
                    <?php }?>
                    mainDiv.appendChild(contentDiv);
                    list.appendChild(mainDiv)
                }
        });
    }

    window.onload = () => {
        <?php if ($_smarty_tpl->tpl_vars['VIEWING_LIST']->value == "group") {?>
            renderList('group_<?php echo $_smarty_tpl->tpl_vars['VIEWING_GROUP']->value['id'];?>
');
        <?php } else { ?>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['MEMBER_LISTS_VIEWING']->value, 'list');
$_smarty_tpl->tpl_vars['list']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['list']->value) {
$_smarty_tpl->tpl_vars['list']->do_else = false;
?>
                renderList('<?php echo $_smarty_tpl->tpl_vars['list']->value->getName();?>
');
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        <?php }?>

        $('.ui.search')
            .search({
                minCharacters: 2,
                maxResults: 5,
                selectFirstResult: true,
                fields: {
                    title: 'username',
                    description: 'nickname',
                    image: 'avatar_url',
                    url: 'profile_url',
                },
                apiSettings: {
                    url: '<?php echo $_smarty_tpl->tpl_vars['SEARCH_URL']->value;?>
&search={query}&limit=5'
                },
                error: {
                    noResultsHeader: "<?php echo $_smarty_tpl->tpl_vars['NO_RESULTS_HEADER']->value;?>
",
                    noResults: "<?php echo $_smarty_tpl->tpl_vars['NO_RESULTS_TEXT']->value;?>
",
                }
            })
        ;
    }
<?php echo '</script'; ?>
>

<?php $_smarty_tpl->_subTemplateRender('file:footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
