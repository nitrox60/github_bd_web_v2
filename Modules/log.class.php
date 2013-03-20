<?php
	class Log extends Module{
		
		public function init(){}

	public function action_index(){

		$this->set_title("module ex3");		
		$f=new Form("?module=log&action=valide","log");	//Creation du formulaire
		$f->add_text("log","log","Login");		
		$f->add_password("mdp","mdp","Mot de passe");		
		$f->add_password("mdp2","mdp2","Confirmation");		
			
		$f->add_submit("Valider","valLog")->set_value('Valider');		

		$this->tpl->assign("f_log",$f);	
		$this->session->form = $f;
		
	}
	
	
	}