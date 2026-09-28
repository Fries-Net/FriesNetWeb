<?php
/* Smarty version 4.5.6, created on 2026-09-28 02:26:04
  from '/data/custom/templates/DefaultRevamp/widgets/online_staff.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.6',
  'unifunc' => 'content_6ab9c22c782ad5_40831917',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9f818b3df84e8a49330fe2bf75c95ad514c33d0f' => 
    array (
      0 => '/data/custom/templates/DefaultRevamp/widgets/online_staff.tpl',
      1 => 1790558301,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6ab9c22c782ad5_40831917 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="ui fluid card" id="widget-online-staff">
    <div class="content">
        <h4 class="ui header"><?php echo $_smarty_tpl->tpl_vars['ONLINE_STAFF']->value;?>
</h4>
        <div class="description">
            <?php if ((isset($_smarty_tpl->tpl_vars['ONLINE_STAFF_LIST']->value))) {?>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ONLINE_STAFF_LIST']->value, 'user', false, NULL, 'online_staff_arr', array (
));
$_smarty_tpl->tpl_vars['user']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['user']->value) {
$_smarty_tpl->tpl_vars['user']->do_else = false;
?>
                <div class="ui relaxed list">
                    <div class="item">
                        <img class="ui mini circular image" src="<?php echo $_smarty_tpl->tpl_vars['user']->value['avatar'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['user']->value['username'];?>
">
                        <div class="content">
                            <a class="" href="<?php echo $_smarty_tpl->tpl_vars['user']->value['profile'];?>
" data-poload="<?php echo $_smarty_tpl->tpl_vars['USER_INFO_URL']->value;
echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
" style="<?php echo $_smarty_tpl->tpl_vars['user']->value['style'];?>
"><?php echo $_smarty_tpl->tpl_vars['user']->value['nickname'];?>
</a>
                            <?php echo $_smarty_tpl->tpl_vars['user']->value['group'];?>

                        </div>
                    </div>
                </div>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            <?php } else { ?>
                <?php echo $_smarty_tpl->tpl_vars['NO_STAFF_ONLINE']->value;?>

            <?php }?>
        </div>
    </div>
    <div class="extra content">
        <?php echo $_smarty_tpl->tpl_vars['TOTAL_ONLINE_STAFF']->value;?>

    </div>
</div>
<?php }
}
