<?php
class Index extends Module{

	public function action_index(){
			Site::redirect("loc");	// La page d'accueil est la page de location
	}
}	
?>