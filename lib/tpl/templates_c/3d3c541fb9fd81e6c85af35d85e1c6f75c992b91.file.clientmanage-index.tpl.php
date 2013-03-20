<?php /* Smarty version Smarty-3.1.1, created on 2013-03-20 23:09:39
         compiled from "modules\clientmanage\tpl\clientmanage-index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:29794514209cee62f16-57936656%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3d3c541fb9fd81e6c85af35d85e1c6f75c992b91' => 
    array (
      0 => 'modules\\clientmanage\\tpl\\clientmanage-index.tpl',
      1 => 1363820976,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '29794514209cee62f16-57936656',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.1',
  'unifunc' => 'content_514209ceeb77f',
  'variables' => 
  array (
    'user' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_514209ceeb77f')) {function content_514209ceeb77f($_smarty_tpl) {?>﻿<style>
#change_mail, #change_adr, #change_mdp
{
	background-color:#A5AA95;
	border: 1px solid white;
	border-radius:10px;
	width: 25%;
	height:7%;
	text-align:center;
	cursor:pointer;
	padding-top:2%;
	float:left; clear:right;
	margin-left:5%;
}

.hidden
{
	display:none;
}

#scrollbox
{
	border:1px solid white;
	border-radius:10px;
	height:30%;
	width:60%;
	position:relative;
	margin-top:10%;
	margin-left:21%;
	padding-top:2%;
	
	display:none;
}

#validation
{
	font-size:2em;
	margin-top:10%;
	margin-left:2%;
}

#err_mail, #err_ville, #err_cp, #err_rue, #err_oldmdp, #err_newmdp, #err_newmdpconf
{
	font-size:12px;
	color:black;
	margin-top:2%;
	border:1px solid white;
	border-radius:10px;
	background-color:#FF0004;
	padding-right:4px;
	padding-left:4px;
	padding-top:2px;
	padding-bottom:2px;
	
}
</style>

<div id="email" class="hidden"><?php echo $_smarty_tpl->tpl_vars['user']->value->getMail();?>
</div>
<div id="rue" class="hidden"><?php echo $_smarty_tpl->tpl_vars['user']->value->getRue();?>
</div>
<div id="ville" class="hidden"><?php echo $_smarty_tpl->tpl_vars['user']->value->getVille();?>
</div>
<div id="cp" class="hidden"><?php echo $_smarty_tpl->tpl_vars['user']->value->getCodePostal();?>
</div>


<div id="change_mail">Changer votre mail</div>
<div id="change_adr">Changer votre adresse</div>
<div id="change_mdp">Changer votre mot de passe</div>

<div id="scrollbox"></div>

<div style="clear:both"></div>
<script src="./js/jquery-1.4.3.min.js"></script>
<script src="./js/clientmanage-index.js"></script><?php }} ?>