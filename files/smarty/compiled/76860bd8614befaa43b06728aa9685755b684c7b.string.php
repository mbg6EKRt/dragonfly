<?php /* Smarty version Smarty 3.1.4, created on 2013-10-05 15:04:08
         compiled from "76860bd8614befaa43b06728aa9685755b684c7b" */ ?>
<?php /*%%SmartyHeaderCode:2590652502a6862a6a8-88901404%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '76860bd8614befaa43b06728aa9685755b684c7b' => 
    array (
      0 => '76860bd8614befaa43b06728aa9685755b684c7b',
      1 => 0,
      2 => 'string',
    ),
  ),
  'nocache_hash' => '2590652502a6862a6a8-88901404',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'templateurl' => 0,
    'rooturl' => 0,
    'imagesurl' => 0,
    'sites_href' => 0,
    'isotope' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_52502a69372b4',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52502a69372b4')) {function content_52502a69372b4($_smarty_tpl) {?><div class="center menu">
	<a class="clickable _wb50 shadow" onclick="javascript: filter('.clickable');" title="Home"><img src="<?php echo $_smarty_tpl->tpl_vars['templateurl']->value;?>
/images/logo/wblogo.png" class="link-icon" /></a>
	<a class="clickable _wb50 shadow" onclick="javascript: filter('.create');">Create</a>
	<a class="clickable _wb50 shadow" onclick="javascript: filter('.administer');">Admin</a>
	<a class="clickable _wb50 shadow" onclick="javascript: filter('.system');">System</a>
	<a class="clickable _wb50 shadow" onclick="javascript: filter('.report');">Report</a>
	<!-- a class="clickable _wb50" onclick="javascript: filter('');">All Items</a -->
</div>

<div id="container">
	<div class="item clickable system sites float_left inlineblock" onclick="javascript:loadFrame('<?php echo $_smarty_tpl->tpl_vars['rooturl']->value;?>
/ajax/admin/sites/sites-admin');"><img src="<?php echo $_smarty_tpl->tpl_vars['imagesurl']->value;?>
internet-web-browser.png" /><br />Sites</div>
	<div class="item clickable create sites float_left inlineblock" onclick="javascript:loadFrame('<?php echo $_smarty_tpl->tpl_vars['rooturl']->value;?>
/ajax/admin/add-site');"><img src="<?php echo $_smarty_tpl->tpl_vars['imagesurl']->value;?>
internet-web-browser.png" /><br />Add Site</div>
	<div class="item clickable system modules float_left inlineblock" onclick="javascript:loadFrame('<?php echo $_smarty_tpl->tpl_vars['rooturl']->value;?>
/ajax/admin/modules/modules-admin');"><img src="<?php echo $_smarty_tpl->tpl_vars['imagesurl']->value;?>
package.png" /><br />Modules</div>
	<div class="item clickable create modules float_left inlineblock" onclick=""><img src="<?php echo $_smarty_tpl->tpl_vars['imagesurl']->value;?>
package.png" /><br />Add Module</div>
	<div class="item report grid2x2 float_left inlineblock" onclick="">Statistics</div>
	<div class="item report grid2x3 float_left inlineblock" onclick="">Recent Items</div>
	<div class="item report grid2x2 float_left inlineblock" onclick="">Server Summary</div>
	<div class="item clickable system tasks float_left inlineblock"><img src="<?php echo $_smarty_tpl->tpl_vars['imagesurl']->value;?>
blockdevice.png" /><br />Tasks</div>
	<div class="item clickable create tasks float_left inlineblock" onclick=""><img src="<?php echo $_smarty_tpl->tpl_vars['imagesurl']->value;?>
blockdevice.png" /><br />Add Task</div>
	<div class="item clickable system users float_left inlineblock" onclick="javascript:goto('<?php echo $_smarty_tpl->tpl_vars['sites_href']->value;?>
');"><img src="<?php echo $_smarty_tpl->tpl_vars['imagesurl']->value;?>
users.png" /><br />Users</div>
	<div class="item clickable create users float_left inlineblock" onclick="javascript:goto('<?php echo $_smarty_tpl->tpl_vars['sites_href']->value;?>
');"><img src="<?php echo $_smarty_tpl->tpl_vars['imagesurl']->value;?>
users.png" /><br />Add User</div>
	<div class="item clickable system themes float_left inlineblock" onclick="javascript:filter('.info');"><img src="<?php echo $_smarty_tpl->tpl_vars['imagesurl']->value;?>
kpaint_128x128-32.png" /><br />Themes</div>
	<div class="item clickable create themes float_left inlineblock" onclick="javascript:filter('.info');"><img src="<?php echo $_smarty_tpl->tpl_vars['imagesurl']->value;?>
kpaint_128x128-32.png" /><br />Add Theme</div>
	<div class="item clickable administer categories float_left inlineblock" onclick=""><img src="<?php echo $_smarty_tpl->tpl_vars['imagesurl']->value;?>
fsview.png" /><br />Categories</div>
	<div class="item clickable create categories float_left inlineblock"><img src="<?php echo $_smarty_tpl->tpl_vars['imagesurl']->value;?>
fsview.png" /><br />Add Category</div>
	<div class="item clickable administer news float_left inlineblock"><img src="<?php echo $_smarty_tpl->tpl_vars['imagesurl']->value;?>
knewsletter.png" /><br />News</div>
	<div class="item clickable create news float_left inlineblock"><img src="<?php echo $_smarty_tpl->tpl_vars['imagesurl']->value;?>
knewsletter.png" /><br />Add News</div>
	<div class="item clickable administer directory float_left inlineblock"><img src="<?php echo $_smarty_tpl->tpl_vars['imagesurl']->value;?>
kaddressbook.png" /><br />Directory</div>
	<div class="item clickable create directory float_left inlineblock"><img src="<?php echo $_smarty_tpl->tpl_vars['imagesurl']->value;?>
kaddressbook.png" /><br />Add Listing</div>
	<div class="item clickable administer email float_left inlineblock"><img src="<?php echo $_smarty_tpl->tpl_vars['imagesurl']->value;?>
internet-mail.png" /><br />Bulk Email</div>
	<div class="item clickable create email float_left inlineblock"><img src="<?php echo $_smarty_tpl->tpl_vars['imagesurl']->value;?>
internet-mail.png" /><br />New Email</div>
	<div class="item clickable report addtask float_left inlineblock" onclick="javascript:filter('.item');"><img src="<?php echo $_smarty_tpl->tpl_vars['imagesurl']->value;?>
internet-web-browser.png" /><br />Create Report</div>
	<div class="frame float_left inlineblock" id="frame_1"></div>
	<div class="frame float_left inlineblock" id="frame_2"></div>
</div>

<div id="loader" class="hidden center">Loading</div>

<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['isotope']->value;?>
"></script>
<script type="text/javascript"><!--

// Show dashboard using Isotope

var $container = $('#container');
var currentFrame = 'frame_1';
var frameToLoad = '#frame_1';

//$( '#loading_content' ).centerDiv( );

// initialize Isotope

$container.isotope(
{
	// options

	resizable: false, // disable normal resizing

	// set columnWidth to a percentage of container width

	masonry: { columnWidth: $container.width() / 5 }
});

// update columnWidth on window resize

$(window).smartresize(function()
{
	$container.isotope(
	{
		// update columnWidth to a percentage of container width

		masonry: { columnWidth: $container.width() / 5 }
	});
});

// Filter dashboard items according to selection

function filter( what )
{
	// Exclude the ajax content frame when rendering it
	
	if ( ( what != frameToLoad ) && ( $( frameToLoad ).html() != '' ) ) $( frameToLoad ).html( '' );
	
	// Filter the elements
	
	$('#container').isotope({ filter: what });
}

// Load a page into the dashboard iframe

function loadFrame( url, hidefirst )
{
	$( '#loader' ).loading( function( ) 
	{
		if ( currentFrame == "frame_1" )
		{
			currentFrame = "frame_2";
			frameToLoad = '#frame_1';
		}
		else
		{
			currentFrame = "frame_1";
			frameToLoad = '#frame_2';
		}

		$( frameToLoad ).load( url, function( response, status, xhr )
		{
			if ( status == 'success' )
			{
				filter( frameToLoad );
				$( '#loader' ).loaded( );
			}
			else
			{
				alert( 'Sorry, I was unable load the page. Please check your internet connection.' );
				$( '#loader' ).loaded( );
			}
		});
	});
}

// When the document is ready, set the default item filter

$( document ).ready( function( )
{
	filter( '.blank' );
	filter( '.clickable' );
});

// The loading screen

jQuery.fn.loading = function( callback )
{
	$( this ).width( $( document ).width( ) );
	$( this ).height( $( document ).height( ) );
	
	$( this ).css( 'background', '#000000' );
	$( this ).css( 'position', 'absolute' );
	$( this ).css( 'top', '0' );
	$( this ).css( 'left', '0' );
	$( this ).css( 'z-index', '999' );
	$( this ).css( 'opacity', '0.6' );

	$( this ).fadeIn( '50', callback );
};

jQuery.fn.loaded = function( )
{
	$( this ).fadeOut( '50' );
};

//--></script><?php }} ?>