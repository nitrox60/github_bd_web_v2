<?php
	function chargerClasse ($classe)
    {
        require $classe .'.class.php'; // On inclue la classe correspondante au paramètre passé
    }
    
    spl_autoload_register ('chargerClasse');
	
	
	echo $_POST['note'];
	if( (isset($_POST['note'])) && (isset($_POST['auteur']))  &&(isset($_POST['comm'])) &&(isset($_POST['voiture']))){
	
		$rep['note']=$_POST['note'];
		$rep['auteur']=$_POST['auteur'];
		
		$rep['contenu']=$_POST['comm'];
		$rep['voiture']=$_POST['voiture'];
		
		
		$db= new PDO("mysql:host=localhost;dbname=location", "root", "");
		$manage= new CommentaireManager($db);
		$comm= new Commentaire($rep);
		var_dump($comm);
		$manage->add($comm);
	
	}
	else echo " un champs est mal renseigné!";

?>