<?php /* Smarty version Smarty-3.1.15, created on 2015-06-25 12:14:29
         compiled from "view/master_template.html" */ ?>
<?php /*%%SmartyHeaderCode:1005440060558bf0a59f70f8-08351097%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0c3a50b42a23c5b774011053c87d205fb47a6d77' => 
    array (
      0 => 'view/master_template.html',
      1 => 1435121522,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1005440060558bf0a59f70f8-08351097',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'basedomain' => 0,
    'admin' => 0,
    'content' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_558bf0a5a2a0c7_63248665',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_558bf0a5a2a0c7_63248665')) {function content_558bf0a5a2a0c7_63248665($_smarty_tpl) {?>
<?php echo $_smarty_tpl->getSubTemplate ("meta.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<body>
	<!-- RUNNING GLOBAL VAR -->
	<script>
		var basedomain = "<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
";
	</script>
	
	<!-- HEADER -->
    <div id="header">
		<?php if ($_smarty_tpl->tpl_vars['admin']->value) {?>
		<?php echo $_smarty_tpl->getSubTemplate ("menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		<?php }?>
	</div>
	
	
	<!-- CONTENT -->
	<div id="body" class="home">
		<?php echo $_smarty_tpl->tpl_vars['content']->value;?>

		
	</div>
	
	
	<!-- FOOTER -->
    <footer id="footer">
		
		<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	</footer>
	
</body> 
</html><?php }} ?>
