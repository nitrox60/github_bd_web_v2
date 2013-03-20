<?php
	class VoitureManager{
	
		private $_db; //instance de PDO
		
		public function __construct($db)
        {
            $this->setDb($db);
        }
		
		public function setDb($db){
			$this->_db=$db;
		
		}
		
		public function add(Voiture $car){
		
			$q = $this->_db->prepare("INSERT INTO voiture SET annee=:annee, km=:km , description=:descrip, idModele=:idMod ");
			if($car->getAddable()){
            $q->execute(array(":annee" => $car->getAnnee(),
								":km" => $car->getKm(),
								":descrip" =>$car->getDescription(),
								":idMod" => $car->getIdModele() 
			));
			echo "add";
			}
			else echo "Les conditions d'ajouts ne sont pas validées! Voir trigger_error";
		}
		
		public function listing($id){
		
			$q=$this->_db->prepare("SELECT * FROM voiture WHERE idModele=:id");
			$q->execute(array(":id"=> $id));
			while($rep=$q->fetch(PDO::FETCH_ASSOC))
			{
				$tab[]=new Voiture($rep);
			}
		return $tab;
		}
		
		 public function delete(Voiture $car)
		  {
			$req=$this->_db->prepare("DELETE FROM voiture WHERE idVoiture=:id");
			$req->execute(array(":id" => $car->getIdVoiture()));
		  }
		  
		   public function deleteAll(Modele $mod)
		  {
			$req=$this->_db->prepare("DELETE FROM voiture WHERE idModele=:id");
			$req->execute(array(":id" => $mod->getIdModele()));
		  }


		  public function get($id)
		  {
			$req=$this->_db->prepare("SELECT * FROM voiture WHERE idVoiture=:id");
			$req->execute(array(":id"=>$id));
			$rep=$req->fetch(PDO::FETCH_ASSOC);
			if($rep) return new Voiture($rep);
			else return null;
		  }
	}