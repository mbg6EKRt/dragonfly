<?php /* Smarty version Smarty 3.1.4, created on 2017-07-25 20:59:07
         compiled from "482fb4bace765a54e39e02c38c6bf928dc591d51" */ ?>
<?php /*%%SmartyHeaderCode:768553416597794fb0b2c08-10498572%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '482fb4bace765a54e39e02c38c6bf928dc591d51' => 
    array (
      0 => '482fb4bace765a54e39e02c38c6bf928dc591d51',
      1 => 0,
      2 => 'string',
    ),
  ),
  'nocache_hash' => '768553416597794fb0b2c08-10498572',
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
  'unifunc' => 'content_597794fb1aa4a',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_597794fb1aa4a')) {function content_597794fb1aa4a($_smarty_tpl) {?><!doctype html>
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
	<table cellpadding="10" cellspacing="0" style="background: #EAEAEA;"><tr><td><pre style="margin: 0; padding: 10px; color: #000000; background: #FFFFFF; display: block; border-top: 1px solid #AAAAAA;">base\config Object
(
    [site] => Array
        (
            [id] => 13
            [name] => Materialize Blog
            [folder] => fy3pbiccy7nm8
            [default] => 1
            [default_task] => 41
            [default_layout] => 51
            [domain] => 
            [meta_id] => 148
            [logo_file_id] => 
            [access] => public
            [created] => 1363892197
            [modified] => 1363894921
            [foreignid] => 124
            [url] => YMAASA
            [table] => site
            [pk] => id
        )

    [module] => Array
        (
            [id] => 56
            [name] => Menu
            [folder] => menu
            [file] => mod.menu.php
            [namespace] => b65573df2fb6bd349278d490c1fd3749eea79f33
            [class] => menu
            [meta_id] => 
            [access] => public
            [created] => 1321566423
            [modified] => 
        )

    [task] => Array
        (
            [id] => 63
            [foreignid] => 63
            [url] => display-menu
            [table] => task
            [pk] => id
            [module_id] => 56
            [name] => Display Menu
            [task] => display
            [access] => public
            [created] => 1501008750
            [modified] => 
        )

    [view] => embed
    [request] => display-menu/58
)
</pre></td></tr></table><table cellpadding="10" cellspacing="0" style="background: #EAEAEA;"><tr><td><pre style="margin: 0; padding: 10px; color: #000000; background: #FFFFFF; display: block; border-top: 1px solid #AAAAAA;">Array
(
)
</pre></td></tr></table><table cellpadding="10" cellspacing="0" style="background: #EAEAEA;"><tr><td><pre style="margin: 0; padding: 10px; color: #000000; background: #FFFFFF; display: block; border-top: 1px solid #AAAAAA;"></pre></td></tr></table><table class="menu">

	<tr>

			<td><a href="">Admin Menu</a></td>
		<td width="5"></td>
	
	</tr>

</table>
	<?php echo $_smarty_tpl->tpl_vars['output']->value;?>


</body>

</html><?php }} ?>