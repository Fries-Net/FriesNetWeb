<?php
/* Smarty version 4.5.6, created on 2026-09-28 03:16:40
  from '/data/custom/templates/DefaultRevamp/cookies.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.6',
  'unifunc' => 'content_6ab9ce088e09b5_08234485',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3cce76ac861559fb7f30caaea01c18e654a5407c' => 
    array (
      0 => '/data/custom/templates/DefaultRevamp/cookies.tpl',
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
function content_6ab9ce088e09b5_08234485 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:navbar.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<h2 class="ui header">
    <?php echo $_smarty_tpl->tpl_vars['COOKIE_NOTICE_HEADER']->value;?>

</h2>

<div class="ui padded segment" id="cookies">
    <?php echo $_smarty_tpl->tpl_vars['COOKIE_NOTICE']->value;?>


    <div class="ui divider"></div>
    <div class="ui blue button" onclick="configureCookies()"><?php echo $_smarty_tpl->tpl_vars['UPDATE_SETTINGS']->value;?>
</div>
</div>

<?php $_smarty_tpl->_subTemplateRender('file:footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
