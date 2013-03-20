<?php
	class admVoiture extends Module{
		const YEAR_REG='/^[1-2]{1}+[0-9]{3}$/';
		public function action_index()
		{
			$this->set_title("Module Admin ");
			$f=new Form("?module=admVoiture&action=valide&id=".$this->req->id,"f_add");
			$f->add_text("annee","annee","Année");
			$f->add_text("km","km","Kilométrage");
			$f->add_textarea("des","des","Description");
			$f->add_submit("valide","valide")->set_value("Valider");
			$this->tpl->assign("f_add",$f);
			$this->session->f_add=$f;
		}
		
		public function action_valide()
		{
			if(!preg_match(self::YEAR_REG,$this->req->annee)) $errors[]="L'année doit être au format YYYY. (Exemple : 1900 ou 2015)";
			
			if(strlen($this->req->km)==0)$errors[]="Le kilométrage n'est pas renseigné!";
			else if(($this->req->km<0) OR ($this->req->km>=1000000))$errors[]="Le kilométrage doit être compris entre 0 inclus et !";
			
			if(strlen($this->req->des)==0)$errors[]="La description n'est pas renseignée!";
			
			if(isset($errors[0]))
			{
				foreach($errors as $err)
				{
					$this->site->ajouter_message($err);
					
				}
				Site::redirect("admVoiture","index&id=".$this->req->id);
			
			}
			else
			{
					if($this->req->id)
					{
						$db=DB::get_instance();
						$vm= new VoitureManager($db);
						$modm= new ModeleManager($db);
						$mod=$modm->get($this->req->id);
						$mod->setQteStock($mod->getQteStock()+1); // Quand on ajoute une voiture le stock est incrémmenté
						$modm->update($mod);
						$car['annee']=$this->req->annee;
						$car['km']=$this->req->km;
						$car['description']=$this->req->des;
						$car['idModele']=$this->req->id;
						
						$car['cheminPhoto']="/picture/leSETestAchangerDansLaClasse";	//Ce champs va disparaitre dans la version suivante.
						$voiture=new Voiture($car);
						$vm->add($voiture);
						$this->site->ajouter_message("Ajoutée");
						Site::redirect("admMarque");
					}
					else Site::redirect("index");
			
			}
		}
		public function action_delete()
		{
			$db=DB::get_instance();
			$vm= new VoitureManager($db);
			$modm= new ModeleManager($db);
			$v=$vm->get($this->req->idVoiture);
			$mod=$modm->get($this->req->idModele);
			$mod->setQteStock($mod->getQteStock()-1); // Quand on supprime une voiture le stock est décrémmenté
			$modm->update($mod);
			$vm->delete($v);
			$this->site->ajouter_message("voiture supprimé!");
			Site::redirect("admMarque");
		}
		public function action_ajax()
		{
			// Pour afficher les voitures quand on clique sur un modèle
			if($this->req->id)
			{
				$vm=new VoitureManager(DB::get_instance());
				$liste=$vm->listing($this->req->id);
				$i=0;
				$tab=array();
				foreach($liste as $car)
				{
					$tab[$i]['idVoiture']=$car->getIdVoiture();
					$tab[$i]['annee']=$car->getAnnee();
					$tab[$i]['km']=$car->getKm();
					$tab[$i]['description']=$car->getDescription();
					$i=$i+1;
				}
				echo json_encode($tab);
				exit;
			
			}
			else Site::redirect('index');
		}
	
	}