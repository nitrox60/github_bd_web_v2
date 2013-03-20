<?php
	class ModeleManager{
	
		private $_db; //instance de PDO
		
		public function __construct($db)
        {
            $this->setDb($db);
			// $db <--> DB::get_instance();
        }
		
		public function setDb($db){
			$this->_db=$db;
		
		}
		
		public function add(Modele $mod){
			if($mod->getAddable())
			{
				$q = $this->_db->prepare("INSERT INTO modele SET nomModele=:modele, idMarque=:idM, qteStock=:stock, prix=:prixL, tauxRemise=:taux");
				
				$q->execute(array(":modele" => $mod->getNomModele(),
									":idM" => $mod->getIdMarque(),
									":stock" => $mod->getQteStock(),
									":prixL" => $mod->getPrix(),
									":taux" => $mod->getTauxRemise()
				));
				echo "add";
			}
			else echo "conditions non validées voir trigger_error";
		}
		
		public function getByName($name)
		{
			$req=$this->_db->prepare("SELECT * FROM modele WHERE nomModele=:nom");
			$req->execute(array(":nom"=> $name));
			$rep=$req->fetch(PDO::FETCH_ASSOC);
			if($rep)return new Modele($rep);
			else return null;
		}
	
		
		
		public function listing($id){
		
			$q=$this->_db->prepare("SELECT * FROM modele WHERE idMarque=:id");
			$q->execute(array(":id"=> $id));
			while($rep=$q->fetch(PDO::FETCH_ASSOC))
			{
				$tab[]=new Modele($rep);
			}
			return $tab;
		}
		
		 public function delete(Modele $mod)
		  {
			$req=$this->_db->prepare("DELETE FROM modele WHERE idModele=:id");
			$req->execute(array(":id" => $mod->getIdModele()));
		  }
		  
		    public function deleteAll(Marque $mq)
		  {
			$req=$this->_db->prepare("DELETE FROM modele WHERE idMarque=:id");
			$req->execute(array(":id" => $mq->getIdMarque()));
		  }

		  public function get($id)
		  {
			
				$req=$this->_db->prepare("SELECT * FROM modele WHERE idModele=:id");
				$req->execute(array(":id"=>$id));
				$rep=$req->fetch(PDO::FETCH_ASSOC);
				if($rep)return new Modele($rep);
				else return null;
			
		  }
		  
		    public function exist($nom)
		  {
			$req=$this->_db->prepare("SELECT * FROM modele WHERE nomModele=:name");
			$req->execute(array(":name" => $nom));
			$rep=$req->fetch(PDO::FETCH_ASSOC);
			if($rep)return true;
			else return false;
		  
		  }

		

		  public function update(Modele $mod)
		  {
			$req=$this->_db->prepare("UPDATE modele SET nomModele=:nom, qteStock=:qte, prix=:px, tauxRemise=:tx WHERE idModele=:id");
			$req->execute(array(":nom" => $mod->getNomModele(),
								":qte" => $mod->getQteStock(),
								":px" => $mod->getPrix(),
								":tx" => $mod->getTauxRemise(),
								":id" => $mod->getIdModele()));
		  }
	
	
	
	}