<?php
/* Smarty version 4.5.6, created on 2026-09-28 02:24:14
  from '/data/custom/panel_templates/Default/navbar.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.6',
  'unifunc' => 'content_6ab9c1bee3fb48_47288285',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '08a49957a4d9e09c94aea1eb29944c6433a558a8' => 
    array (
      0 => '/data/custom/panel_templates/Default/navbar.tpl',
      1 => 1790558301,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6ab9c1bee3fb48_47288285 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/data/vendor/smarty/smarty/libs/plugins/modifier.count.php','function'=>'smarty_modifier_count',),));
?>
<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- View Site and Dark Mode Buttons -->
    <a href="<?php echo $_smarty_tpl->tpl_vars['SITE_HOME']->value;?>
" target="_blank" class="btn btn-primary" style="margin-right: 20px"><?php echo $_smarty_tpl->tpl_vars['VIEW_SITE']->value;?>
</a>

    <div class="custom-control custom-switch">
        <input type="hidden" name="dark_mode" value="0">
        <input onclick="toggleDarkLightMode()" id="dark_mode" name="dark_mode" type="checkbox" class="custom-control-input"
            value="1">
        <label class="custom-control-label" for="dark_mode">
            <?php echo $_smarty_tpl->tpl_vars['MODE_TOGGLE']->value;?>

        </label>
    </div>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Alerts -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <?php if (smarty_modifier_count($_smarty_tpl->tpl_vars['NOTICES']->value) > 0) {?>
                <span class="badge badge-danger badge-counter"><?php echo smarty_modifier_count($_smarty_tpl->tpl_vars['NOTICES']->value);?>
</span>
                <?php }?>
            </a>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="alertsDropdown">
                <?php if (smarty_modifier_count($_smarty_tpl->tpl_vars['NOTICES']->value) == 0) {?>
                <span class="dropdown-item d-flex align-items-center"><?php echo $_smarty_tpl->tpl_vars['NO_NOTICES']->value;?>
</span>
                <?php } else { ?>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['NOTICES']->value, 'notice', false, 'url');
$_smarty_tpl->tpl_vars['notice']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['url']->value => $_smarty_tpl->tpl_vars['notice']->value) {
$_smarty_tpl->tpl_vars['notice']->do_else = false;
?>
                <a href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
" class="dropdown-item d-flex align-items-center"
                    style="color:#6c757d!important"><?php echo $_smarty_tpl->tpl_vars['notice']->value;?>
</a>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                <?php }?>
            </div>
        </li>

        <!-- Divider -->
        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link" href="<?php echo $_smarty_tpl->tpl_vars['LOGGED_IN_USER']->value['panel_profile'];?>
">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_smarty_tpl->tpl_vars['LOGGED_IN_USER']->value['nickname'];?>
</span>
                <img class="img-profile rounded-circle" src="<?php echo $_smarty_tpl->tpl_vars['LOGGED_IN_USER']->value['avatar'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['LOGGED_IN_USER']->value['username'];?>
">
            </a>
        </li>

    </ul>

</nav>
<!-- End of Topbar --><?php }
}
