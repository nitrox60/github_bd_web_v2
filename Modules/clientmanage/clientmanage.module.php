<?php

	class Clientmanage extends Module{
	
	const STREET_LENGTH=50;
	 const STREET_REG="/^[0-9]{1,4} [a-zA-Z]+/";//Minimum accepté par le regex : un chiffre(espace)une lettre
	 const CP_REG1='#^[0-9]{5}$#';
	 const CP_REG2='#^0{2}[0-9]{3}$#';
	 const CITY_LENGTH=30;
	 const MIN_MDP=8;
	 const MAX_MDP=18;
	
	public function action_index()
	{
		$this->set_title("Loca-Rent - Mon Compte");
		if($this->session->ouverte())
		{
			$user=$this->session->session_ouverte();
			//echo var_dump($user);
			/*
			$f=new Form("?module=clientmanage&action=valide","form");	//Creation du formulaire
			$f->add_text("Email","Email","Email")->set_value($user->getMail());
			$f->add_text("Mdp","Mdp","Mot de passe")->set_value($user->getMdp());
			$f->add_text("rue","rue","Rue")->set_value($user->getRue());
			$f->add_text("cp","cp","Code Postal")->set_value($user->getCodePostal());
			$f->add_text("ville","ville","Ville")->set_value($user->getVille());
			$f->add_submit("Valider","Valider")->set_value("Valider");*/
			$this->tpl->assign("user",$user);
		}
		else
		{
			$this->site->ajouter_message("Vous n'êtes pas connecté(e)");
			Site::redirect("index");
		
		}
	
	}
	
	public function action_valmailajax()
	{
		$bool=false;
		if($this->session->ouverte())
		{
			if($this->req->mail)
			{
				$cm=new ClientManager(DB::get_instance());
				if($cm->chercherParMail($this->req->mail))
				{
					$bool="invalide";
				}
				else if(filter_var($this->req->mail,FILTER_VALIDATE_EMAIL))
				{
					$user=$this->session->session_ouverte();
					$clt=$cm->get($user->getIdClient());
					$clt->setMail($this->req->mail);
					$bool=true;
					
					$cm->update($clt);
					$this->session->fermer();
					$this->session->ouvrir($clt);
				
				}
				else $bool=false;
		
			}
			else
			{
				$bool=false;
			}
		
		}
		echo json_encode($bool);
		exit;
		
	
	}
	
	public function action_valadrajax()
	{
	
		$res['ok']=false;
		if($this->session->ouverte())
		{
			if( ($this->req->rue) && ($this->req->ville) && ($this->req->cp) )
			{
				
				$res['rue']="";		
				$res['cp']="";		
				$res['ville']="";		
							// --- Champs rue --- //
				if(strlen($this->req->rue)>=self::STREET_LENGTH)
				$rue['rue']="La taille de la rue doit être inférieur à ".self::STREET_LENGTH." caractères";
				if(!preg_match(self::STREET_REG,$this->req->rue))
				$res['rue']="Format incorrect (ex: 7 rue principal)";
				// --- Champs Code postal --- //
				if( (!preg_match(self::CP_REG1,$this->req->cp)) OR (preg_match(self::CP_REG2,$this->req->cp)))	
				$res['cp']="Format du code postal incorrect.";
			
				if(strlen($this->req->ville)>=self::CITY_LENGTH) 
				$res['ville']="La taille de la ville ne doit pas exceder ".self::CITY_LENGTH." caractères";
		
		
				if( ($res['rue']=="") && ($res['ville']=="") && ($res['cp']=="") )
				{
					$res['ok']=true;
					$cm=new ClientManager(DB::get_instance());
					$user=$this->session->session_ouverte();
					$clt=$cm->get($user->getIdClient());
					$clt->setRue($this->req->rue);
					$clt->setCodePostal($this->req->cp);
					$clt->setVille($this->req->ville);
					
					
					$cm->update($clt);
					$this->session->fermer();
					$this->session->ouvrir($clt);
				}
			}
			
		
		}
		echo json_encode($res);
		exit;
	
	
	}
	
	
	public function action_valmdpajax()
	{
	
		$res['ok']=false;
		if($this->session->ouverte())
		{
			if( ($this->req->oldmdp) && ($this->req->newmdp) && ($this->req->newmdpconf) )
			{
				$cm=new ClientManager(DB::get_instance());
				$user=$this->session->session_ouverte();
				$clt=$cm->get($user->getIdClient());
				$res['newmdp']="";		
				$res['oldmdp']="";		
				$res['mdpconf']="";		
				if(md5($this->req->oldmdp)!=$clt->getMdp()) $res['oldmdp']="Le mot passe est incorrecte";
				
				if(strlen($this->req->newmdp)<self::MIN_MDP) $res['newmdp']="Le mot de passe est trop petit";
			else if(strlen($this->req->newmdp)>self::MAX_MDP) $res['newmdp']="Le mot de passe est trop grand";
			
				if($this->req->newmdp!=$this->req->newmdpconf) $res['mdpconf']="La confirmation est différente du nouveau mot de passe";
		
				if( ($res['oldmdp']=="") && ($res['mdpconf']=="") && ($res['newmdp']=="") )
				{
					$res['ok']=true;
					
					
					
					$clt->setMdp($this->req->newmdp);
					
					
					$cm->update($clt);
					$this->session->fermer();
					$this->session->ouvrir($clt);
				}
			}
			
		
		}
		echo json_encode($res);
		exit;
	
	
	}
	
	}