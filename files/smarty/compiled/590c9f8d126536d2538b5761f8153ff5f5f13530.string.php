<?php /* Smarty version Smarty 3.1.4, created on 2013-07-17 18:55:06
         compiled from "590c9f8d126536d2538b5761f8153ff5f5f13530" */ ?>
<?php /*%%SmartyHeaderCode:1312151e6e88abc3023-14692388%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '590c9f8d126536d2538b5761f8153ff5f5f13530' => 
    array (
      0 => '590c9f8d126536d2538b5761f8153ff5f5f13530',
      1 => 0,
      2 => 'string',
    ),
  ),
  'nocache_hash' => '1312151e6e88abc3023-14692388',
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
  'unifunc' => 'content_51e6e88c22951',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51e6e88c22951')) {function content_51e6e88c22951($_smarty_tpl) {?><!doctype html>
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

				<td class="_33"><h3>embed:page/hello-world</h3><table cellpadding="10" cellspacing="0" style="background: #EAEAEA;"><tr><td><pre style="margin: 0; padding: 10px; color: #000000; background: #FFFFFF; display: block; border-top: 1px solid #AAAAAA;">base\paths Object
(
    [rooturl] => http://localhost/dragonfly
    [rootpath] => C:/wamp/www/dragonfly
    [customPaths] => Array
        (
            [3rdpartyurl] => http://localhost/dragonfly/3rdparty
            [moduleurl] => http://localhost/dragonfly/modules
            [themeurl] => http://localhost/dragonfly/themes
            [3rdparty] => C:/wamp/www/dragonfly/3rdparty
            [lib] => C:/wamp/www/dragonfly/libs
            [module] => C:/wamp/www/dragonfly/modules
            [theme] => C:/wamp/www/dragonfly/themes
            [files] => C:/wamp/www/dragonfly/files
            [sites] => C:/wamp/www/dragonfly/sites
            [templateengine] => C:/wamp/www/dragonfly/3rdparty/smarty/Smarty.class.php
            [templateengine_compile_dir] => C:/wamp/www/dragonfly/files/smarty/compiled
        )

    [views] => Array
        (
            [0] => embed
            [1] => ajax
            [2] => file
            [3] => cli
        )

    [view] => embed
    [domain] => localhost
)
</pre></td></tr></table><table cellpadding="10" cellspacing="0" style="background: #EAEAEA;"><tr><td style="padding-bottom: 0; font: bold 14px Arial; color: #000000;">File contents</td></tr><tr><td><pre style="margin: 0; padding: 10px; color: #000000; background: #FFFFFF; display: block; border-top: 1px solid #AAAAAA;">&lt;module&gt;

	&lt;name&gt;Pages&lt;/name&gt;
	&lt;namespace&gt;a1e56b1719819be07494b142bdac61ecc1b8685b&lt;/namespace&gt;
	&lt;folder&gt;pages&lt;/folder&gt;
	&lt;file&gt;mod.pages.php&lt;/file&gt;
	&lt;class&gt;pages&lt;/class&gt;
	
	&lt;table&gt;
	
		&lt;name&gt;page&lt;/name&gt;
		&lt;encoding&gt;utf8_unicode_ci&lt;/encoding&gt;
		&lt;comment&gt;Stores page data such as name, description, file id, etc&lt;/comment&gt;
		
		&lt;column&gt;
			&lt;name&gt;id&lt;/name&gt;
			&lt;type&gt;integer&lt;/type&gt;
			&lt;length&gt;11&lt;/length&gt;
			&lt;primary&gt;1&lt;/primary&gt;
			&lt;autoincrement&gt;1&lt;/autoincrement&gt;
			&lt;comment&gt;The primary key.&lt;/comment&gt;
		&lt;/column&gt;
		
		&lt;column&gt;
			&lt;name&gt;name&lt;/name&gt;
			&lt;type&gt;varchar&lt;/type&gt;
			&lt;length&gt;255&lt;/length&gt;
			&lt;comment&gt;The name of the page.&lt;/comment&gt;
		&lt;/column&gt;
		
		&lt;column&gt;
			&lt;name&gt;description&lt;/name&gt;
			&lt;type&gt;text&lt;/type&gt;
			&lt;comment&gt;A short description of the page for use in the admin panel.&lt;/comment&gt;
		&lt;/column&gt;
		
		&lt;column&gt;
			&lt;name&gt;file_id&lt;/name&gt;
			&lt;type&gt;integer&lt;/type&gt;
			&lt;length&gt;11&lt;/length&gt;
			&lt;comment&gt;The ID of the file where the page content is stored.&lt;/comment&gt;
		&lt;/column&gt;
		
		&lt;column&gt;
			&lt;name&gt;search_terms&lt;/name&gt;
			&lt;type&gt;text&lt;/type&gt;
			&lt;comment&gt;A stripped down version of the page contents.&lt;/comment&gt;
		&lt;/column&gt;
		
		&lt;column&gt;
			&lt;name&gt;url_id&lt;/name&gt;
			&lt;type&gt;integer&lt;/type&gt;
			&lt;length&gt;11&lt;/length&gt;
			&lt;comment&gt;The ID of the url entry in the URL table.&lt;/comment&gt;
		&lt;/column&gt;
		
		&lt;column&gt;
			&lt;name&gt;meta_id&lt;/name&gt;
			&lt;type&gt;integer&lt;/type&gt;
			&lt;length&gt;11&lt;/length&gt;
			&lt;comment&gt;The ID of the meta data entry in the meta table.&lt;/comment&gt;
		&lt;/column&gt;
		
		&lt;column&gt;
			&lt;name&gt;created&lt;/name&gt;
			&lt;type&gt;integer&lt;/type&gt;
			&lt;length&gt;13&lt;/length&gt;
			&lt;comment&gt;A UNIX timestamp of when the page was first created.&lt;/comment&gt;
		&lt;/column&gt;
		
		&lt;column&gt;
			&lt;name&gt;modified&lt;/name&gt;
			&lt;type&gt;integer&lt;/type&gt;
			&lt;length&gt;13&lt;/length&gt;
			&lt;comment&gt;A UNIX timestamp of when the page was last modified.&lt;/comment&gt;
		&lt;/column&gt;
		
	&lt;/table&gt;
	
	&lt;table&gt;
	
		&lt;name&gt;site__page&lt;/name&gt;
		&lt;encoding&gt;utf8_unicode_ci&lt;/encoding&gt;
		&lt;comment&gt;This table stores relationships between pages and sites.&lt;/comment&gt;
		
		&lt;column&gt;
			&lt;name&gt;site_id&lt;/name&gt;
			&lt;type&gt;integer&lt;/type&gt;
			&lt;length&gt;11&lt;/length&gt;
			&lt;comment&gt;The site id.&lt;/comment&gt;
		&lt;/column&gt;
		
		&lt;column&gt;
			&lt;name&gt;page_id&lt;/name&gt;
			&lt;type&gt;integer&lt;/type&gt;
			&lt;length&gt;11&lt;/length&gt;
			&lt;comment&gt;The page id.&lt;/comment&gt;
		&lt;/column&gt;
		
	&lt;/table&gt;

&lt;/module&gt;</pre></td></tr></table><table cellpadding="10" cellspacing="0" style="background: #EAEAEA;"><tr><td style="padding-bottom: 0; font: bold 14px Arial; color: #000000;">XML > Array</td></tr><tr><td><pre style="margin: 0; padding: 10px; color: #000000; background: #FFFFFF; display: block; border-top: 1px solid #AAAAAA;">Array
(
    [module] => Array
        (
            [name] => Pages
            [namespace] => a1e56b1719819be07494b142bdac61ecc1b8685b
            [folder] => pages
            [file] => mod.pages.php
            [class] => pages
            [table] => Array
                (
                    [0] => Array
                        (
                            [name] => page
                            [encoding] => utf8_unicode_ci
                            [comment] => Stores page data such as name, description, file id, etc
                            [column] => Array
                                (
                                    [0] => Array
                                        (
                                            [name] => id
                                            [type] => integer
                                            [length] => 11
                                            [primary] => 1
                                            [autoincrement] => 1
                                            [comment] => The primary key.
                                        )

                                    [1] => Array
                                        (
                                            [name] => name
                                            [type] => varchar
                                            [length] => 255
                                            [comment] => The name of the page.
                                        )

                                    [2] => Array
                                        (
                                            [name] => description
                                            [type] => text
                                            [comment] => A short description of the page for use in the admin panel.
                                        )

                                    [3] => Array
                                        (
                                            [name] => file_id
                                            [type] => integer
                                            [length] => 11
                                            [comment] => The ID of the file where the page content is stored.
                                        )

                                    [4] => Array
                                        (
                                            [name] => search_terms
                                            [type] => text
                                            [comment] => A stripped down version of the page contents.
                                        )

                                    [5] => Array
                                        (
                                            [name] => url_id
                                            [type] => integer
                                            [length] => 11
                                            [comment] => The ID of the url entry in the URL table.
                                        )

                                    [6] => Array
                                        (
                                            [name] => meta_id
                                            [type] => integer
                                            [length] => 11
                                            [comment] => The ID of the meta data entry in the meta table.
                                        )

                                    [7] => Array
                                        (
                                            [name] => created
                                            [type] => integer
                                            [length] => 13
                                            [comment] => A UNIX timestamp of when the page was first created.
                                        )

                                    [8] => Array
                                        (
                                            [name] => modified
                                            [type] => integer
                                            [length] => 13
                                            [comment] => A UNIX timestamp of when the page was last modified.
                                        )

                                )

                        )

                    [1] => Array
                        (
                            [name] => site__page
                            [encoding] => utf8_unicode_ci
                            [comment] => This table stores relationships between pages and sites.
                            [column] => Array
                                (
                                    [0] => Array
                                        (
                                            [name] => site_id
                                            [type] => integer
                                            [length] => 11
                                            [comment] => The site id.
                                        )

                                    [1] => Array
                                        (
                                            [name] => page_id
                                            [type] => integer
                                            [length] => 11
                                            [comment] => The page id.
                                        )

                                )

                        )

                )

        )

)
</pre></td></tr></table><table cellpadding="10" cellspacing="0" style="background: #EAEAEA;"><tr><td style="padding-bottom: 0; font: bold 14px Arial; color: #000000;">Array > XML</td></tr><tr><td><pre style="margin: 0; padding: 10px; color: #000000; background: #FFFFFF; display: block; border-top: 1px solid #AAAAAA;">
&lt;module&gt;
&lt;name&gt;Pages&lt;/name&gt;
&lt;namespace&gt;a1e56b1719819be07494b142bdac61ecc1b8685b&lt;/namespace&gt;
&lt;folder&gt;pages&lt;/folder&gt;
&lt;file&gt;mod.pages.php&lt;/file&gt;
&lt;class&gt;pages&lt;/class&gt;
&lt;table&gt;
&lt;name&gt;page&lt;/name&gt;
&lt;encoding&gt;utf8_unicode_ci&lt;/encoding&gt;
&lt;comment&gt;Stores page data such as name, description, file id, etc&lt;/comment&gt;
&lt;column&gt;
&lt;name&gt;id&lt;/name&gt;
&lt;type&gt;integer&lt;/type&gt;
&lt;length&gt;11&lt;/length&gt;
&lt;primary&gt;1&lt;/primary&gt;
&lt;autoincrement&gt;1&lt;/autoincrement&gt;
&lt;comment&gt;The primary key.&lt;/comment&gt;
&lt;/column&gt;
&lt;column&gt;
&lt;name&gt;name&lt;/name&gt;
&lt;type&gt;varchar&lt;/type&gt;
&lt;length&gt;255&lt;/length&gt;
&lt;comment&gt;The name of the page.&lt;/comment&gt;
&lt;/column&gt;
&lt;column&gt;
&lt;name&gt;description&lt;/name&gt;
&lt;type&gt;text&lt;/type&gt;
&lt;comment&gt;A short description of the page for use in the admin panel.&lt;/comment&gt;
&lt;/column&gt;
&lt;column&gt;
&lt;name&gt;file_id&lt;/name&gt;
&lt;type&gt;integer&lt;/type&gt;
&lt;length&gt;11&lt;/length&gt;
&lt;comment&gt;The ID of the file where the page content is stored.&lt;/comment&gt;
&lt;/column&gt;
&lt;column&gt;
&lt;name&gt;search_terms&lt;/name&gt;
&lt;type&gt;text&lt;/type&gt;
&lt;comment&gt;A stripped down version of the page contents.&lt;/comment&gt;
&lt;/column&gt;
&lt;column&gt;
&lt;name&gt;url_id&lt;/name&gt;
&lt;type&gt;integer&lt;/type&gt;
&lt;length&gt;11&lt;/length&gt;
&lt;comment&gt;The ID of the url entry in the URL table.&lt;/comment&gt;
&lt;/column&gt;
&lt;column&gt;
&lt;name&gt;meta_id&lt;/name&gt;
&lt;type&gt;integer&lt;/type&gt;
&lt;length&gt;11&lt;/length&gt;
&lt;comment&gt;The ID of the meta data entry in the meta table.&lt;/comment&gt;
&lt;/column&gt;
&lt;column&gt;
&lt;name&gt;created&lt;/name&gt;
&lt;type&gt;integer&lt;/type&gt;
&lt;length&gt;13&lt;/length&gt;
&lt;comment&gt;A UNIX timestamp of when the page was first created.&lt;/comment&gt;
&lt;/column&gt;
&lt;column&gt;
&lt;name&gt;modified&lt;/name&gt;
&lt;type&gt;integer&lt;/type&gt;
&lt;length&gt;13&lt;/length&gt;
&lt;comment&gt;A UNIX timestamp of when the page was last modified.&lt;/comment&gt;
&lt;/column&gt;
&lt;/table&gt;
&lt;table&gt;
&lt;name&gt;site__page&lt;/name&gt;
&lt;encoding&gt;utf8_unicode_ci&lt;/encoding&gt;
&lt;comment&gt;This table stores relationships between pages and sites.&lt;/comment&gt;
&lt;column&gt;
&lt;name&gt;site_id&lt;/name&gt;
&lt;type&gt;integer&lt;/type&gt;
&lt;length&gt;11&lt;/length&gt;
&lt;comment&gt;The site id.&lt;/comment&gt;
&lt;/column&gt;
&lt;column&gt;
&lt;name&gt;page_id&lt;/name&gt;
&lt;type&gt;integer&lt;/type&gt;
&lt;length&gt;11&lt;/length&gt;
&lt;comment&gt;The page id.&lt;/comment&gt;
&lt;/column&gt;
&lt;/table&gt;
&lt;/module&gt;</pre></td></tr></table></td>
				<td class="_33"><h3>Output from the request in the url:</h3><?php echo $_smarty_tpl->tpl_vars['output']->value;?>
</td>
				<td class="_33"><h3>task:page/about-us</h3><table cellpadding="10" cellspacing="0" style="background: #EAEAEA;"><tr><td><pre style="margin: 0; padding: 10px; color: #000000; background: #FFFFFF; display: block; border-top: 1px solid #AAAAAA;">base\paths Object
(
    [rooturl] => http://localhost/dragonfly
    [rootpath] => C:/wamp/www/dragonfly
    [customPaths] => Array
        (
            [3rdpartyurl] => http://localhost/dragonfly/3rdparty
            [moduleurl] => http://localhost/dragonfly/modules
            [themeurl] => http://localhost/dragonfly/themes
            [3rdparty] => C:/wamp/www/dragonfly/3rdparty
            [lib] => C:/wamp/www/dragonfly/libs
            [module] => C:/wamp/www/dragonfly/modules
            [theme] => C:/wamp/www/dragonfly/themes
            [files] => C:/wamp/www/dragonfly/files
            [sites] => C:/wamp/www/dragonfly/sites
            [templateengine] => C:/wamp/www/dragonfly/3rdparty/smarty/Smarty.class.php
            [templateengine_compile_dir] => C:/wamp/www/dragonfly/files/smarty/compiled
        )

    [views] => Array
        (
            [0] => embed
            [1] => ajax
            [2] => file
            [3] => cli
        )

    [view] => 
    [domain] => localhost
)
</pre></td></tr></table>Hello Cli!</td>
				
			</tr>
			
		</table>

	</div>

</body>

</html><?php }} ?>