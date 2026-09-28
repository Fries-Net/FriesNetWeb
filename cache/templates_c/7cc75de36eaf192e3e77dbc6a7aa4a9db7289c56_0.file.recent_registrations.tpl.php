<?php
/* Smarty version 4.5.6, created on 2026-09-28 02:24:14
  from '/data/custom/panel_templates/Default/collections/dashboard_items/recent_registrations.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.6',
  'unifunc' => 'content_6ab9c1bee75649_74214544',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7cc75de36eaf192e3e77dbc6a7aa4a9db7289c56' => 
    array (
      0 => '/data/custom/panel_templates/Default/collections/dashboard_items/recent_registrations.tpl',
      1 => 1790558301,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6ab9c1bee75649_74214544 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="card shadow mb-4">
    <div class="card-header bg-primary py-3">
        <h6 class="m-0 font-weight-bold text-white"><i class="fas fa-user fa-fw"></i> <?php echo $_smarty_tpl->tpl_vars['RECENT_REGISTRATIONS']->value;?>
</h6>
    </div>
    <div class="card-body">
        <?php if (count($_smarty_tpl->tpl_vars['REGISTRATIONS']->value)) {?>
        <div id="accordion">
            <?php $_smarty_tpl->_assignInScope('i', 1);?> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['REGISTRATIONS']->value, 'registration');
$_smarty_tpl->tpl_vars['registration']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['registration']->value) {
$_smarty_tpl->tpl_vars['registration']->do_else = false;
?>
            <div class="card" style="margin-bottom: 10px; border-radius: 10px">
                <div class="card-header" style="border-radius: 10px" id="headingRegistration<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
">
                    <h5 class="mb-0">
                        <button class="btn btn-link btn-block btn-accordion" data-toggle="collapse" data-target="#collapseRegistration<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" aria-expanded="true" aria-controls="collapseRegistration<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
">
                                    <span style="<?php echo $_smarty_tpl->tpl_vars['registration']->value['style'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['registration']->value['avatar'];?>
" style="max-width:20px;max-height:20px;" class="rounded" alt="<?php echo $_smarty_tpl->tpl_vars['registration']->value['username'];?>
" /> <?php echo $_smarty_tpl->tpl_vars['registration']->value['nickname'];?>
</span>
                                    <?php echo $_smarty_tpl->tpl_vars['registration']->value['groups'][0];?>

                        </button>
                    </h5>
                    <div id="collapseRegistration<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" class="collapse text-center" aria-labelledby="headingRegistration<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" data-parent="#accordion">
                        <?php echo $_smarty_tpl->tpl_vars['REGISTERED']->value;?>
 <span data-toggle="tooltip" data-title="<?php echo $_smarty_tpl->tpl_vars['registration']->value['time_full'];?>
"><?php echo $_smarty_tpl->tpl_vars['registration']->value['time'];?>
</span><br />
                        <hr />
                        <a class="btn btn-primary btn-block text-white" href="<?php echo $_smarty_tpl->tpl_vars['registration']->value['url'];?>
"><?php echo $_smarty_tpl->tpl_vars['VIEW']->value;?>
</a>
                    </div>
                </div>
            </div>
            <?php $_smarty_tpl->_assignInScope('i', ($_smarty_tpl->tpl_vars['i']->value+1));?> <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </div>
        <?php }?>
    </div>
</div><?php }
}
