<?php /* Smarty version Smarty 3.1.4, created on 2013-06-30 14:03:32
         compiled from "e7ad9f2ac6da2568b4666dbe0108ec4d9af1ae9a" */ ?>
<?php /*%%SmartyHeaderCode:1774051d03ab40765e5-20333714%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e7ad9f2ac6da2568b4666dbe0108ec4d9af1ae9a' => 
    array (
      0 => 'e7ad9f2ac6da2568b4666dbe0108ec4d9af1ae9a',
      1 => 0,
      2 => 'string',
    ),
  ),
  'nocache_hash' => '1774051d03ab40765e5-20333714',
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
  'unifunc' => 'content_51d03ab4b0831',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51d03ab4b0831')) {function content_51d03ab4b0831($_smarty_tpl) {?><div class="center menu">
	<a class="clickable _wb50 shadow" onclick="javascript: filter('.clickable');" title="Home"><img src="<?php echo $_smarty_tpl->tpl_vars['templateurl']->value;?>
/images/logo/wblogo.png" class="link-icon" /></a>
	<a class="clickable _wb50 shadow" onclick="javascript: filter('.create');">Create</a>
	<a class="clickable _wb50 shadow" onclick="javascript: filter('.administer');">Admin</a>
	<a class="clickable _wb50 shadow" onclick="javascript: filter('.system');">System</a>
	<a class="clickable _wb50 shadow" onclick="javascript: filter('.report');">Report</a>
	<!-- a class="clickable _wb50" onclick="javascript: filter('');">All Items</a -->
</div>

<div id="container">
	<div class="item clickable system sites" onclick="javascript:loadFrame('<?php echo $_smarty_tpl->tpl_vars['rooturl']->value;?>
/ajax/admin/sites/sites-admin');"><img src="<?php echo $_smarty_tpl->tpl_vars['imagesurl']->value;?>
internet-web-browser.png" /><br />Sites</div>
	<div class="item clickable create sites" onclick="javascript:loadFrame('<?php echo $_smarty_tpl->tpl_vars['rooturl']->value;?>
/ajax/admin/add-site');"><img src="<?php echo $_smarty_tpl->tpl_vars['imagesurl']->value;?>
internet-web-browser.png" /><br />Add Site</div>
	<div class="item clickable system modules"><img src="<?php echo $_smarty_tpl->tpl_vars['imagesurl']->value;?>
package.png" /><br />Modules</div>
	<div class="item clickable create modules" onclick=""><img src="<?php echo $_smarty_tpl->tpl_vars['imagesurl']->value;?>
package.png" /><br />Add Module</div>
	<div class="item report grid2x2" onclick="">Statistics</div>
	<div class="item report grid2x3" onclick="">Recent Items</div>
	<div class="item report grid2x2" onclick="">Server Summary</div>
	<div class="item clickable system tasks"><img src="<?php echo $_smarty_tpl->tpl_vars['imagesurl']->value;?>
blockdevice.png" /><br />Tasks</div>
	<div class="item clickable create tasks" onclick=""><img src="<?php echo $_smarty_tpl->tpl_vars['imagesurl']->value;?>
blockdevice.png" /><br />Add Task</div>
	<div class="item clickable system users" onclick="javascript:goto('<?php echo $_smarty_tpl->tpl_vars['sites_href']->value;?>
');"><img src="<?php echo $_smarty_tpl->tpl_vars['imagesurl']->value;?>
users.png" /><br />Users</div>
	<div class="item clickable create users" onclick="javascript:goto('<?php echo $_smarty_tpl->tpl_vars['sites_href']->value;?>
');"><img src="<?php echo $_smarty_tpl->tpl_vars['imagesurl']->value;?>
users.png" /><br />Add User</div>
	<div class="item clickable system themes" onclick="javascript:filter('.info');"><img src="<?php echo $_smarty_tpl->tpl_vars['imagesurl']->value;?>
kpaint_128x128-32.png" /><br />Themes</div>
	<div class="item clickable create themes" onclick="javascript:filter('.info');"><img src="<?php echo $_smarty_tpl->tpl_vars['imagesurl']->value;?>
kpaint_128x128-32.png" /><br />Add Theme</div>
	<div class="item clickable administer categories" onclick=""><img src="<?php echo $_smarty_tpl->tpl_vars['imagesurl']->value;?>
fsview.png" /><br />Categories</div>
	<div class="item clickable create categories"><img src="<?php echo $_smarty_tpl->tpl_vars['imagesurl']->value;?>
fsview.png" /><br />Add Category</div>
	<div class="item clickable administer news"><img src="<?php echo $_smarty_tpl->tpl_vars['imagesurl']->value;?>
knewsletter.png" /><br />News</div>
	<div class="item clickable create news"><img src="<?php echo $_smarty_tpl->tpl_vars['imagesurl']->value;?>
knewsletter.png" /><br />Add News</div>
	<div class="item clickable administer directory"><img src="<?php echo $_smarty_tpl->tpl_vars['imagesurl']->value;?>
kaddressbook.png" /><br />Directory</div>
	<div class="item clickable create directory"><img src="<?php echo $_smarty_tpl->tpl_vars['imagesurl']->value;?>
kaddressbook.png" /><br />Add Listing</div>
	<div class="item clickable administer email"><img src="<?php echo $_smarty_tpl->tpl_vars['imagesurl']->value;?>
internet-mail.png" /><br />Bulk Email</div>
	<div class="item clickable create email"><img src="<?php echo $_smarty_tpl->tpl_vars['imagesurl']->value;?>
internet-mail.png" /><br />New Email</div>
	<div class="item clickable report addtask" onclick="javascript:filter('.item');"><img src="<?php echo $_smarty_tpl->tpl_vars['imagesurl']->value;?>
internet-web-browser.png" /><br />Create Report</div>
	<div class="frame" id="frame_1"></div>
	<div class="frame" id="frame_2"></div>
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