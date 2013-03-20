
<?php 
function chargerClasse ($classe)
    {
        require './Tables/'.$classe .'.class.php'; // On inclue la classe correspondante au paramètre passé
    }
    
    spl_autoload_register ('chargerClasse'); // On enregistre la fonction en autoload pour qu'elle soit appelée dès qu'on instanciera une classe non déclarée
	
	$db=new PDO("mysql:host=localhost;dbname=basec5","root","");
	/*
		//CLASSE COMMENTAIRE OK!
	$data=array();
	$data['idVoiture']=1;//idvoiture
	$data['idClient']=1;//idClient
	$data['dateCom']="2012-11-03 19:23:00";//dateCom
	$data['contenu']="bob est un taureau";
	$data['note']=4;
	$CM=new CommentaireManager($db);
	$com1= new Commentaire($data);
	echo $com1->getContenu();
	echo $com1->getIdVoiture();
	echo $com1->getIdClient();
	echo $com1->getDateCom();
	
	
	
	
	//$CM->add($com1);
	$CM->listing();
	
	echo "get";
	 $commrecu=$CM->get(4);
	 echo "afterget";
	echo $commrecu->getContenu();
	
	*/
		//CLASSE CLIENT OK!
	/*
	$clt=array();
	$clt['nom']="john";
	$clt['prenom']="bob";
	$clt['rue']=" 7 bis rue de johnSpartan";
	$clt['codePostal']="60478";
	$clt['ville']="Mos Espa";
	$clt['vip']=1;
	$clt['dateInscription']="2012-11-03";
	
	$clt['mail']="john@bob.fr";
	$clt['mdp']="bobazerty";
	
	$client= new Client($clt);
	
	$CltM= new ClientManager($db);
	//$CltM->add($client);
	$CltM->listing();
	$client2=$CltM->get(1);
	echo $client2->getNom() . $client2->getPrenom();
	
	$clientCo=$CltM->connexion("john@bob.fr","bobazertyz");
	if($clientCo)echo "test<br />".$clientCo->getNom();
	
	*/
	/* CLASS MARQUE OK
	$mq=array();
	$mq['nomMarque']="BMW";
	 $marque= new Marque($mq);
	 $MM= new MarqueManager($db);
	 $MM->add($marque);
	 $MM->listing();
	 $bmw=$MM->get(2);
	 echo $bmw->getNomMarque();
	 */
	 
	/* CLASSE MODELE OK!
	$mod=array();
	$mod['nomModele']="525";
	$mod['idMarque']=2;
	
	$modele= new Modele($mod);
	
	
	$modManager= new ModeleManager($db);
	$modManager->add($modele);
	$modManager->listing();
	$mod2=$modManager->get(3);
	echo $mod2->getNomModele();
	
	*/
	
	/*	CLASSE LOCATION OK!
	$loc=array();
	$loc['dateLoc']="2012-11-04 13:10:00";
	$loc['dateRendu']="2012-12-04 13:10:00";
	$loc['prixLoc']=1500;
	$loc['idVoiture']=2;
	$loc['idClient']=1;
	
	$location = new Location($loc);
	
	$LM= new LocationManager($db);
	$LM->add($location);
	$LM->listing();
	$loc2=$LM->get(1);
	echo $loc2->getPrixLoc();
	*/
	
	/*
	$reg='/^2+0+[1-9]{2}$/';
		if(preg_match($reg,"2018")){ echo "ok";}
		else echo "pasok";
		
	*/
	/*
	$reg2='/^(\.\/picture\/)/';
		if(preg_match($reg2,"./picture/porsche-911-carrera-gt")){ echo "ok";}
		else echo "pasok";
	*/
	
	/* //CLASSE VOITURE OK!
	$car=array();
	$car['année']=2012;
	$car['km']=10000;
	$car['prix']=1200.50;
	$car['qteStock']=5;
	$car['qteDispo']=5;
	$car['description']="BMW 525";
	$car['cheminPhoto']="./picture/BMW-525-001";
	$car['idModele']=3;
	
	$voiture=new Voiture($car);
	$CarM= new VoitureManager($db);
	$CarM->add($voiture);
	$CarM->listing();
	$bmw001=$CarM->get(3);
	echo $bmw001->getCheminPhoto();
	*/
?>