<?php
	class ClientManager{
	
		private $_db; //instance de PDO
		
		public function __construct($db)
        {
            $this->setDb($db);
        }
		
		public function add(Client $clt){
		
			if($clt->getAddable())
			{
				$q = $this->_db->prepare("INSERT INTO client SET  nom=:nom, prenom=:prenom, rue=:rue, codePostal=:cp, ville=:ville, vip=:vip, dateInscription=:dateIns,  mail=:mail, mdp=:mdp, validate=:val");
				
				$q->execute(array(":nom" => $clt->getNom(),
									":prenom" => $clt->getPrenom(),
									":rue" => $clt->getRue(),
									":cp" => $clt->getCodePostal(),
									":ville" => $clt->getVille(),
									":vip" => $clt->getVip(),
									":dateIns" => $clt->getDateInscription(),
									":mail" => $clt->getMail(),
									":mdp" => $clt->getMdp(),
									":val"=>$clt->getValidate()
				));
				
			}
			
		}
	
		public function setDb($db){
			$this->_db=$db;
		
		}
		
		public function listing(){
		
			$q=$this->_db->query("SELECT * FROM client");
			while($rep=$q->fetch(PDO::FETCH_ASSOC))
			{
				$tab[]=new Client($rep);
			}
			return $tab;		
		}
		
		 public function delete(Client $clt)
		  {
			$req=$this->_db->prepare("DELETE FROM client WHERE idClient=:id");
			$req->execute(array(":id" => $clt->getIdClient()));
		  }

		  public function get($id)
		  {
			$req=$this->_db->prepare("SELECT * FROM client WHERE idClient=:id");
			$req->execute(array(":id"=>$id));
			$rep=$req->fetch(PDO::FETCH_ASSOC);
			if($rep)return new Client($rep);
			else return null;
		  }
		  
		  public function connexion($log, $mdp)
		  {
			$mdpCrypt=md5($mdp);
			
			$req=$this->_db->prepare("SELECT * FROM client WHERE mail=:log AND mdp=:mdp");
			$req->execute(array(":log" => $log,
								":mdp" => $mdpCrypt)
								);
			$rep=$req->fetch(PDO::FETCH_ASSOC);
			if($rep!=null)
			{
				return new Client($rep);
			}
			else return null;
		  
		  }
		  
		  public function chercherParMail($mail)
		  {
			$req=$this->_db->prepare("SELECT * FROM client WHERE mail=:mail");
			$req->execute (array(":mail"=>$mail));
			$rep=$req->fetch(PDO::FETCH_ASSOC);
			if($rep) return true;
			else return false;
		  }

		  public function update(Client $clt)
		  {
			$req=$this->_db->prepare("UPDATE client SET nom=:nom, prenom=:prenom, rue=:rue, codePostal=:cp, ville=:ville, vip=:vip, dateInscription=:dateIns,  mail=:mail, mdp=:mdp, validate=:val WHERE idClient=:id");
			
				
				$req->execute(array(":nom" => $clt->getNom(),
									":prenom" => $clt->getPrenom(),
									":rue" => $clt->getRue(),
									":cp" => $clt->getCodePostal(),
									":ville" => $clt->getVille(),
									":vip" => $clt->getVip(),
									":dateIns" => $clt->getDateInscription(),
									":mail" => $clt->getMail(),
									":mdp" => $clt->getMdp(),
									":val" => $clt->getValidate(),
									":id" => $clt->getIdClient()
				));
		  }
	}