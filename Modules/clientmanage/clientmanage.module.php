<?php

	class Clientmanage extends Module{
	
	public function action_index()
	{
		if($this->session->ouverte())
		{
			$user=$this->session->session_ouverte();
			//echo var_dump($user);
			
			$f=new Form("?module=clientmanage&action=valide","form");	//Creation du formulaire
			$f->add_text("Email","Email","Email")->set_value($user->getMail());
			$f->add_text("Mdp","Mdp","Mot de passe")->set_value($user->getMdp());
			$f->add_text("rue","rue","Rue")->set_value($user->getRue());
			$f->add_text("cp","cp","Code Postal")->set_value($user->getCodePostal());
			$f->add_text("ville","ville","Ville")->set_value($user->getVille());
			$f->add_submit("Valider","Valider")->set_value("Valider");
			$this->tpl->assign("form",$f);
		}
		else
		{
			$this->site->ajouter_message("Vous n'êtes pas connecté(e)");
			Site::redirect("index");
		
		}
	
	}
	
	
	}