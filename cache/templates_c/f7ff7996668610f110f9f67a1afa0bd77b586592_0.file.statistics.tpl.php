<?php
/* Smarty version 4.5.6, created on 2026-09-28 02:26:04
  from '/data/custom/templates/DefaultRevamp/widgets/statistics.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.6',
  'unifunc' => 'content_6ab9c22c7a5092_95710493',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f7ff7996668610f110f9f67a1afa0bd77b586592' => 
    array (
      0 => '/data/custom/templates/DefaultRevamp/widgets/statistics.tpl',
      1 => 1790558301,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6ab9c22c7a5092_95710493 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="ui fluid card" id="widget-statistics">
    <div class="content">
        <h4 class="ui header"><?php echo $_smarty_tpl->tpl_vars['STATISTICS']->value;?>
</h4>
        <div class="description">
            <div class="ui list">
                <?php if ((isset($_smarty_tpl->tpl_vars['FORUM_STATISTICS']->value))) {?>
                <div class="item">
                    <span class="text"><?php echo $_smarty_tpl->tpl_vars['TOTAL_THREADS']->value;?>
</span>
                    <div class="description right floated"><b><?php echo $_smarty_tpl->tpl_vars['TOTAL_THREADS_VALUE']->value;?>
</b></div>
                </div>
                <div class="item">
                    <span class="text"><?php echo $_smarty_tpl->tpl_vars['TOTAL_POSTS']->value;?>
</span>
                    <div class="description right floated"><b><?php echo $_smarty_tpl->tpl_vars['TOTAL_POSTS_VALUE']->value;?>
</b></div>
                </div>
                <?php }?>
                <div class="item">
                    <span class="text"><?php echo $_smarty_tpl->tpl_vars['USERS_REGISTERED']->value;?>
</span>
                    <div class="description right floated"><b><?php echo $_smarty_tpl->tpl_vars['USERS_REGISTERED_VALUE']->value;?>
</b></div>
                </div>
                <div class="item" style="display: flex;">
                    <span class="text" style="width: 100%;"><?php echo $_smarty_tpl->tpl_vars['LATEST_MEMBER']->value;?>
</span>
                    <div class="description right floated">
                        <a href="<?php echo $_smarty_tpl->tpl_vars['LATEST_MEMBER_VALUE']->value['profile'];?>
" data-poload="<?php echo $_smarty_tpl->tpl_vars['USER_INFO_URL']->value;
echo $_smarty_tpl->tpl_vars['LATEST_MEMBER_VALUE']->value['id'];?>
"
                            style="<?php echo $_smarty_tpl->tpl_vars['LATEST_MEMBER_VALUE']->value['style'];?>
"><b><?php echo $_smarty_tpl->tpl_vars['LATEST_MEMBER_VALUE']->value['nickname'];?>
</b></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php }
}
