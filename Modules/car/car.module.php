<?php

	class car extends Module{
	
	
	public function action_index()
		{
			if($this->session->ouverte())
			{
				$this->set_title("Module Nos voitures");
				
				
				if($this->req->name)
				{
					$db=DB::get_instance();
					$modm= new ModeleManager($db);
					$imgm= new ImageManager($db);
					$mod=$modm->getByName($this->req->name);
					$cm=new CommentaireManager($db);
					if($mod)
					{
						$idmodele=$mod->getIdModele();
						$listeCom=$cm->listing($idmodele);
						$this->tpl->assign("com",$listeCom);
						$listeImg=$imgm->listing($idmodele);
						$this->tpl->assign("photo",$listeImg);
					}
					else Site::redirect('loc','index');
				}
				else Site::redirect('index');
				$fcom=new Form("?module=car&action=validcom&name=".$this->req->name,"f_com");
				$i=0;
				$notes[]='';
				while($i<6)
				{
					$notes[]=$i;
					$i++;
				}
				$fcom->add_select("note","note","Note",$notes);
				$fcom->add_textarea("com","com","");
				$fcom->add_submit("","","")->set_value("Envoyez");
				$this->tpl->assign("f_com",$fcom);
			}
			else Site::redirect("login");
		}
		
		public function action_validcom()
		{
			$com['idClient']=$this->session->session_ouverte()->getIdClient();
			$modm=new ModeleManager(DB::get_instance());
			$mod=$modm->getByName($this->req->name);
			$com['idModele']=$mod->getIdModele();
			$com['contenu']=$this->req->com;
			$com['note']=($this->req->note-1);
			$com['dateCom']=date('Y-m-d',time()+7200);
			$commentaire = new Commentaire($com);
			$comm= new CommentaireManager(DB::get_instance());	
			$comm->add($commentaire);
			Site::redirect("car","index&name=".$this->req->name);
		}
	}
?>