<?php
	class LocationManager{
	
		private $_db; //instance de PDO
		
		public function __construct($db)
        {
            $this->setDb($db);
        }
		
		public function setDb($db){
			$this->_db=$db;
		
		}
		
		public function add(Location $loc){
		
			$q = $this->_db->prepare("INSERT INTO location SET dateLoc=:dateL, dateRendu=:dateR, prixLoc=:prixL, idVoiture=:idV, idClient=:idC ");
			if($loc->getAddable())
			{
				$q->execute(array(":dateL" => $loc->getDateLoc(),
									":dateR" => $loc->getDateRendu(),
									":prixL" => $loc->getPrixLoc(),
									":idV" => $loc->getIdVoiture(),
									":idC" => $loc->getIdClient()
				));
				echo "add";
			}
			else echo "Les conditions d'ajouts ne sont pas validées! Voir trigger_error";
			
		}
		
		/** infoLoc recoit un idvoiture en paramètre et renvoie des informations sur la locations de la voiture en question ou null si la voiture n'est pas en location **/
		public function infoLoc($idvoiture)
		{
			
			
			$req=$this->_db->prepare("SELECT * FROM location WHERE idVoiture=:idv");
			$req->execute(array(":idv" => $idvoiture));
			
			while($tab=$req->fetch(PDO::FETCH_ASSOC))
			{
				$res[]=new Location($tab);
			}
		
			return $res;
		}
		
		public function isAvailable($id)
		{
			//$q=$this->_db->prepare("SELECT COUNT(location.idLoc) AS locUse, modele.qteStock  FROM modele,location WHERE location.idModele=modele.idModele AND idModele=:id GROUP BY idLoc");
			$q=$this->_db->prepare("SELECT * FROM location WHERE idVoiture=:id");
			$q->execute(array(":id" => $id));
			$flag2=false; // passe a vrai si UNE seul reservation est dans moin d'un jour de la date voulu de debut de loc.
			$flag=false;
			$enter=false;
			
			while($res=$q->fetch(PDO::FETCH_ASSOC))
			{
				$enter=true;
				/* --dt1 ->date debut loc  -- dt2 now --dt3 date fin loc  --*/
				$dt1= new DateTime($res['dateLoc']);
				$dt2= new DateTime(date('Y-m-d h:i:s',time()+7200));
				$dt3= new DateTime($res['dateRendu']);
				
				$interval = $dt1->diff($dt2);
				$intdt= $interval->format('%r%a');
				
				$interval2 = $dt3->diff($dt2);
				$intdt2= $interval2->format('%R%a');
				
				if((int)$intdt>-1) //Si il y a au minimun 1 jour de moin entre le date du début de location et maintenant.
				{
					$flag=true;
					
					
				}else $flag2=true;
				
				
				if((int)$intdt2>=1) $flag=true; //il faut au mini 1 jour d'écart entre le moment actuel et le moment du rendu
				else $flag2=true;
				
				
				
				
				
			}
			if($enter)//test si on entre dans le while car si on rentre pas la voiture n'est pas loué
			{
				if(!$flag2)	return $flag;
				else return false;
			}
			else return true;
		
		}
	
		
		
		public function listing(){
		
			$q=$this->_db->prepare("SELECT * FROM location ");
			$q->execute();
			while($rep=$q->fetch(PDO::FETCH_ASSOC))
			{
				$tab[]=new Location($rep);
			}
		return $tab;
		}
		
		 public function delete(Location $loc)
		  {
			$req=$this->_db->prepare("DELETE FROM location WHERE idLoc=:id");
			$req->execute(array(":id" => $loc->getIdLoc()));
		  }

		  public function get($id)
		  {
			
				$req=$this->_db->prepare("SELECT * FROM location WHERE idLoc=:id");
				$req->execute(array(":id"=>$id));
				$rep=$req->fetch(PDO::FETCH_ASSOC);
				if($rep)return new Location($rep);
				else return null;
			
			}
	}