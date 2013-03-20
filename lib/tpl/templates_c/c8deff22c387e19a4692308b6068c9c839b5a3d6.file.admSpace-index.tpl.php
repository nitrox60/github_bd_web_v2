<?php /* Smarty version Smarty-3.1.1, created on 2013-03-04 08:38:03
         compiled from "modules\admSpace\tpl\admSpace-index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1170251345d6b5c5f03-37691422%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c8deff22c387e19a4692308b6068c9c839b5a3d6' => 
    array (
      0 => 'modules\\admSpace\\tpl\\admSpace-index.tpl',
      1 => 1361981501,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1170251345d6b5c5f03-37691422',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.1',
  'unifunc' => 'content_51345d6b63a61',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51345d6b63a61')) {function content_51345d6b63a61($_smarty_tpl) {?>﻿
<link rel="stylesheet" href="./styles/admSpace.css"/>
<h2>Espace administration</h2>

<span class="link">
	<img src="./images/admMarque.jpg" class="clickable"/><a href="?module=admMarque">Administration des marques</a>
</span>

<span class="link">
	<img src="./images/admClient.jpg" class="clickable"/><a href="?module=admClient">Administration des clients</a>
</span>

<span class="link link2">
	<img src="./images/admloc.jpg" class="clickable"/><a href="?module=admloc">Administration des locations</a>
</span>


<div style="clear:both;"></div>
<script src="./js/jquery-1.4.3.min.js"></script>
<script src="./js/admSpace-index.js"></script><?php }} ?>