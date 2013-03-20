<?php
class Login extends Module{
		
	public function init(){
		if($this->session->ouverte())
			$this->tpl->assign('login',$this->session->user->login);
	}

	public function action_index(){
	
		

		$this->set_title("module Connexion");		
		$f=new Form("?module=login&action=valide","f_log");	//Creation du formulaire
		$f->add_text("log","log","Login");		
		$f->add_password("mdp","mdp","Mot de passe");		
		
			
		$f->add_submit("Valider","valLog")->set_value('Valider');		

		$this->tpl->assign("f_log",$f);	
		$this->session->form = $f;//utilité?
		
	

		// A FAIRE
		// vérifier les données de connexion
		//charger le membre
		//$user=Membre::chercherParId(/*mettre l'id*/);
		//$this->session->ouvrir($user);
		
		//code de demo
		/*$m=new Membre($this->req->post("Login"),"Exemple");
		$this->session->user=$m;		
		$this->tpl->assign('login',$m->login);
		$this->site->ajouter_message("Vous êtes connecté en tant que ".$m->login);
		Site::redirect("index");*/
	}

	public function action_valide()
	{
		$cm= new ClientManager(DB::get_instance());
		$a=$cm->connexion($this->req->log,$this->req->mdp);
		if($a){
			//$this->tpl->assign('idClient',$a->getIdClient());
			$this->tpl->assign('idClient',$a->getIdClient());
			$this->tpl->assign('login',$a->getMail());
			$this->tpl->assign('nom',$a->getNom());
			$this->site->ajouter_message($a->getIdClient());
			$this->session->ouvrir($a);
		}
		else
		{
			$this->site->ajouter_message("Login ou mot de passe incorect");
			Site::redirect("login");
		}
	}
	
	public function action_coajax()
	{
		$res=array();
		$res['bool']=false;
		$cm= new ClientManager(DB::get_instance());
		$a=$cm->connexion($this->req->log,$this->req->mdp);
		if($a){
			
			$this->tpl->assign('idClient',$a->getIdClient());
			$this->tpl->assign('login',$a->getMail());
			$this->tpl->assign('nom',$a->getNom());
			
			$this->session->ouvrir($a);
			$res['bool']=true;
			$res['who']=$a->getMail();
		}
		echo json_encode($res);
		exit;
	}
	
	public function action_deconnect(){		
		$this->site->ajouter_message('Vous êtes déconnecté');							
		$this->session->fermer(); 			
		$this->site->redirect("index");
	}
	
	public function action_logadmin()
	{
		$this->set_title("Connexion Administrateur");	
		$this->site->ajouter_message("<span style=\"text-decoration: line-through;\">Login : admin // mdp : admin</span>");
		if(isset($this->session->formlogadm))
		{
					$f=$this->session->formlogadm;
					$f->populate();
					
		}
		else
		{	$f=new Form("?module=login&action=validelogadm","f_log");	//Creation du formulaire
			$f->add_text("log","log","Login");		
			$f->add_password("mdp","mdp","Mot de passe");		
			
				
			$f->add_submit("Valider","valLog")->set_value('Valider');		
		}

			$this->tpl->assign("f_logadm",$f);	
			$this->session->formlogadm = $f;//utilité?
	
	}
	
	public function action_validelogadm()
	{
		if(($this->req->log) AND ($this->req->mdp))
		{
		
			if($this->req->log!='admin')
			{	
				
					$f=$this->session->formlogadm;
					$f->populate();
					$this->session->formlogadm=$f;
					$this->site->ajouter_message("Login ou mot de passe incorrect");
					Site::redirect('login','logadmin');
			}
			else
			{
				$am= new AdminManager(DB::get_instance());
				$adm=$am->connexion($this->req->mdp);
				if($adm)
				{
					$this->session->ouvrir('admin');
					$this->site->ajouter_message("Bienvenue Admin");
					unset($this->session->formlogadm);
					Site::redirect('admSpace');
				}
				else
				{
					$f=$this->session->formlogadm;
					$f->populate();
					$this->session->formlogadm=$f;
					$this->site->ajouter_message("Login ou mot de passe incorrect");
					Site::redirect('login','logadmin');
				}
			
			}
		}
		else
		{
			$this->site->ajouter_message("Login ou mot de passe non renseigné");
			Site::redirect("login","logadm");
		}
	}
	
	public function action_verif()
	{
	
		if( ($this->req->codeVerif) && ($this->req->id))
		{
		  $db=DB::get_instance();
		  $vm=new VerifManager($db);
		  $verif=$vm->isOk($this->req->id);
		  if(!$verif)$res="Votre code n'est pas bon, si vous ne parvenez pas a activer votre compte même après avoir vérifié celui-ci contactez le support. (support AT loca-rent DOT fr) Remplez AT par '@' et DOT par '.'. ";
		  else
		  {
			if($verif->getCodeVerif()==$this->req->codeVerif)
			{

			}
			else
			{
				$res="Votre code n'est pas bon, si vous ne parvenez pas a activer votre compte même après avoir vérifié celui-ci contactez le support. (support AT loca-rent DOT fr) Remplez AT par '@' et DOT par '.'. ";
			}
		  }
		}
	}
}
?>