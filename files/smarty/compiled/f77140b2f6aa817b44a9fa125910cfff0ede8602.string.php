<?php /* Smarty version Smarty 3.1.4, created on 2013-08-23 00:46:11
         compiled from "f77140b2f6aa817b44a9fa125910cfff0ede8602" */ ?>
<?php /*%%SmartyHeaderCode:323805216b0d3cede54-28374910%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f77140b2f6aa817b44a9fa125910cfff0ede8602' => 
    array (
      0 => 'f77140b2f6aa817b44a9fa125910cfff0ede8602',
      1 => 0,
      2 => 'string',
    ),
  ),
  'nocache_hash' => '323805216b0d3cede54-28374910',
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
  'unifunc' => 'content_5216b0d44dfc0',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5216b0d44dfc0')) {function content_5216b0d44dfc0($_smarty_tpl) {?><!doctype html>
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

	<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['defaultTemplate']->value;?>
/css/default.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['templateurl']->value;?>
/css/main.css" />

	<script src="<?php echo $_smarty_tpl->tpl_vars['scripts']->value['jquery'];?>
"></script>

</head>

<body>

	<div class="main shadow">
	
		<table cellpadding="0" cellspacing="0" width="100%">
		
			<tr>

				<td class="_33"><h3>embed:page/hello-world</h3>Embedded version of a page<table cellpadding="10" cellspacing="0" style="background: #EAEAEA;"><tr><td><pre style="margin: 0; padding: 10px; color: #000000; background: #FFFFFF; display: block; border-top: 1px solid #AAAAAA;">Array
(
    [id] => 1
    [name] => Google
    [description] => A massive company that has grown beyond a simple search engine.
    [content_file_id] => 
    [created] => 1377213593
    [modified] => 
    [callerid] => 0
    [rel] => Array
        (
            [0] => Array
                (
                    [id1] => 1
                    [id2] => 2
                    [name] => Develops
                    [description] => The Android operating system is developed by Google and implemented by companies like Samsung.
                    [content_file_id] => 
                    [created] => 1377214267
                    [modified] => 
                )

            [1] => Array
                (
                    [id1] => 1
                    [id2] => 4
                    [name] => owns and developed
                    [description] => Google Maps is a product developed by Google. It displays a map and allows users to get directions, see a street view, see places nearby and draw custom shapes and routes.
                    [content_file_id] => 
                    [created] => 1377214503
                    [modified] => 
                )

        )

)
</pre></td></tr></table></td>
				<td class="_33"><h3>Output from the request in the url:</h3><?php echo $_smarty_tpl->tpl_vars['output']->value;?>
</td>
				<td class="_33"><h3>task:page/about-us</h3>task version of a page<table cellpadding="10" cellspacing="0" style="background: #EAEAEA;"><tr><td><pre style="margin: 0; padding: 10px; color: #000000; background: #FFFFFF; display: block; border-top: 1px solid #AAAAAA;">Array
(
    [id] => 1
    [name] => Google
    [description] => A massive company that has grown beyond a simple search engine.
    [content_file_id] => 
    [created] => 1377213593
    [modified] => 
    [callerid] => 0
    [rel] => Array
        (
            [0] => Array
                (
                    [id1] => 1
                    [id2] => 2
                    [name] => Develops
                    [description] => The Android operating system is developed by Google and implemented by companies like Samsung.
                    [content_file_id] => 
                    [created] => 1377214267
                    [modified] => 
                )

            [1] => Array
                (
                    [id1] => 1
                    [id2] => 4
                    [name] => owns and developed
                    [description] => Google Maps is a product developed by Google. It displays a map and allows users to get directions, see a street view, see places nearby and draw custom shapes and routes.
                    [content_file_id] => 
                    [created] => 1377214503
                    [modified] => 
                )

        )

)
</pre></td></tr></table></td>
				
			</tr>
			
		</table>

	</div>

</body>

</html><?php }} ?>