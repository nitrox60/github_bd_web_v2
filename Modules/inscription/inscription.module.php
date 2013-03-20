<?php

	class Inscription extends Module{
	/* Modalités de validations stockées dans des constantes de classes -> Acces avec self::NOM_CONST ou nomClasse::NOM_CONST*/
	 const NAME_LENGTH=20;
	 const NUM_REG="/[0-9]/";
	 const EMPTY_REG="/[a-zA-Z]?/";
	 const STREET_LENGTH=50;
	 const STREET_REG="/^[0-9]{1,4} [a-zA-Z]+/";//Minimum accepté par le regex : un chiffre(espace)une lettre
	 const CP_REG1='#^[0-9]{5}$#';
	 const CP_REG2='#^0{2}[0-9]{3}$#';
	 const CITY_LENGTH=30;
	 const MIN_MDP=8;
	 const MAX_MDP=18;
	 
	 
		public function action_index()
		{
			$this->set_title("Module Inscription");	
			
			/** -- En cas de retour sur action_index() suite à des erreurs on remplie le formulaire avec l'ancienne saisie de l'utilisateur -- **/
			//La saisie est sauvegarde jusqu'a ce qu'il reussise l'inscription : -S'il quitte la page et reviens les données sont conservées
			if(isset($this->session->formIns))
			{
				$f=$this->session->formIns;
					$f->populate();
				
			}
			else
			{
			
				$dir = "./images/captcha";

			// Ouvre un dossier bien connu, et liste tous les fichiers
			if (is_dir($dir)) {
				if ($dh = opendir($dir)) {
					while (($file = readdir($dh)) !== false) {
						//echo "fichier : $file : type : " . filetype($dir . $file) . "\n";
						$captcha[]=$file;
					}
					closedir($dh);
				}
			}
			$length=0;
			foreach($captcha as $cp)
				$length++;
			$nb=rand(2,$length-1);
			echo var_dump($length."ee".$nb);
				$f=new Form("?module=inscription&action=valide","f_ins");	//Creation du formulaire
				$f->add_text("nom","nom","Nom");
				$f->add_text("prenom","prenom","Prénom");
				$f->add_text("rue","rue","Rue");
				$f->add_text("cp","cp","Code postal");
				$f->add_text("ville","ville","Ville");
				$f->add_text("mail","mail","Mail");
				$f->add_password("mdp","mdp","Mot de passe");
				$f->add_password("mdp2","mdp2","Confirmation");
				$f->add_captcha("cap","cap","Code de confirmation")->set_captcha($captcha[$nb]);
				$f->add_hidden("hide","hide","")->set_value($captcha[$nb]);
				$f->add_submit("Valider","valIns")->set_value("Valider");
				$this->session->formIns=$f ;				
			}
			
			
			$this->tpl->assign("f_ins",$f);
			
			
		}
		
		public function action_valide()
		{
			/**	--- Test la conformitude de tous les champs du formulaires coté serveur --- **/
			
						// --- Champs nom --- //
			if($this->req->nom == "")	$errors[]="Le nom n'est pas rempli";
			else if(!preg_match(self::EMPTY_REG,$this->req->nom))	$errors[]="Le nom est mal renseigné";
			if(strlen($this->req->nom)>=self::NAME_LENGTH)	$errors[]="La taille du nom doit être inférieur à ".self::NAME_LENGTH." caractères";
			if(preg_match(self::NUM_REG,$this->req->nom))	$errors[]="Le nom ne doit pas contenir de chiffre";
			
			
						// --- Champs prénom --- //
			if($this->req->prenom == "")	$errors[]="Le prenom n'est pas rempli";
			else if(!preg_match(self::EMPTY_REG,$this->req->prenom))	$errors[]="Le prénom est mal renseigné";
			if(strlen($this->req->prenom)>=self::NAME_LENGTH)	$errors[]="La taille du prénom doit être inférieur à ".self::NAME_LENGTH." caractères";
			if(preg_match(self::NUM_REG,$this->req->prenom))	$errors[]="Le prénom ne doit pas contenir de chiffre";
			
						// --- Champs rue --- //
			if(strlen($this->req->rue)>=self::STREET_LENGTH)		$errors[]="La taille de la rue doit être inférieur à ".self::STREET_LENGTH." caractères";
			
			if(!preg_match(self::STREET_REG,$this->req->rue))	$errors[]="Le format du champs rue est: Numéro de rue(nombres) nom de la rue(caractères)";
			
						// --- Champs Code postal --- //
			if( (!preg_match(self::CP_REG1,$this->req->cp)) OR (preg_match(self::CP_REG2,$this->req->cp)))	$errors[]="Format du code postal incorrect. Contien 5 chiffres de 01000 à 99999";
			
						// --- Test si mail déja existant --- (mail => login) //
			$cm= new ClientManager(DB::get_instance());
			if( $cm->chercherParMail( $this->req->mail))	$errors[]="Mail existant";	
			if(!(filter_var($this->req->mail,FILTER_VALIDATE_EMAIL))) $errors[]="Le mail n'est pas conforme";
			
						//	--- Champs mdp ---//
			if(strlen($this->req->mdp)<self::MIN_MDP) $errors[]="Le mot de passe est trop petit";
			else if(strlen($this->req->mdp)>self::MAX_MDP) $errors[]="Le mot de passe est trop grand";
			
						// --- Champs confirmation --- //
			if($this->req->mdp!=$this->req->mdp2) $errors[]="La confirmation ne correspond pas au mot de passe";
			
					// --- Vérification CAPTCHA --- //
				if( ($this->req->hide) &&($this->req->cap))
				{
					$cap=$this->req->hide;
					$cap=substr($cap,2,3);
					echo var_dump($cap);
					if($cap!=$this->req->cap) $errors[]="Le captcha n'est pas bon";
				}
			
			
			// -- Si on trouve des erreurs on les affiche en haut du formulaire -- //
			if(isset($errors[0])){
				
				
				$f=$this->session->formIns;
				
					$f->populate();
					$this->session->formIns=$f;
				
				
				foreach($errors as $err)
				{
					$this->site->ajouter_message("-".$err);
				}
				
					
				
				Site::redirect("inscription");
				 
			}
			else
			{
				$clt['nom']=$this->req->nom;
				$clt['prenom']=$this->req->prenom;
				$clt['rue']=$this->req->rue;
				$clt['codePostal']=$this->req->cp;
				$clt['ville']=$this->req->ville;
				$clt['vip']=0;
				$clt['dateInscription']=date('Y-m-d',time()+7200);//+7200 Pour mettre en GMT+2
				
				$clt['mail']=$this->req->mail;
				$clt['mdp']=$this->req->mdp;
				$clt['validate']=0;
				$client= new Client($clt);
				$cm->add($client); 	
				$client2=$cm->connexion($clt['mail'],$clt['mdp']);
				// On supprime maintenant la variable contenant les entrées de l'utilisateur sur le form inscription.
				unset($this->session->formIns);
				// --On envoie le mail avec la vérif--
				if($client2)
				{
				$subject="Loca-Rent : Bienvenue chère client.";
				$to=$clt['mail'];
				$code=md5($clt['prenom'].$clt['nom'].time());
				$vm=new VerifManager(DB::get_instance());
				$ver['codeVerif']=$code;
				$ver['idClient']=$client2->getIdClient();
				//echo var_dump($client->getIdClient());
				$verif=new Verif($ver);
				$vm->add($verif);
				
				$securelink='http://localhost/projet_BD-WEB/github_bd_web/?module=inscription&action=verif&id='.urlencode($client2->getIdClient()).'&code='.urlencode($code);
				$msg="<h2>LOCA-RENT</h2><br /><p>Bienvenue chez Loca-Rent,</p> pour continuer votre inscription merci de cliquez sur le lien ci-dessus<br /><a href=".$securelink.">".$securelink."</a>";
				// Dans le cas où nos lignes comportent plus de 70 caractères, nous les coupons en utilisant wordwrap()
				//$msg = wordwrap($msg, 70, "\r\n");
				
				// Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

			 // En-têtes additionnels
			 $headers .= 'To: '.$clt['prenom'].' '.$clt['nom'].' <'.$clt['mail'].'>' . "\r\n";
			 $headers .= 'From: Loca-Rent <bouldog1511@hotmail.com>' . "\r\n";
				mail($to,$subject,$msg,$headers);
				
				$this->site->ajouter_message("inscription reussie!$code");
			
				Site::redirect("index");
				}
				$this->site->ajouter_message("inscription pas reussie!$");
			
				Site::redirect("index");
			}
		}
		
		public function action_ajax(){
			$cm=new ClientManager(DB::get_instance());
			$login=$this->req->login;
			if($cm->chercherParMail($login))
				$err[]="Ce mail a déjà un compte lié";
			echo json_encode($err);
			exit;
		}
	}