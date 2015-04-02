<?php /* Smarty version Smarty 3.1.4, created on 2013-08-23 09:35:20
         compiled from "9ec9ca3e9518e66f6788429333efcc923108b13f" */ ?>
<?php /*%%SmartyHeaderCode:1798052172cd8182dd0-53003687%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9ec9ca3e9518e66f6788429333efcc923108b13f' => 
    array (
      0 => '9ec9ca3e9518e66f6788429333efcc923108b13f',
      1 => 0,
      2 => 'string',
    ),
  ),
  'nocache_hash' => '1798052172cd8182dd0-53003687',
  'function' => 
  array (
    'showentities' => 
    array (
      'parameter' => 
      array (
      ),
      'compiled' => '',
    ),
  ),
  'variables' => 
  array (
    'entities' => 0,
    'subentities' => 0,
    'entity' => 0,
  ),
  'has_nocache_code' => 0,
  'version' => 'Smarty 3.1.4',
  'unifunc' => 'content_52172cd8472d3',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52172cd8472d3')) {function content_52172cd8472d3($_smarty_tpl) {?><div><h1><?php echo $_smarty_tpl->tpl_vars['entities']->value['name'];?>
</h1>
<?php echo $_smarty_tpl->tpl_vars['entities']->value['description'];?>

<?php if (!function_exists('smarty_template_function_showentities')) {
    function smarty_template_function_showentities($_smarty_tpl,$params) {
    $saved_tpl_vars = $_smarty_tpl->tpl_vars;
    foreach ($_smarty_tpl->smarty->template_functions['showentities']['parameter'] as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);};
    foreach ($params as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);}?>
	<?php  $_smarty_tpl->tpl_vars['entity'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['entity']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['subentities']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['entity']->key => $_smarty_tpl->tpl_vars['entity']->value){
$_smarty_tpl->tpl_vars['entity']->_loop = true;
?>
		<div style="padding-left:30px;"><h2><?php echo $_smarty_tpl->tpl_vars['entity']->value['name'];?>
</h2><?php echo $_smarty_tpl->tpl_vars['entity']->value['description'];?>

		<?php smarty_template_function_showentities($_smarty_tpl,array('subentities'=>$_smarty_tpl->tpl_vars['entity']->value['entities']));?>
</div>
	<?php } ?><?php $_smarty_tpl->tpl_vars = $saved_tpl_vars;}}?>

</div>

<?php smarty_template_function_showentities($_smarty_tpl,array('subentities'=>$_smarty_tpl->tpl_vars['entities']->value['entities']));?>
<?php }} ?>