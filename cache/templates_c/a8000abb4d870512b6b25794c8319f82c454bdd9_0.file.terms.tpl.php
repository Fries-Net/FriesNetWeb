<?php
/* Smarty version 4.5.6, created on 2026-09-28 03:16:39
  from '/data/custom/templates/DefaultRevamp/terms.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.6',
  'unifunc' => 'content_6ab9ce07ef38d8_20986949',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a8000abb4d870512b6b25794c8319f82c454bdd9' => 
    array (
      0 => '/data/custom/templates/DefaultRevamp/terms.tpl',
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
function content_6ab9ce07ef38d8_20986949 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:navbar.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<h2 class="ui header">
    <?php echo $_smarty_tpl->tpl_vars['TERMS']->value;?>

</h2>

<div class="ui padded segment" id="terms">
    <?php echo $_smarty_tpl->tpl_vars['SITE_TERMS']->value;?>

</div>

<?php $_smarty_tpl->_subTemplateRender('file:footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
