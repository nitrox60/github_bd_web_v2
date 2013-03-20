<?php

	class AdmMarque extends Module{
		const VAL_REG="/^[a-zA-Z]{1}/";
	
		public function action_index()
		{
			$mm=new MarqueManager(DB::get_instance());
			$liste=$mm->listing();
			$this->tpl->assign("liste",$liste);
			$this->set_title("Module Admin ");	
		
		}
		
		public function action_add()
		{
			if($this->req->id)	$op="update";
			else $op="add";
			$this->set_title("Module Admin Ajouter");	
			$f=new Form("?module=admMarque&action=valide&type=".$op,"f_add");
			
			if($this->req->id)$f->add_hidden("id","id","Id")->set_value($this->req->id);
			$f->add_text("marque","marque","Marque");
			
			$f->add_submit("Valider","val_up")->set_value("Valider");
			
			$this->tpl->assign("f_add",$f);
			
			$this->session->formAdd = $f;
		}
		
		public function action_delete()
		{
			$db=DB::get_instance();
			$mm=new MarqueManager($db);
			$modm=new ModeleManager($db);
			$vm=new VoitureManager($db);
			$marque=$mm->get($this->req->id);
			if($marque)
			{
				$liste=$modm->listing($this->req->id);
				foreach($liste as $mod)	$vm->deleteAll($mod);
				
				$modm->deleteAll($marque);
				
				$mm->delete($marque);
				$this->site->ajouter_message($marque->getNomMarque()." supprimé");
				Site::redirect("admMarque");
			}
			else $this->site->ajouter_message("erreur lors de la suppression");
			
		}
		
		public function action_valide()
		{
			$mm=new MarqueManager(DB::get_instance());
			//tester si la marque existe deja!
			$exist=$mm->exist($this->req->marque);
			if($exist) $errors[]="La marque existe déjà";
			else if(strlen($this->req->marque)==0)$errors[]="Le champs marque n'est pas renseigné!";
			else if(!preg_match(self::VAL_REG,$this->req->marque))$errors[]="Le champs marque de la marque est mal renseigné";
			if( isset($errors[0]))
			{
				foreach($errors as $err)	$this->site->ajouter_message($err);
				Site::redirect("admMarque");
			
			}
			else
			{
				$m['nomMarque']=$this->req->marque;
				if($this->req->type=="update")
				{

					$m['idMarque']=$this->req->id;
					$marque=new Marque($m);
					$mm->update($marque);
					$this->site->ajouter_message("Modifié!");
					Site::redirect("admMarque");
				}
				else if($this->req->type=="add")
				{
					$marque=new Marque($m);
					$mm->add($marque);
					$this->site->ajouter_message("Ajouté!");
					Site::redirect("admMarque");
				}
			}
		}
	}
?>