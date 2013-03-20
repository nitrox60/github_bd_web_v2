<?php /* Smarty version Smarty-3.1.1, created on 2013-03-07 19:30:54
         compiled from "modules\loc\tpl\loc-rent.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3122151345d11978ad7-02380262%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f0e010e4c192efd05876531992c19a14a7c667fe' => 
    array (
      0 => 'modules\\loc\\tpl\\loc-rent.tpl',
      1 => 1362684652,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3122151345d11978ad7-02380262',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.1',
  'unifunc' => 'content_51345d11b380b',
  'variables' => 
  array (
    'f_rent' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51345d11b380b')) {function content_51345d11b380b($_smarty_tpl) {?>﻿<link rel="stylesheet" href="./styles/loc-rent.css"/>
<div id="load"><img id="loaderimg" src="./images/loader_rent.gif"/></div>
<div id="infolocbox">
<h2>Disponibilité location</h2><div id="infoloc"><img src="./images/loader.gif"/></div>
</div>
<?php echo $_smarty_tpl->tpl_vars['f_rent']->value;?>

<div style="clear:both;"></div>


<script src="./js/jquery-1.4.3.min.js"></script>
<script src="./js/jquery-ui-1.8.5.custom.min.js"></script>

<script src="./js/loc-rent.js"></script>
<?php }} ?>