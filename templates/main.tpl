<!-- start template-->
<html>
	<head>
	<title>{$titre}</title>
	
	
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
			{if (isset($login))}
				Connecté :{$login}<a href='?module=login&action=deconnect'>Logout</a>
				{else}<a href="#?w=500" rel="popup_name" class="poplight" >Connexion</a> 
				{/if}</span>
			
		</div>
		

	
		<div id='zonemessage'>
			<!-- Message ajouté avec $this->site->ajouter_message(""); -->
			    {$messages}
				<!-- <img src="./images/ban.jpeg" style="width:104%; margin:-2%;margin-bottom:-4%;"/> -->
		</div>
		
		<div id='contenu'>
			<!-- Dans cette zone, on affiche le contenu généré par le module <b>{$module}->{$action}()</b>-->
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
				{$bloc_contenu}
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
<!-- end template-->