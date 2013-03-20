<?php
/**
* OMGL3
* Class FrontController : chargeur/exécuteur de modules
*
*/
Class FrontController{

	public static $_content_="";

	public function __construct($config){
		foreach($config as $var=>$val)
			$this->$var=$val;
		$this->config=$config;
		
	}

	public function load_content(){

		//vérifie si un paramètre de module est passé, sinon : défaut
		$module= ( $this->req->module != '' ) ? $this->req->module : 'index';	
		//vérifie si une action est requise, sinon : index
		$action= ( $this->req->action != '')   ? $this->req->action : 'index';	
	/*
		require("modules/Login/login.module.php");
		$bloc_login=new Login();
		$bloc_login->set_variables($this->config);
		$bloc_login->init();
		$this->tpl->assign('bloc_login',$this->tpl->fetch("login.tpl"));
	*/	
		$this->tpl->assign('titre','Titre par défaut');
		$this->tpl->assign('module',$module);
		$this->tpl->assign('action',$action);

		//inclue le module en question
		if(!class_exists($module))
			if(file_exists("modules/$module/$module.module.php"))
				require("modules/$module/$module.module.php");
			else
				throw new Exception("Module inconnu : $module");


		//============= exécute le module ================================================================================
		//c'est ici qu'il faudrait vérifier la gestion des droits d'accès au module et à l'action demandée
		//================================================================================================================
		$mod=substr($module,0,3);
		if($mod=="adm")
		{
			if($this->session->ouverte()){
				if($this->session->user=='admin')$m=new $module();
				else {$this->site->ajouter_message("pas admin! mais {$this->session->user->getMail()}"); Site::redirect('index'); exit;}
			}else {$this->site->ajouter_message("Vous n'êtes pas connecté"); Site::redirect('login','logadmin'); exit;}
		}
		else $m=new $module();
		
		if($this->session->ouverte())
		{
			if ($this->session->user=='admin') $this->tpl->assign("login",$this->session->user);
			else $this->tpl->assign("login",$this->session->user->getMail());//Assigne la valeur de $login dans main.tpl
			
		}
		//nom du template à appeler, par défaut
		$m->set_tpl_name("$module"."-$action");
		//nom de la fonction à appeler
		$action="action_$action";
		//variables outils
		$m->set_variables($this->config);
		$m->init();

		if(method_exists($module,$action))
			$m->$action();
		else
			throw new Exception("Action inconnue : $module::$action");


		$res=$this->tpl->fetch("file:modules/$module/tpl/".$m->get_tpl_name().".tpl");
		$this->tpl->assign('bloc_contenu',$res);
		$this->tpl->assign('messages',$this->site->liste_messages());

	}	
	
	

}

?>