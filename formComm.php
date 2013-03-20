
<?php 
function chargerClasse ($classe)
    {
        require $classe .'.class.php'; // On inclue la classe correspondante au paramètre passé
    }
    
    spl_autoload_register ('chargerClasse'); // On enregistre la fonction en autoload pour qu'elle soit appelée dès qu'on instanciera une classe non déclarée
	?>
	
<html>
<head>
	
</head>
<body>


	<form enctype="text/palin" method="post" action="valComm.php" name="f_comm" id="f_comm">
	<fieldset>
		
		<input type="text" value="test"  readonly="readonly" name="auteur" id="auteur"/>
		<label>Note</label><br />
		<input type="radio" name="note" id="n1" value=1 />1 <input type="radio" name="note" id="n2" value=2 />2 <input type="radio" name="note" value=3 id="n3"/>3 <input type="radio" name="note" id="n4" value=4 />4 <input type="radio" name="note" value=5 id="n5"/>5<br />
		
		Commentaires <br />
		<textarea id="comme" name="comm"></textarea>
		<br /> <input type="text" value="porsche"  readonly="readonly" name="voiture" id="voiture"/>
		<input type="submit" value="Envoyez"/>
	</fieldset>
	</form>

	<br /><br />
	<?php
	
		$db= new PDO("mysql:host=localhost;dbname=location", "root", "");
		$manage= new  CommentaireManager($db);
		$manage->listing();
		
		
		
	?>

</body>

</html>