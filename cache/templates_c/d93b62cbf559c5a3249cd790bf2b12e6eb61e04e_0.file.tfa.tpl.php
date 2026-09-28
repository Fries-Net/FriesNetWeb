<?php
/* Smarty version 4.5.6, created on 2026-09-28 02:33:13
  from '/data/custom/templates/DefaultRevamp/tfa.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.6',
  'unifunc' => 'content_6ab9c3d99078d8_52647870',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd93b62cbf559c5a3249cd790bf2b12e6eb61e04e' => 
    array (
      0 => '/data/custom/templates/DefaultRevamp/tfa.tpl',
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
function content_6ab9c3d99078d8_52647870 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:navbar.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<h2 class="ui header">
    <?php echo $_smarty_tpl->tpl_vars['TWO_FACTOR_AUTH']->value;?>

</h2>

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

<div class="ui padded segment" id="tfa">
    <div class="ui stackable grid">
        <div class="ui centered row">
            <div class="ui sixteen wide tablet ten wide computer column">
                <form class="ui form" action="" method="post" id="form-tfa">
                    <div class="field">
                        <label for="inputEmail"><?php echo $_smarty_tpl->tpl_vars['TFA_ENTER_CODE']->value;?>
</label>
                        <input type="text" name="tfa_code">
                    </div>
                    <input type="hidden" name="tfa" value="true">
                    <input type="hidden" name="token" value="<?php echo $_smarty_tpl->tpl_vars['TOKEN']->value;?>
">
                    <input type="submit" class="ui primary button" value="<?php echo $_smarty_tpl->tpl_vars['SUBMIT']->value;?>
">
                </form>
            </div>
        </div>
    </div>
</div>

<?php $_smarty_tpl->_subTemplateRender('file:footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
