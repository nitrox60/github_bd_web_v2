<?php
	class AdmModele extends Module{
	
	const VAL_REG="/[^a-zA-Z0-9 ]/";
	const NUM_REG='/^\d{1,2}$|(?=^.{1,5}$)^\d{1,2}+\.\d{1,2}$/'; //Soit on a 2chiffres ou une chaine de 5 caractères composée de 
																 // 1 a 2 chiffres puis un point puis 1 a 2 chiffres
	
		public function action_index()
		{
			$this->set_title("Module Admin ");	
			$modMan=new ModeleManager(DB::get_instance());
			$liste=$modMan->listing($this->req->id);
			$this->tpl->assign("liste",$liste);
			$marqueManage=new MarqueManager(DB::get_instance());
			$marqueObj=$marqueManage->get($this->req->id);
			$this->tpl->assign("marque",$marqueObj);
			$this->tpl->assign("id",$this->req->id);
			
		}
		
		public function action_add()
		{
			if($this->req->id)
			{
				$op=$this->req->op;
				$this->set_title("Module Admin ");
				$f=new Form("?module=admModele&action=valide&type=".$op,"f_add");
				$mm= new ModeleManager(DB::get_instance());
				if($this->req->idmod)
				{	
					$mod=$mm->get($this->req->idmod);
					$nom=$mod->getNomModele();
					// $qte=$mod->getQteStock();
					$prix=$mod->getPrix();
					$tx=$mod->getTauxRemise();
					$f->add_hidden("idmod","idmod","idmod")->set_value($this->req->idmod);
				}
				else
				{
					$nom='';
					$qte='';
					$prix='';
					$tx='';
					$this->site->ajouter_message("else");
				}
				
				$f->add_text("nomModele","nomModele","Nom modèle")->set_value($nom);
				$f->add_hidden("id","id","")->set_value($this->req->id);
				// $f->add_text("qteStock","qteStock","Quantité en stock")->set_value($qte);
				$f->add_text("prix","prix","Prix journalier")->set_value($prix);
				$f->add_text("tauxRemise","tauxRemise","Taux de remise (%)")->set_value($tx);
				$f->add_submit("v_add","v_add")->set_value("Valider");
				$this->tpl->assign("f_add",$f);
				$this->session->f_add=$f;
			}
			else Site::redirect("admMarque");
		
		}
		
		public function action_valide()
		{
		
			$mm=new ModeleManager(DB::get_instance());
			$op=$this->req->type;
			if($op=="add")if($mm->exist($this->req->nomModele))$errors[]="Le nom du modèle ".$this->req->nomModele ." existe déjà";
			if($op=="add") 
			{
				if(strlen($this->req->nomModele)==0)$errors[]="Le nom du modèle n'est pas renseigné";
				else if(preg_match(self::VAL_REG,$this->req->nomModele))$errors[]="Le champs nom  modèle est mal renseigné";
			}
			
			if ( ($this->req->prix<=0) OR ($this->req->prix>=100000)) $errors[]="Le prix journalier doit être compris entre 0 exclus et 100 000 exclus";
		
			if(strlen($this->req->tauxRemise)==0)$errors[]="Le taux de remise n'est pas renseigné";
			if (($this->req->tauxRemise>=100) OR ($this->req->tauxRemise<0)) $errors[]="Le taux de remise doit être compris entre 0 inclus et 100 exclus. (C'est un pourcentage)";
			if(!preg_match(self::NUM_REG,$this->req->tauxRemise))	$errors[]="Le taux est mal renseigné";
			
			if(isset($errors[0]))
			{
				foreach($errors as $err)
				{
					$this->site->ajouter_message($err);
				}
				Site::redirect("admModele","add&op=".$op."&id=".$this->req->id);
				
			
			}
			else
			{
				if($op=="add")
				{
				//a tester si id existe
					if($this->req->id)
					{
						$tab['nomModele']=$this->req->nomModele;
						$tab['qteStock']=0;
				
						$tab['idMarque']=$this->req->id;
						$tab['prix']=$this->req->prix;
						$tab['tauxRemise']=$this->req->tauxRemise;
						$mod=new Modele($tab);
						$mm->add($mod);
						$this->site->ajouter_message($this->req->nomModele." ajouté!");
						Site::redirect("admModele","index&id=".$this->req->id);
					}
					else
					{
						
						Site::redirect("admMarque");
					}
				}
				else if($op=="update")
				{
					$tab['idModele']=$this->req->idmod;
					$tab['nomModele']=$this->req->nomModele;
					$mod1=$mm->get($this->req->idmod);
						$tab['qteStock']=$mod1->getQteStock();
						
						$tab['idMarque']=$this->req->id;
						$tab['prix']=$this->req->prix;
						$tab['tauxRemise']=$this->req->tauxRemise;
						$mod=new Modele($tab);
						$mm->update($mod);
						$this->site->ajouter_message($this->req->nomModele." updaté!");
						Site::redirect("admModele","index&id=".$this->req->id);
				}
				else $this->site->ajouter_message("Opération inconnu");
			
			}
		}
		
		public function action_delete()
		{
			$db=DB::get_instance();
			$mm=new ModeleManager($db);
			$vm=new VoitureManager($db);
			$mod=$mm->get($this->req->id);
			// $listeCar=$vm->listing($this->req->id);
			// foreach($listeCar as $voiture)
			// {
				// $vm->delete($voiture);
			
			// }
			//il faudra suppr les image
			$vm->deleteAll($mod);
			$mm->delete($mod);
			$this->site->ajouter_message($mod->getNomModele()." supprimé!");
			Site::redirect("admModele","&action=index&id=".$mod->getIdMarque());
		}
		
		public function action_addPhoto(){
			$id=$this->req->id;
			$this->set_title("Module Admin Ajouter Photo");
			$f=new Form("?module=admModele&action=validePhoto","f_addph");
			
			$f->add_hidden("id","id","Id")->set_value($this->req->id);
			$f->add_file("photo","photo","photo");
			$f->add_submit("Valider","val_up")->set_value("Valider");
			
			$this->tpl->assign("f_addph",$f);			
			$this->session->formPh = $f;
		}
		
		public function action_validePhoto(){
			$extensions = array("png","jpg","jpeg","bmp","PNG","JPG","JPEG","BMP");
			$taille_max = 100000;
			$dossier="images/";
			$fichier=uniqid();
			
			$extension = explode('.',$_FILES['photo']['name']);
			$extension=strtolower($extension[count($extension)-1]);
			if(!in_array($extension, $extensions))
				$error[]="mauvaise extension";
				
			/*$taille = getimagesize($_FILES['photo']['tmp_name']);
			$larg=300;
			$reduc=($larg*100)/$taille[0];
			$haut=($taille[1]*$reduc)/100;

			if($extension!="jpg")
			$function=imagecreatefrom.$extension;
			else $function=imagecreatefrom.jpeg;
			$image=imagecreatetruecolor($larg,$haut);
			imagecopyresampled($image, $function($_FILES['photo']['tmp_name']), 0, 0, 0, 0, $larg, $haut, $taille[0],$taille[1]);
			
			imagepng($image,$dossier.$fichier.".png",9);*/
			
			move_uploaded_file($_FILES['photo']['tmp_name'],$dossier.$fichier.".jpg");	
				
			if(isset($error[0])){
				$f=$this->session->formPh;
				$f->populate();
				$this->tpl->assign("f_addph",$f);
				foreach($error as $err)
				{
					$this->site->ajouter_message("-".$err);
				}
				
			}
			else{
				$img['idImage']=$fichier;
				$img['idModele']=$this->req->id;
				$image=new Image($img);
				$imgM= new ImageManager(DB::get_instance());
				$imgM->add($image);
				$this->site->ajouter_message("upload réussi");
				//il faudra penser à redimensionner la photo
				Site::redirect("admMarque");
			}
		}
		
		public function action_ajax()
		{
			// Pour faire modif en direct sans changer de page
			if(($this->req->id) AND ($this->req->what))
			{	
				$what=$this->req->what;
				if(($what=="nomModele") OR ($what=="prix") Or ($what=="tauxRemise"))
				{
					$new= $this->req->mod;
					if($what=="nomModele")
					{
						$mm=new ModeleManager(DB::get_instance());
						if($mm->exist($new))$err[]="Le nom du modèle ".$this->req->nomModele ." existe déjà";
						else if(strlen($new)==0) $err[]="Le nom du modèle n'est pas renseigné";
						else if(preg_match(self::VAL_REG,$new))$err[]="Le champs nom  modèle est mal renseigné";
					}
					else if($what=="prix")
					{
						if (($new<=0) OR ($new>=100000)) $err[]="Le prix journalier doit être compris entre 0 exclus et 100 000 exclus";
					}
					else if($what=="tauxRemise")
					{
						if(strlen($new)==0)$err[]="Le taux de remise n'est pas renseigné";
						if (($new>=100) OR ($new<0)) $err[]="Le taux de remise doit être compris entre 0 inclus et 100 exclus. (C'est un pourcentage)";
						if(!preg_match(self::NUM_REG,$new))	$err[]="Le taux est mal renseigné";
					}
					
					if(!isset($err[0]))
					{
						$mm=new ModeleManager(DB::get_instance());
						$mod=$mm->get($this->req->id);
						if($mod)
						{
							$method = 'set'.ucfirst($what);
							$mod->$method($new);
							$mm->update($mod);
							echo json_encode("ok");
							exit;	
						}
						else exit;
					}
					else 
					{
						echo json_encode($err);
						exit;
					}
				} else exit;
			} 
			else exit;
		}
	}