<?php /* Smarty version Smarty-3.1.1, created on 2013-03-21 10:46:57
         compiled from "modules\admMarque\tpl\admMarque-index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19028514ae5219d07f1-95988605%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '204c0b846ecb464453496e638de8017b791726f0' => 
    array (
      0 => 'modules\\admMarque\\tpl\\admMarque-index.tpl',
      1 => 1361983795,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19028514ae5219d07f1-95988605',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'liste' => 0,
    'c' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.1',
  'unifunc' => 'content_514ae521bc219',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_514ae521bc219')) {function content_514ae521bc219($_smarty_tpl) {?>﻿<link rel="stylesheet" href="./styles/admMarque-index.css"/>
<a href="?module=admMarque&action=add"><img src="./images/boutton.jpg"/></a>

<table>
<tr><th>Id</th><th>Marque</th><th>Modifier</th><th>Supprimer</th></tr>
	<?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['liste']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
		<tr><td><?php echo $_smarty_tpl->tpl_vars['c']->value->getIdMarque();?>
</td><td><a href="?module=admModele&action=index&id=<?php echo $_smarty_tpl->tpl_vars['c']->value->getIdMarque();?>
"><?php echo $_smarty_tpl->tpl_vars['c']->value->getNomMarque();?>
</a></td><td><a href="?module=admMarque&action=add&id=<?php echo $_smarty_tpl->tpl_vars['c']->value->getIdMarque();?>
"><img src="./images/update.png" alt="buttonUpdate"/></a></td><td><a href="?module=admMarque&action=delete&id=<?php echo $_smarty_tpl->tpl_vars['c']->value->getIdMarque();?>
" class="suppr" onclick="return confirm('Etes-vous sur de vouloir supprimer cette marque?')"><img src="./images/delete.png" alt="buttonUpdate"/></a></td></tr>
	<?php } ?>
<table>
<?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['liste']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
<div class="box">
	<div class="infomarque">
		<a href="#"><?php echo $_smarty_tpl->tpl_vars['c']->value->getNomMarque();?>
</a>
		

	</div>
	<div class="adm hidden info"><a href="?module=admModele&action=index&id=<?php echo $_smarty_tpl->tpl_vars['c']->value->getIdMarque();?>
">Administrer la marque <?php echo $_smarty_tpl->tpl_vars['c']->value->getNomMarque();?>
</a></div>
		<div class="upd hidden info"><a href="?module=admMarque&action=add&id=<?php echo $_smarty_tpl->tpl_vars['c']->value->getIdMarque();?>
"><img src="./images/update.png" alt="buttonUpdate"/></a></div>
		<div class="suppr hidden info"><a href="?module=admMarque&action=delete&id=<?php echo $_smarty_tpl->tpl_vars['c']->value->getIdMarque();?>
" class="suppr" onclick="return confirm('Etes-vous sur de vouloir supprimer cette marque?')"><img src="./images/delete.png" alt="buttonUpdate"/></a></div>
</div>
		
		<?php } ?>


<div style="clear:both;"></div>
<script src="./js/jquery-1.4.3.min.js"></script>
 <script src="./js/admMarque-index.js"></script>


<?php }} ?>