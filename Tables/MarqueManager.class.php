<?php
	class MarqueManager{
	
		private $_db; //instance de PDO
		
		public function __construct($db)
        {
            $this->setDb($db);
        }
		
		public function setDb($db){
			$this->_db=$db;
		
		}
		
		public function add(Marque $mq){
			if($mq->getAddable())
			{
				$q = $this->_db->prepare("INSERT INTO marque SET nomMarque=:marque");
				
				$q->execute(array(":marque" => $mq->getNomMarque()							
				));
				echo "add";
			}
			else echo "conditions non validées. voir trigger_error";
		}
	
		
		
		public function listing(){
		
			$q=$this->_db->query("SELECT * FROM marque");
			$i=0;
			while($rep=$q->fetch(PDO::FETCH_ASSOC))
			{
				$tab[]=new Marque($rep);
			}
		return $tab;
		}
		
		 public function delete(Marque $mq)
		  {
			$req=$this->_db->prepare("DELETE FROM marque WHERE idMarque=:id");
			$req->execute(array(":id" => $mq->getIdMarque()));
			// print_r($this->_db->errorInfo());
		  }

		  public function get($id)
		  {
			
				$req=$this->_db->prepare("SELECT * FROM marque WHERE idMarque=:id");
				$req->execute(array(":id"=>$id));
				$rep=$req->fetch(PDO::FETCH_ASSOC);
				if($rep)return new Marque($rep);
				else return null;
			
		  }
		  
		  public function getByName($name)
		  {
			$req=$this->_db->prepare("SELECT * FROM marque WHERE nomMarque=:nom");
				$req->execute(array(":nom"=> $name));
				$rep=$req->fetch(PDO::FETCH_ASSOC);
				if($rep)return new Marque($rep);
				else return null;
		  }
		  
		  public function exist($nom)
		  {
			$req=$this->_db->prepare("SELECT * FROM marque WHERE nomMarque=:name");
			$req->execute(array(":name" => $nom));
			$rep=$req->fetch(PDO::FETCH_ASSOC);
			if($rep)return true;
			else return false;
		  
		  }

		

		  public function update(Marque $m)
		  {
			$req=$this->_db->prepare("UPDATE marque SET nomMarque=:marque WHERE idMarque=:id");
			$req->execute(array(":marque" => $m->getNomMarque(),
								":id" => $m->getIdMarque()));
		  }
	}