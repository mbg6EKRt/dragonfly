<?php /* Smarty version Smarty 3.1.4, created on 2017-07-25 20:43:02
         compiled from "b1144add76b886d3bdaff2d1b02ea44fa45ebea8" */ ?>
<?php /*%%SmartyHeaderCode:2067693107597791369eb3b6-22317706%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b1144add76b886d3bdaff2d1b02ea44fa45ebea8' => 
    array (
      0 => 'b1144add76b886d3bdaff2d1b02ea44fa45ebea8',
      1 => 0,
      2 => 'string',
    ),
  ),
  'nocache_hash' => '2067693107597791369eb3b6-22317706',
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
  'unifunc' => 'content_59779136b104f',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59779136b104f')) {function content_59779136b104f($_smarty_tpl) {?><!doctype html>
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
	<table cellpadding="10" cellspacing="0" style="background: #EAEAEA;"><tr><td style="padding-bottom: 0; font: bold 14px Arial; color: #000000;">$context</td></tr><tr><td><pre style="margin: 0; padding: 10px; color: #000000; background: #FFFFFF; display: block; border-top: 1px solid #AAAAAA;">base\config Object
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
            [id] => 14
            [name] => Pages
            [folder] => pages
            [file] => mod.pages.php
            [namespace] => a1e56b1719819be07494b142bdac61ecc1b8685b
            [class] => pages
            [meta_id] => 
            [access] => public
            [created] => 1320857636
            [modified] => 
        )

    [task] => Array
        (
            [id] => 41
            [module_id] => 14
            [name] => Display Page
            [task] => display
            [access] => public
            [created] => 1320864222
            [modified] => 
        )

    [view] => embed
    [request] => menu/display/58
)
</pre></td></tr></table><b>Displaying a page ...</b><br /><br />

<b>Site:</b> Materialize Blog (default)<br />
<b>Module:</b> Pages (default)<br />
<b>Task:</b> Display Page (default)<br />
<b>Request:</b> menu/display/58<br />
<b>Request params:</b> menu/display/58<br />
<b>Test url by namespace:</b> http://localhost/dragonfly/embed/page/some/params<br />
<b>Test url by id:</b> http://localhost/dragonfly/page/other/some/params<br />
Embedded version of a page
	<?php echo $_smarty_tpl->tpl_vars['output']->value;?>


</body>

</html><?php }} ?>