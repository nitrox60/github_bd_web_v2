<?php
	class AdminManager{
	
		private $_db; //instance de PDO
		
		public function __construct($db)
        {
            $this->setDb($db);
        }
		
		public function add(Admin $adm){
		
			if($adm->getAddable())
			{
				$q = $this->_db->prepare("INSERT INTO admin SET mdpAdm=:mdp");
				
				$q->execute(array(":mdp" => $adm->getMdpAdm()								
				));
				echo "add";
			}
			else echo "conditions non validées. voir trigger_error";
		}
	
		public function setDb($db){
			$this->_db=$db;
		
		}
		
		public function listing(){
		
			$q=$this->_db->query("SELECT * FROM client");
			while($rep=$q->fetch(PDO::FETCH_ASSOC))
			{
				echo "$rep[idClient] -- $rep[nom] -- $rep[prenom] -- $rep[rue] -- $rep[codePostal] -- $rep[ville] <br /> $rep[vip] -- $rep[dateInscription] -- -- $rep[mail] -- $rep[mdp]<br /><br />";
			}
		
		}
		
		 public function delete(Client $clt)
		  {
			$req=$this->_db->prepare("DELETE FROM client WHERE idClient=:id");
			$req->execute(array(":id" => $clt->getIdClient()));
		  }

		  public function get($id)
		  {
			
				$req=$this->_db->prepare("SELECT * FROM admin WHERE idADm=:id");
				$req->execute(array(":id"=>$id));
				$rep=$req->fetch(PDO::FETCH_ASSOC);
				if($rep)return new Admin($rep);
				else return null;
			
		  }
		  
		  public function connexion($mdp)
		  {
			$mdpCrypt=md5($mdp);
			
			$req=$this->_db->prepare("SELECT * FROM admin WHERE  mdpAdm=:mdp");
			$req->execute(array(":mdp" => $mdpCrypt)
								);
				$rep=$req->fetch(PDO::FETCH_ASSOC);
			if($rep!=null)
			{
				
				return new Admin($rep);
			}
			else return null;
		  
		  }
	}