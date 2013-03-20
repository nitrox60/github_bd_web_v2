<?php /* Smarty version Smarty-3.1.1, created on 2013-03-04 08:38:39
         compiled from "modules\admloc\tpl\admloc-index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:739051345d8f4f5581-27011378%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '792f40a7482e321775fc8e9f4836843e8cb3f897' => 
    array (
      0 => 'modules\\admloc\\tpl\\admloc-index.tpl',
      1 => 1361812978,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '739051345d8f4f5581-27011378',
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
  'unifunc' => 'content_51345d8f7ead1',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51345d8f7ead1')) {function content_51345d8f7ead1($_smarty_tpl) {?>﻿

<style>
.loc
{
	background-color:white;
	border: 2px solid black;
	border-radius:10px ;
	width:50%;
	height:200px;
	margin-left:25%;
	margin-right:25%;
	margin-bottom:20px;
}

.header_loc
{	
	border-bottom:1px solid black;
	width:100%;
	height:30%;
}

.header_loc>span
{
	float:left;
	clear:both;
}

.gras
{
 text-decoration:underline;
 font-weight:bold;
}

.body_loc
{
	width:100%;
	height:70%;
}
.id_car
{
	margin-left:33%;
	display:inline-block;
	width:100%;
	margin-top:10px;
	margin-bottom:10px;
}

.nom_car
{	
	clear:both;	
	float:left;
}

.mod_car, .year_car
{
	float:left;
	clear:both;
}

.statut
{
	height:50px;
	width:50px;
	float:right;
}

.head
{
	position:absolute;
	margin-right:1px;
	margin-left:33%;
} 

.min>img
{
	height:15px;
	margin-right:3px;
} 

.close>img
{
	height:15px;
} 

.min>img, .close>img
{
	cursor:pointer;
}

</style>
		
	
<?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['liste']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
	
<div class="loc"> <div class="head"><span class="min"><img src="./images/min.png"/></span><span class="close"><img src="./images/close.png"/></span></div>
	<div class="header_loc"> <span class="idloc"><span class="gras">Id Location</span>:<span class="idlocforajax"><?php echo $_smarty_tpl->tpl_vars['c']->value->getIdLoc();?>
</span> </span><span class="date_start"><span class="gras">Date du début de location</span>: <?php echo $_smarty_tpl->tpl_vars['c']->value->getDateLoc();?>
</span> <span class="date_stop"> <span class="gras">Date de fin de location </span>: <?php echo $_smarty_tpl->tpl_vars['c']->value->getDateRendu();?>
</span><?php if (isset($_smarty_tpl->tpl_vars['c']->value->stat)){?><img class="statut" src="./images/<?php echo $_smarty_tpl->tpl_vars['c']->value->stat;?>
.jpg"/><?php }?>

	</div>
	<div class="body_loc"><span class="id_car">Id de la voiture : <?php echo $_smarty_tpl->tpl_vars['c']->value->getIdVoiture();?>
</span><span class="nom_car"> Marque de la voiture: <?php echo $_smarty_tpl->tpl_vars['c']->value->marque->getNomMarque();?>
</span> <span class="mod_car">Modèle :<?php echo $_smarty_tpl->tpl_vars['c']->value->mod->getNomModele();?>
</span> <span class="year_car">Année:<?php echo $_smarty_tpl->tpl_vars['c']->value->car->getAnnee();?>
 </span>
	</div>
	
</div>
<?php } ?>

<div style="clear:both;"></div>
<script src="./js/jquery-1.4.3.min.js"></script>
<script src="./js/admLoc-index.js"></script><?php }} ?>