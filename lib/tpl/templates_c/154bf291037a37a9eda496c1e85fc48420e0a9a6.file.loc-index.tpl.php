<?php /* Smarty version Smarty-3.1.1, created on 2013-03-13 15:44:47
         compiled from "modules\loc\tpl\loc-index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1261051323f640b8fd7-97528321%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '154bf291037a37a9eda496c1e85fc48420e0a9a6' => 
    array (
      0 => 'modules\\loc\\tpl\\loc-index.tpl',
      1 => 1363189449,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1261051323f640b8fd7-97528321',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.1',
  'unifunc' => 'content_51323f6413c54',
  'variables' => 
  array (
    'f_loc' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51323f6413c54')) {function content_51323f6413c54($_smarty_tpl) {?>﻿<link rel="stylesheet" href="./styles/loc-index.css"/>

<div id="test"></div>
<?php echo $_smarty_tpl->tpl_vars['f_loc']->value;?>

<div id="test2"><a href="#"></a></div>
<div id="car"></div>
<div id="infos"></div>
<span id="load"></span>
<div style="clear:both;"></div>

<script src="./js/jquery-1.4.3.min.js"></script>
<script src="./js/loc-index.js"></script>
	<noscript>
<div id="nojs"><meta http-equiv="refresh" content="1; URL=?module=loc&action=nojs"></div>
</noscript><?php }} ?>