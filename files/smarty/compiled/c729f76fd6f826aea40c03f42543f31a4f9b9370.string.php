<?php /* Smarty version Smarty 3.1.4, created on 2017-07-23 02:00:08
         compiled from "c729f76fd6f826aea40c03f42543f31a4f9b9370" */ ?>
<?php /*%%SmartyHeaderCode:4652756575973e7089d0fb6-56880560%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c729f76fd6f826aea40c03f42543f31a4f9b9370' => 
    array (
      0 => 'c729f76fd6f826aea40c03f42543f31a4f9b9370',
      1 => 0,
      2 => 'string',
    ),
  ),
  'nocache_hash' => '4652756575973e7089d0fb6-56880560',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'meta' => 0,
    'defaultTemplate' => 0,
    'templateurl' => 0,
    'scripts' => 0,
    'output' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_5973e708a25e1',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5973e708a25e1')) {function content_5973e708a25e1($_smarty_tpl) {?><!doctype html>
<html>

<head>

	<title><?php echo $_smarty_tpl->tpl_vars['meta']->value['title'];?>
</title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="PRAGMA" content="<?php echo $_smarty_tpl->tpl_vars['meta']->value['cache'];?>
" />

	<meta name="title" content="<?php echo $_smarty_tpl->tpl_vars['meta']->value['title'];?>
" />
	<meta name="author" content="<?php echo $_smarty_tpl->tpl_vars['meta']->value['author'];?>
" />
	<meta name="copyright" content="<?php echo $_smarty_tpl->tpl_vars['meta']->value['copyright'];?>
" />
	<meta name="description" content="<?php echo $_smarty_tpl->tpl_vars['meta']->value['description'];?>
" />
	<meta name="keywords" content="<?php echo $_smarty_tpl->tpl_vars['meta']->value['keywords'];?>
" />
	<meta name="robots" content="<?php echo $_smarty_tpl->tpl_vars['meta']->value['indexed'];?>
,<?php echo $_smarty_tpl->tpl_vars['meta']->value['follow'];?>
" />

	<!-- Load default stylesheet first so we can override default styles in the theme stylesheet -->
	<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['defaultTemplate']->value;?>
/css/default.css" />

	<!-- Load theme specific stylesheets -->
	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 750px)" href="<?php echo $_smarty_tpl->tpl_vars['templateurl']->value;?>
/css/tablet.css">
	
	<!-- Load styles for larger screens -->
	<!--
	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 1000px)" href="<?php echo $_smarty_tpl->tpl_vars['templateurl']->value;?>
/css/computer.css">
	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 1850px)" href="<?php echo $_smarty_tpl->tpl_vars['templateurl']->value;?>
/css/hd.css">
	-->

	<script src="<?php echo $_smarty_tpl->tpl_vars['scripts']->value['jquery'];?>
"></script>

</head>

<body>

	<table class="_100" cellspacing="0" cellpadding="0"><tr><td align="center">

		<div class="main left">

			<div class="content"><?php echo $_smarty_tpl->tpl_vars['output']->value;?>
</div>

		</div>

	</td></tr></table>

</body>

</html>
<?php }} ?>