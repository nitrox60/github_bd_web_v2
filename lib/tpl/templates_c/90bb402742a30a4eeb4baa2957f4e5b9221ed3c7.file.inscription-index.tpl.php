<?php /* Smarty version Smarty-3.1.1, created on 2013-03-02 18:05:14
         compiled from "modules\inscription\tpl\inscription-index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1392151323f5ab1a334-75178567%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '90bb402742a30a4eeb4baa2957f4e5b9221ed3c7' => 
    array (
      0 => 'modules\\inscription\\tpl\\inscription-index.tpl',
      1 => 1362246305,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1392151323f5ab1a334-75178567',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'f_ins' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.1',
  'unifunc' => 'content_51323f5ab7614',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51323f5ab7614')) {function content_51323f5ab7614($_smarty_tpl) {?>﻿


Inscription :
<?php echo $_smarty_tpl->tpl_vars['f_ins']->value;?>




<div style="clear:both;"></div>
<script src="./js/jquery-1.4.3.min.js"></script>
<script src="./js/inscription.js"></script>
<?php }} ?>