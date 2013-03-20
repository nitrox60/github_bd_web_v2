<?php
	class AdmClient extends Module{
	 
		public function action_index()
		{
			$cm=new ClientManager(DB::get_instance());
			$liste=$cm->listing();
			$this->tpl->assign("liste",$liste);
			$this->set_title("Module Admin");
		}

		public function action_delete()
		{
			$cm=new ClientManager(DB::get_instance());
			$clt=$cm->get($this->req->id);
			$this->site->ajouter_message("ok");
			$cm->delete($clt);
			$this->site->ajouter_message($clt->getMail()." supprimé!");
			Site::redirect("admClient");
		}
	}
?>