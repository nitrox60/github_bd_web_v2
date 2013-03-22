<?php /* Smarty version Smarty-3.1.1, created on 2013-03-21 18:06:26
         compiled from "modules\car\tpl\car-index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2440751409cda726d78-89183219%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9242195ebc3a579d25cde1efdd6d656a343453e1' => 
    array (
      0 => 'modules\\car\\tpl\\car-index.tpl',
      1 => 1363889184,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2440751409cda726d78-89183219',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.1',
  'unifunc' => 'content_51409cdaa5d82',
  'variables' => 
  array (
    'photo' => 0,
    'p' => 0,
    'com' => 0,
    'c' => 0,
    'f_com' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51409cdaa5d82')) {function content_51409cdaa5d82($_smarty_tpl) {?>﻿
<style>
	.image
	{
		height:57px;
		width:100px;
		cursor:pointer;
	}
	#big
	{
		height:500px;
		width:750px;
		display: block; 
		margin: 0 auto; 
	}
	table.tabcom
	{
		border:1px solid black;
		border-collapse: collapse;
		text-align:center;
	}
	th, td
	{
		border: 1px solid black;
		padding:10px;
	}
	
	
	
	
	#notation
	{
		-webkit-transform: rotate(-180deg);
		position:relative;
		margin-top:50px;
		margin-left:130px;
		float:left;
	}
	
	#notation div:nth-child(5)
	{
		width:10px;
		height:20px;
		margin-right:3px;
		background-color: white;
		float:left;
		
	}
	
	#notation div:nth-child(4)
	{
		background-color:white;
		width:10px;
		height:25px;
		float:left;
		margin-right:3px;
	}
	
	#notation div:nth-child(3)
	{
	margin-right:3px;
		background-color:white;
		width:10px;
		height:30px;
		float:left;
	}
	
	#notation div:nth-child(2)
	{
		background-color:white;
		width:10px;
		height:40px;
		float:left;
		margin-right:3px;
	}
	
	#notation div:nth-child(1)
	{
		background-color:white;
		width:10px;
		height:45px;
		margin-right:3px;
		float:left;
		content:"1";
	}
	
	.contenucom {
		border : solid white 1px;
		border-radius: 10px 10px 10px;
		padding-left:5px;
		padding-top:2px;
		width: 500px;
		height:70px;
		background-color:rgba(153,153,153,0.8);
		
	}
	.infocom
	{
		background-color:rgba(153,153,153,1);
		margin-bottom:-18px;
		position:relative;
		width:500px;
		border-radius: 20px 20px 20px;
		box-shadow: 0px 1px 1px white;
		padding:2px;
	}
	
	.groupcom
	{
		margin-top:10px;
		margin-left:17%;
		margin-bottom:-20px;
	}
	
	#gauche
	{
		-webkit-transform: rotate(180deg);
		float:left;
		margin-left:3%;
	}
	
	#droite
	{
		
		float:right;
		margin-right:3%;
	}
	img.fleche
	{
		width:120px;
		height:120px;
		margin-top:15%;
		cursor:pointer;
	}
	
	
	
	.slideshow { 
	   margin-left:33%;
	   width: 500px;  
	   height: 400px; 
		margin-top:10%;
	   overflow: hidden;  
	   border: 3px solid #F2F2F2;  
	   margin-bottom:5%;
	}  
	
	.slideshow ul {  
		/* 4 images donc 4 x 100% */  
	   width: 400%;  
	   height: 200px;  
	   padding:0; margin:0;  
	   list-style: none;  
	}  
	
	.slideshow li {  
   float: left;  
}
</style>

<div id="sel"></div>
<div style="clear:both;"></div>
<div id="min" tag="tagok">
	<table class="ok"><tr>
	<?php  $_smarty_tpl->tpl_vars['p'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['p']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['photo']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['p']->key => $_smarty_tpl->tpl_vars['p']->value){
$_smarty_tpl->tpl_vars['p']->_loop = true;
?>
		<td><img id="<?php echo $_smarty_tpl->tpl_vars['p']->value->getIdImage();?>
" class="image" src="./images/<?php echo $_smarty_tpl->tpl_vars['p']->value->getIdImage();?>
.jpg" /></td>
	<?php } ?>
	</tr></table></div>
<div id="photobox">

	<img src="./images/fleche_droite.png" class='fleche' id="gauche"/>
	<img src="./images/fleche_droite.png"  class='fleche' id="droite"/>
	
	<div id="photo">
		<div class="slideshow">  
			<ul>  
			<?php  $_smarty_tpl->tpl_vars['p'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['p']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['photo']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['p']->key => $_smarty_tpl->tpl_vars['p']->value){
$_smarty_tpl->tpl_vars['p']->_loop = true;
?>
				<li>
				<img src="./images/<?php echo $_smarty_tpl->tpl_vars['p']->value->getIdImage();?>
.jpg" alt="" width="500" height="400" />
				</li>
			<?php } ?>
			<!--
				<li>
				<img src="./images/brice.png" alt="" width="600" height="600" />
				</li>
			-->
			</ul>  
		</div> 
	</div>
	
	
	
	
