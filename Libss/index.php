<!DOCTYPE html>

<html>

<head>
	<link rel="stylesheet" href="./styleLocation.css"/>
</head>

<body>
	<div id="ins">Pas inscrit? -> <b><a href="./inscription.html">Inscription</a></b></div>
	<div id="log">
	<label for="login">Login</label><input type="text" id="login" name="login"><span id="login_e"></span>
	<label for="mdp">Mot de passe</label><input type="password" id="mdp" name="mdp"><span id="login_e"></span>
	</div>
	<?php include("inscription.html");?>
	<a href="./test.php">test</a><br />
	<a href="./f_getters.html">form getters/setters</a>

</body>

</html>