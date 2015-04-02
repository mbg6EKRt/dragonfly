<?php /* Smarty version Smarty 3.1.4, created on 2013-08-23 00:02:38
         compiled from "db778e17d5c5a5c38ec1543351fcead7450f0768" */ ?>
<?php /*%%SmartyHeaderCode:238885216a69e223c21-76153496%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'db778e17d5c5a5c38ec1543351fcead7450f0768' => 
    array (
      0 => 'db778e17d5c5a5c38ec1543351fcead7450f0768',
      1 => 0,
      2 => 'string',
    ),
  ),
  'nocache_hash' => '238885216a69e223c21-76153496',
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
  'unifunc' => 'content_5216a69eb173e',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5216a69eb173e')) {function content_5216a69eb173e($_smarty_tpl) {?><!doctype html>
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
            [id] => 2
            [name] => Android
            [description] => A mobile operating system for phones and tablets developed by Google.
            [content_file_id] => 
            [created] => 1377213593
            [modified] => 
        )

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
                    [id1] => 2
                    [id2] => 3
                    [name] => was used on Samsung phones and tablets
                    [description] => Samsung used Android for the operating system of their smart phones and tablets.
                    [content_file_id] => 
                    [created] => 1377214267
                    [modified] => 
                )

        )

    [entities] => Array
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

            [1] => Array
                (
                    [id] => 3
                    [name] => Samsung
                    [description] => A mobile phone and tablet manufacturer that uses Android.
                    [content_file_id] => 
                    [created] => 1377213778
                    [modified] => 
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
            [id] => 2
            [name] => Android
            [description] => A mobile operating system for phones and tablets developed by Google.
            [content_file_id] => 
            [created] => 1377213593
            [modified] => 
        )

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
                    [id1] => 2
                    [id2] => 3
                    [name] => was used on Samsung phones and tablets
                    [description] => Samsung used Android for the operating system of their smart phones and tablets.
                    [content_file_id] => 
                    [created] => 1377214267
                    [modified] => 
                )

        )

    [entities] => Array
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

            [1] => Array
                (
                    [id] => 3
                    [name] => Samsung
                    [description] => A mobile phone and tablet manufacturer that uses Android.
                    [content_file_id] => 
                    [created] => 1377213778
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