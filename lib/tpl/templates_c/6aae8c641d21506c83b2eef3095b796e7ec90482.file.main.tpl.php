<?php /* Smarty version Smarty-3.1.1, created on 2013-03-14 17:32:49
         compiled from "templates\main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2599051323f5ab9e031-13517489%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6aae8c641d21506c83b2eef3095b796e7ec90482' => 
    array (
      0 => 'templates\\main.tpl',
      1 => 1363282364,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2599051323f5ab9e031-13517489',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.1',
  'unifunc' => 'content_51323f5ac69a5',
  'variables' => 
  array (
    'titre' => 0,
    'login' => 0,
    'messages' => 0,
    'module' => 0,
    'action' => 0,
    'bloc_contenu' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51323f5ac69a5')) {function content_51323f5ac69a5($_smarty_tpl) {?><!-- start template-->
<html>
	<head>
	<title><?php echo $_smarty_tpl->tpl_vars['titre']->value;?>
</title>
	
	
	<link rel='stylesheet' href='styles/smoothness/jquery-ui-1.8.5.custom.css' />
	<link rel='stylesheet' href='styles/main.css' />
	<link rel="icon" type="image/png" href="./images/favicon.ico" />
	</head>
	<body>
	<div id='page'>
		
	
		<div id='menu'>
			
		<!--	<a href="?module=loc&action=mail">Mail</a>
			<a href="?module=login">Login</a> -->
			<a href="?module=inscription">Inscription</a>
			<a href="?module=admSpace">Administration</a>
			<a href="?module=clientmanage" class="nodisp">Mon Compte</a>
			<a href="?module=loc">Location</a>
			<a href="#">Nos Adresses</a>
			<span id="ifLog">
			<?php if ((isset($_smarty_tpl->tpl_vars['login']->value))){?>
				Connecté :<?php echo $_smarty_tpl->tpl_vars['login']->value;?>
<a href='?module=login&action=deconnect'>Logout</a>
				<?php }else{ ?><a href="#?w=500" rel="popup_name" class="poplight" >Connexion</a> 
				<?php }?></span>
			
		</div>
		

	
		<div id='zonemessage'>
			<!-- Message ajouté avec $this->site->ajouter_message(""); -->
			    <?php echo $_smarty_tpl->tpl_vars['messages']->value;?>

				<!-- <img src="./images/ban.jpeg" style="width:104%; margin:-2%;margin-bottom:-4%;"/> -->
		</div>
		
		<div id='contenu'>
			<!-- Dans cette zone, on affiche le contenu généré par le module <b><?php echo $_smarty_tpl->tpl_vars['module']->value;?>
-><?php echo $_smarty_tpl->tpl_vars['action']->value;?>
()</b>-->
			<div id='module'>
			<!-- <a href="#?w=500" rel="popup_name" class="poplight" style="display:none;">En savoir plus</a>  POP UP DE CONNEXION-->
				<div id="popup_name" class="popup_block">
					<h2>Vous n'êtes pas connecté</h2>
					<!-- <form id="f_co_pop" name="f_co_pop" method="post" enctype="text/plain" action="?module=login&action=coajax"> -->
					<fieldset>
					<label for="ndc_pop">Email</label><input   type="text" name="ndc_pop" id="ndc_pop"/>
					<label>mdp</label><input type="password" name="mdp_pop" id="mdp_pop"/>
					<label>&nbsp </label><input type="submit" name="sub_pop" id="sub_pop" value="Connexion" class="co_pop"/>
					<div id="error_pop"></div>
					</fieldset>
					<!-- </form> -->
				</div>
				<?php echo $_smarty_tpl->tpl_vars['bloc_contenu']->value;?>

			</div>
		</div>
		
		<!-- informations footer -->
	<div id="footer">
	<div id="infofoot"><a href="#"> Remerciement</a> <a href="#">Contact</a> <a href="#">Nos adresses</a> <a href="#">Mentions légales</a></div>
	<div id="madeby">Made By TAYAA-DALMAS Corporation. All Right Reserved</div>
	</div>
	</div>
	</body>
	
		<script src="./js/jquery-1.4.3.min.js"></script>
<script src="./js/main.js"></script>
<script src="./js/jquery-ui-1.8.5.custom.min.js"></script>



</html>
<!-- end template--><?php }} ?>