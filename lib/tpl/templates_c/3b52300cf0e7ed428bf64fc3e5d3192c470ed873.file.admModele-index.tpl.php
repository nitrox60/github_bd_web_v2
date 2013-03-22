<?php /* Smarty version Smarty-3.1.1, created on 2013-03-21 10:47:05
         compiled from "modules\admModele\tpl\admModele-index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10491514ae5299c6ec1-11962474%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3b52300cf0e7ed428bf64fc3e5d3192c470ed873' => 
    array (
      0 => 'modules\\admModele\\tpl\\admModele-index.tpl',
      1 => 1359397921,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10491514ae5299c6ec1-11962474',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'marque' => 0,
    'id' => 0,
    'liste' => 0,
    'c' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.1',
  'unifunc' => 'content_514ae529bc953',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_514ae529bc953')) {function content_514ae529bc953($_smarty_tpl) {?>﻿<style>

p{
margin-bottom:8%;
}

#infob{
    color:black;
    text-shadow:0 -1px 0 black; 
padding:2px;    
border-radius: 6px;
	
}
#infob:hover,#infob:focus{
    background:rgba(0,0,0,.4);
    box-shadow:0 1px 0 rgba(255,255,255,.4);
	cursor:help;
}

#infob span{
    position:absolute;  
		margin-top:23px;
    margin-left:-35px;
	  color:#09c;
    background:rgba(0,0,0,.9);
    padding:15px;
    border-radius:3px;
    box-shadow:0 0 2px rgba(0,0,0,.5);
	transform:scale(0) rotate(-12deg);
	transition:all .25s;
	opacity:0;
}

#infob:hover span,#infob:focus span{
	 transform:scale(1) rotate(0); 
    opacity:1;
}

#infob span::before{
content:'';
position:absolute;
top:-6px;
left:10px;
width:0;
height:0;
border-bottom:6px solid rgba(0,0,0,.9);
border-left:6px solid transparent;
border-right:6px solid transparent;
}
</style>
<link rel="stylesheet" href="./styles/admModele-index.css"/>
<div id="mq"><?php echo $_smarty_tpl->tpl_vars['marque']->value->getNomMarque();?>
</div>
<p>
<a href="#" id="infob">Informations<span> Cliquez sur le nom du modèle pour voir les voitures et pour acceder a leur suppression.<br />
Double cliquez pour modifier le nom, le prix ou le taux	</span></a>
</p>
<div class="button_add button"><a href="?module=admModele&action=add&op=add&id=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">Ajouter</a></div>
<table align="center" valign="middle">
		<tr><th>Id</th><th>Modèle</th><th> Quantité Stock</th><th> Prix par jour</th><th>Taux de remise (%)</th><th>Modifier</th><th>Supprimer</th><th> Ajouter Voiture</th><th> Ajouter Photo</th></tr>
	
<?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['liste']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
	<tr id="<?php echo $_smarty_tpl->tpl_vars['c']->value->getIdModele();?>
"> <td id="id<?php echo $_smarty_tpl->tpl_vars['c']->value->getIdModele();?>
"><?php echo $_smarty_tpl->tpl_vars['c']->value->getIdModele();?>
</td> <td class="mod upd" tag="nomModele" id="<?php echo $_smarty_tpl->tpl_vars['c']->value->getIdModele();?>
"><?php echo $_smarty_tpl->tpl_vars['c']->value->getNomModele();?>
</td><td><?php echo $_smarty_tpl->tpl_vars['c']->value->getQteStock();?>
</td> <td tag="prix" class="upd"><?php echo $_smarty_tpl->tpl_vars['c']->value->getPrix();?>
</td> <td tag="tauxRemise" class="upd"><?php echo $_smarty_tpl->tpl_vars['c']->value->getTauxRemise();?>
</td> <td><a href="?module=admModele&action=add&op=update&idmod=<?php echo $_smarty_tpl->tpl_vars['c']->value->getIdModele();?>
&id=<?php echo $_smarty_tpl->tpl_vars['marque']->value->getIdMarque();?>
"><img src="./images/update.png"/></a></td> <td><a href="?module=admModele&action=delete&id=<?php echo $_smarty_tpl->tpl_vars['c']->value->getIdModele();?>
" class="suppr"><img src="./images/delete.png"/></a></td> <td><a href="?module=admVoiture&id=<?php echo $_smarty_tpl->tpl_vars['c']->value->getIdModele();?>
" ><img src="./images/car_add.png"/></a></td><td><a href="?module=admModele&action=addPhoto&id=<?php echo $_smarty_tpl->tpl_vars['c']->value->getIdModele();?>
"><img src="./images/photo.jpg"/></a></td></tr>
	<tr class="car"><td>ID Voiture</td><td>année</td><td>km</td></tr>
<?php } ?>
</table>

<div class="ajax"></div>
<div style="clear:both;"></div>
<script src="./js/jquery-1.4.3.min.js"></script>
<script src="./js/admModele-index.js"></script>

	<?php }} ?>