</div>


<div id="comm">
	
	<?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['com']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
		<div class="groupcom"><div class="infocom">Commentaire posté le <?php echo $_smarty_tpl->tpl_vars['c']->value->getDateCom();?>
 par (IdClient) <?php echo $_smarty_tpl->tpl_vars['c']->value->getIdClient();?>
Note <?php echo $_smarty_tpl->tpl_vars['c']->value->getNote();?>
</div><br /> <div class="contenucom"><?php echo $_smarty_tpl->tpl_vars['c']->value->getContenu();?>
</div></div>
	<?php } ?>
</div>
	<div id="notation">
			<div></div>
			<div></div>
			<div></div>
			<div></div>
			<div></div>
	</div>
<div id="addcom"><?php echo $_smarty_tpl->tpl_vars['f_com']->value;?>
</div>

</div>
<div style="clear:both;"></div>
<script src="./js/jquery-1.4.3.min.js"></script>
<script>
	$(function(){
		$('#addcom textarea').css("max-width","800px").css("max-height","200px").css("min-width","500").css("min-height","100");
	
		$("img.fleche").click(function(){
			
			
			if($(this).attr('id')=="droite")
			{
				$(".slideshow ul").animate({
				 marginLeft:-600
				 },100,function(){  
					$(this).css({
					marginLeft:0
					}).find("li:last").after($(this).find("li:first"));  
				 }) 
			}
			else if($(this).attr('id')=="gauche")
			{
				
				$(".slideshow ul").animate({
				 marginRight:-600
				 },100,function(){  
					$(this).css({
					marginRight:0
					}).find("li:first").before($(this).find("li:last"));  
				 }) 
			}
			 
		});
		
		$('img.image').live('click', function(){
		
			var source=$(this).attr('src');
			var image="";
			var imge=$('li>img').each(function(){
			
				if($(this).attr('src')==source)
					image=$(this);
			});
			
		
		//	alert($(image).attr('src'));
		
		/*	
			$(".slideshow ul").animate({
			 marginLeft:-600
			 },100,function(){  
				$(this).css({
				marginLeft:0
				}).find("li:last").after($(this).find("li:first"));  
			 }) 
			 
			 */
			 
		});
		
	
	/*
		$('img').live('click', function(){
			
			if($(this).attr("class")=="image")
			{
			
			$("img.fleche").show();
			
			var image='';
				$var=$(this).attr('src');
				image='<img id="big" src='+$var+' />'
				$('#photo').html(image).hide();
				$('#photo').animate({
					width: "show",
					height:"show",
					margin: "0 auto"
				},500);
			}
			else if ($(this).attr('id')=="big")
			{
				$('#photo').html("");
			
			}
        });
		*/
		
		$('#notation div:nth-child(1)').hover(function(){
		
				$('#notation div:nth-child(1)').css("background-color","yellow");
				$('#notation div:nth-child(2)').css("background-color","yellow");
				$('#notation div:nth-child(3)').css("background-color","yellow");
				$('#notation div:nth-child(4)').css("background-color","yellow");
				$('#notation div:nth-child(5)').css("background-color","yellow");
				
		});
		
		$('#notation div:nth-child(2)').hover(function(){
		
				$('#notation div:nth-child(1)').css("background-color","white");
				$('#notation div:nth-child(2)').css("background-color","yellow");
				$('#notation div:nth-child(3)').css("background-color","yellow");
				$('#notation div:nth-child(4)').css("background-color","yellow");
				$('#notation div:nth-child(5)').css("background-color","yellow");
				
		});
		
		$('#notation div:nth-child(3)').hover(function(){
		
				$('#notation div:nth-child(1)').css("background-color","white");
				$('#notation div:nth-child(2)').css("background-color","white");
				$('#notation div:nth-child(3)').css("background-color","yellow");
				$('#notation div:nth-child(4)').css("background-color","yellow");
				$('#notation div:nth-child(5)').css("background-color","yellow");
				
		});
		
		$('#notation div:nth-child(4)').hover(function(){
		
				$('#notation div:nth-child(1)').css("background-color","white");
				$('#notation div:nth-child(2)').css("background-color","white");
				$('#notation div:nth-child(3)').css("background-color","white");
				$('#notation div:nth-child(4)').css("background-color","yellow");
				$('#notation div:nth-child(5)').css("background-color","yellow");
				
		});
		
		$('#notation div:nth-child(5)').hover(function(){
		
				$('#notation div:nth-child(1)').css("background-color","white");
				$('#notation div:nth-child(2)').css("background-color","white");
				$('#notation div:nth-child(3)').css("background-color","white");
				$('#notation div:nth-child(4)').css("background-color","white");
				$('#notation div:nth-child(5)').css("background-color","yellow");
				
		});
		
	});
</script><?php }} ?>