<?php /* Smarty version Smarty 3.1.4, created on 2013-08-22 23:41:50
         compiled from "43846575d593e539ca1ccf653241d8ec161b93ab" */ ?>
<?php /*%%SmartyHeaderCode:231735216a1be96d0e6-14273705%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '43846575d593e539ca1ccf653241d8ec161b93ab' => 
    array (
      0 => '43846575d593e539ca1ccf653241d8ec161b93ab',
      1 => 0,
      2 => 'string',
    ),
  ),
  'nocache_hash' => '231735216a1be96d0e6-14273705',
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
  'unifunc' => 'content_5216a1bf1f080',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5216a1bf1f080')) {function content_5216a1bf1f080($_smarty_tpl) {?><!doctype html>
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
    [entity] => Array
        (
            [0] => Array
                (
                    [id] => 1
                    [name] => Google
                    [description] => A massive company that has grown beyond a simple search engine.
                    [content_file_id] => 
                    [created] => 1377213593
                    [modified] => 
                )

        )

    [entityrel] => Array
        (
            [_error] => 1
            [_description] => Unable to execute query.
            [_query] => SELECT * FROM ent WHERE ``=1 OR ``=1
            [_file] => C:\wamp\www\dragonfly\base\class.pdo.php
            [_function] => exec
            [_stack] => Array
                (
                    [0] => 42S22
                    [1] => 1054
                    [2] => Unknown column '' in 'where clause'
                )

        )

)
</pre></td></tr></table></td>
				<td class="_33"><h3>Output from the request in the url:</h3><?php echo $_smarty_tpl->tpl_vars['output']->value;?>
</td>
				<td class="_33"><h3>task:page/about-us</h3>task version of a page<table cellpadding="10" cellspacing="0" style="background: #EAEAEA;"><tr><td><pre style="margin: 0; padding: 10px; color: #000000; background: #FFFFFF; display: block; border-top: 1px solid #AAAAAA;">Array
(
    [entity] => Array
        (
            [0] => Array
                (
                    [id] => 1
                    [name] => Google
                    [description] => A massive company that has grown beyond a simple search engine.
                    [content_file_id] => 
                    [created] => 1377213593
                    [modified] => 
                )

        )

    [entityrel] => Array
        (
            [_error] => 1
            [_description] => Unable to execute query.
            [_query] => SELECT * FROM ent WHERE ``=1 OR ``=1
            [_file] => C:\wamp\www\dragonfly\base\class.pdo.php
            [_function] => exec
            [_stack] => Array
                (
                    [0] => 42S22
                    [1] => 1054
                    [2] => Unknown column '' in 'where clause'
                )

        )

)
</pre></td></tr></table></td>
				
			</tr>
			
		</table>

	</div>

</body>

</html><?php }} ?>