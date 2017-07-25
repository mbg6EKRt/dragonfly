<?php /* Smarty version Smarty 3.1.4, created on 2017-07-25 20:43:41
         compiled from "cc5893a38aa5dedff615ed7e16e6172c1c95ec8e" */ ?>
<?php /*%%SmartyHeaderCode:5235126305977915da5b734-91144985%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cc5893a38aa5dedff615ed7e16e6172c1c95ec8e' => 
    array (
      0 => 'cc5893a38aa5dedff615ed7e16e6172c1c95ec8e',
      1 => 0,
      2 => 'string',
    ),
  ),
  'nocache_hash' => '5235126305977915da5b734-91144985',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'meta' => 0,
    'rooturl' => 0,
    'output' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_5977915db333b',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5977915db333b')) {function content_5977915db333b($_smarty_tpl) {?><!doctype html>
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

	<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['rooturl']->value;?>
/3rdparty/materialize/css/materialize.min.css" />

	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

	<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['rooturl']->value;?>
/3rdparty/jquery/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['rooturl']->value;?>
/3rdparty/materialize/js/materialize.min.js"></script>

</head>

<body>
	<!--
	<div class="main shadow" id="#parent">
	
		<table cellpadding="0" cellspacing="0" width="100%">
		
			<tr>

				<td class="_33"><h3>embed:page/hello-world</h3>{ embed:page/hello-world}</td>
				<td class="_33"><h3>Output from the request in the url:</h3>{ $output}</td>
				<td class="_33"><h3>task:page/about-us</h3>{ task:page/about-us}</td>
				
			</tr>
			
		</table>

	</div>
	-->
	<br />
<b>Notice</b>:  Undefined index: task in <b>/Applications/MAMP/htdocs/dragonfly/modules/dashboard/mod.dashboard.php</b> on line <b>25</b><br />

	<?php echo $_smarty_tpl->tpl_vars['output']->value;?>


</body>

</html><?php }} ?>