<?php

	 class Loc extends Module{
	
		public function action_index()
		{
			$this->set_title("Module Location ");
			$mm=new MarqueManager(DB::get_instance());
			$liste=$mm->listing();
			$option[]='';
			foreach($liste as $m)
			{
				$option[]=$m->getNomMarque();
			}
				$f=new Form("?module=loc&action=valide","f_loc");
				$f->add_select("marque","marque","Marque",$option);
				$this->tpl->assign("f_loc",$f);
				
				
			
		}
		public function action_ajax()
		{
			if($this->req->name)
			{
			$db=DB::get_instance();
				$mm= new MarqueManager($db);
				$modm= new ModeleManager($db);
				$mq=$mm->getByName($this->req->name);
				if($mq)
				{
					$listeMod=$modm->listing($mq->getIdMarque());
					
					foreach($listeMod as $mod)
					{
						$tab[]=$mod->getNomModele();
					}
					echo json_encode($tab);
					exit;
				}
				else Site::redirect('loc','index');
			
			}
			else Site::redirect('index');
		
		}
		
		public function action_isOK() //Renvoi true ( via ajax ) si l'user est co false sinon
		{
			$res=false;
			if($this->session->ouverte())
			{
				$res=true;
			}
			echo json_encode($res);
			exit;
		}
		
		public function action_ajaxmod()
		{
			if($this->req->name)
			{
				$db=DB::get_instance();
				$mm= new ModeleManager($db);
				$vm= new VoitureManager($db);
				$lm= new LocationManager($db);
				$mod=$mm->getByName($this->req->name);
				if($mod)
				{
					$listecar=$vm->listing($mod->getIdModele());
					$i=0;
					$open=false;
						if($this->session->ouverte()) $open=true;
						if(!$listecar)$tab="undefined";
						foreach($listecar as $car)
						{
							if($lm->isAvailable($car->getIdVoiture()))
							{
								$tab[$i]['disp']=true;//Test si dans la voiture parcouru est disponible.
								
							}
					        else $tab[$i]['disp']=false;
							
							$tab[$i]['id']=$car->getIdVoiture();
							$tab[$i]['annee']=$car->getAnnee();
							$tab[$i]['km']=$car->getKm();
							$tab[$i]['description']=$car->getDescription();
							if($open)$tab[$i]['open']=true;
							else $tab[$i]['open']=false;
							$i++;
						}
						echo json_encode($tab);
						exit;
				
				}
				else Site::redirect('loc');
			
			}
			else Site::redirect('loc');
		}
		
		public function action_rent()
		{
			if($this->session->ouverte())//si on est connecté 
			{
				if($this->req->id)
				{
					$f= new Form("?module=loc&action=valide&idmod=".$this->req->id,"form_rent");
					$f->add_dateAndTime("dateloc","dateloc", "Date location");
					$f->add_dateAndTime("daterendu","daterendu", "Date retour ");
					$f->add_hidden("id","id")->set_value($this->req->id);
					$f->add_submit("valider","valider")->set_value("Valider");
					$this->tpl->assign("f_rent",$f);
					$this->session->frent=$f;
					//echo var_dump($_SERVER['HTTP_USER_AGENT']);
				}
			}else Site::redirect("Login");
			
			
		
		}
		
		public function action_mail()
		{
			$subject="Loca-Rent : Bienvenue chère premier client.";
			$to="redouan.tayaa@gmail.com";
			$msg="<h2>LOCA-RENT</h2><br /><p>Bienvenue chez Loca-Rent,</p> vous êtes notre premier clients et vous recevez donc vous avez 1 location 100% OFFERTE!<br /><h1>PS: Toute voiture amenée eet revendu au Maroc sera FACTURé le DOUBLE !!<br /> Si vous ne souhaitez plus recevoir de mail ... Bah c'est dommage maintenant que j'ai trouvé comment on fait t'ai baizé !!";
			// Dans le cas où nos lignes comportent plus de 70 caractères, nous les coupons en utilisant wordwrap()
			//$msg = wordwrap($msg, 70, "\r\n");
			
			// Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

		 // En-têtes additionnels
		 $headers .= 'To: Redou l\'indou <redouan.tayaa@gmail.com>' . "\r\n";
		 $headers .= 'From: Loca-Rent <jordan.dalmas@gmail.com>' . "\r\n";
			mail($to,$subject,$msg,$headers);
		}
		
		public function action_infoajax() // Renvoie en ajax les informations de locations pour une voiture données
		{
			if($this->req->id)
			{
				$db=DB::get_instance();
				$lm=new LocationManager($db);
				$infos=$lm->infoLoc($this->req->id);
				$i=0;
				foreach($infos as $inf)
				{
					$tab[$i]['dateLoc']=$inf->getDateLoc();
					$tab[$i]['dateRendu']=$inf->getDateRendu();
					$i++;
				}
				if(!$infos)$tab="undefined";
			//	echo var_dump($tab);
				echo json_encode($tab);
				exit;
				
			}
			
		
		}
		
		public function action_valide()
		{
			$flag=false;
			if(($this->req->dateloc) AND($this->req->daterendu))
			{
				$locm=$this->req->datelocm;
				$loch=$this->req->dateloch;
				$rendum=$this->req->daterendum;
				$renduh=$this->req->daterenduh;
				
				//$this->site->ajouter_message($this->req->dateloc ."h ". $this->req->dateloch."_".$this->req->datelocm ."____".$this->req->daterendu ."h ". $this->req->daterenduh."_".$this->req->daterendum);
				if($this->req->dateloc>$this->req->daterendu)
				$this->site->ajouter_message("loc> rendu");
				else if($this->req->dateloc==$this->req->daterendu)
				{
					if($loch+6>$renduh) 
					{
						$this->site->ajouter_message("loc = rendu mais hloc>hrendu car durée minimal d'une location =6heure");
						$flag=true;
					}
					else if($loch==$renduh) 
					{
						$this->site->ajouter_message("Durée minimal d'une location = 6heures");
						$flag=true;
					}
				}
				
				//On récupère les locations de la voiture concerné pour vérifié que les date voulu par l'utilisateur sont libre.
				$lm=new LocationManager(DB::get_instance());
				$info=$lm->infoLoc($this->req->id);
				//dateloc et daterendu sont les date rentrer par l'utilisateur
				$dateloc=$this->req->dateloc." ".$this->req->dateloch.":".$this->req->datelocm.":00";
				$daterendu=$this->req->daterendu." ".$this->req->daterenduh.":".$this->req->daterendum.":00";
				$dateloc = new DateTime($dateloc);
				$dateloc = $dateloc->format('YmdHis');
				$daterendu = new DateTime($daterendu);
				$daterendu = $daterendu->format('YmdHis');
					
				foreach($info as $i)
				{
					
					// date à tester :
					$start=$i->getDateLoc();
					$stop=$i->getDateRendu();
					$now = date('Y-m-d H:i:s',time()+3600);//Date actuelle.
					//$tmp2=explode(" ",$l->getDateRendu());
					
					
					
					
					// $finloc=$l->getDateRendu();
					
					// $debloc =$l->getDateLoc();
					
					
					// on transforme les date en objet datetime. format YYYYMMDDHHMMSS ( 2009-10-10 10:00:00 donnera 20091010100000).
					//start et stop sont les date de debut/fin des différent location enregistrer en DB
					$start = new DateTime($start);
					$start = $start->format('YmdHis');
					$stop = new DateTime($stop);
					$stop = $stop->format('YmdHis');
					$now = new DateTime($now);
					$now = $now->format('YmdHis');
					
					
					
					/*
					$debloc = new DateTime($debloc);
					$debloc = $debloc->format('YmdHis');
					$finloc = new DateTime($finloc);
					$finloc = $finloc->format('YmdHis');
					*/
					if( ( ($start<=$dateloc)&&($stop>=$dateloc) ) || ( ($dateloc<=$now) || ($daterendu<=$now) ) || ( ($start<=$daterendu)&&($stop>=$daterendu) ))
					{
						$flag=true;
					}
					
				}
				//location pas encore completement au point
				
				if(!$flag) //Si la location est validé
				{
					$user=$this->session->user;
					$l['dateLoc']=$this->req->dateloc." ".$loch.":".$locm.":00";
					$l['dateRendu']=$this->req->daterendu." ".$renduh.":".$rendum.":00";
					$l['prixLoc']="75000"; //prix arbitraire temporaire
					$l['idVoiture']=$this->req->id;
					$l['idClient']=$user->getIdClient();
					$loc=new Location($l);
					
					$lm->add($loc);
					$this->site->ajouter_message("Location enregistrée!");
					Site::redirect("index");
				}
				else $this->site->ajouter_message("Vos dates de location ne sont pas valide.");
				
			}else $this->site->ajouter_message("date loc ou date rendu non renseigné");
			Site::redirect("loc","rent&id=".$this->req->id);
		}
		
		public function action_nojs()
		{
		
		}
	
	}