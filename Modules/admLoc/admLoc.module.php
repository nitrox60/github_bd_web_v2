<?php
	
	class AdmLoc extends Module{
	 
		public function action_index()
		{
			$db=DB::get_instance(); //Variable contenant l'instance PDO.
			$lm=new LocationManager($db);
			$marquem=new MarqueManager($db);
			$modm=new ModeleManager($db);
			$cm=new VoitureManager($db);
			
			$liste=$lm->listing();
			foreach($liste as $l)
			{
				$car=$cm->get($l->getIdVoiture());
				$mod=$modm->get($car->getIdModele());
				$marque=$marquem->get($mod->getIdMarque());
				$l->marque=$marque;
				$l->mod=$mod;
				$l->car=$car;
				
				// date à tester :
				$now = date('Y-m-d H:i:s',time()+3600);//Date actuelle.
				$tmp2=explode(" ",$l->getDateRendu());
				
				$finloc=$l->getDateRendu();
				
				$debloc =$l->getDateLoc();
				
				
				// on transforme les date en objet datetime. format YYYYMMDDHHMMSS ( 2009-10-10 10:00:00 donnera 20091010100000).
				$now = new DateTime($now);
				$now = $now->format('YmdHis');
				$debloc = new DateTime($debloc);
				$debloc = $debloc->format('YmdHis');
				$finloc = new DateTime($finloc);
				$finloc = $finloc->format('YmdHis');
				
				
				if(($now<$finloc) && ($now>=$debloc))$l->stat="en-cours";
				if($now>$finloc)$l->stat="terminee";
				// if( $now < $next ) $l->stat="en-cours";//« next est dans le futur »;
				// else $l->stat="terminee";//echo « next est dans le passé »;
				// $l->stat="terminee";
				// $l->stat="en-cours";
				
			}
			$this->tpl->assign("liste",$liste);
			$this->set_title("Module Admin Location");
		}

		public function action_ajaxdelete()
		{
			if($this->req->idloc)
			{
				$db=DB::get_instance();
				$lm=new LocationManager($db);
				$loc=$lm->get($this->req->idloc);
				echo var_dump($loc);
				echo var_dump($this->req->idloc);
				if($loc)
				$lm->delete($loc);
				exit;
			}
		}
	}
?>