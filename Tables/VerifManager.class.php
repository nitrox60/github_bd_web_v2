<?php
	class VerifManager{
	
		private $_db; //instance de PDO
		
		public function __construct($db)
        {
            $this->setDb($db);
        }
		
		public function add(Verif $v){
			
			$req=$this->_db->prepare("INSERT INTO verif SET codeVerif=:ver, idClient=:id");
			$req->execute(array(":ver" =>$v->getCodeVerif(),
								":id" =>$v->getIdClient()
				));
			
			
		}
		public function test($id)
		{
		
		}
		
			//regarde si un code a déja été envoyez ou pas.

		public function isOk($idClt)
		{
			$req=$this->_db->prepare("SELECT * FROM verif WHERE idClient=:id");
			$req->execute(array(":id" => $idClt));
			
			$res=$req->fetch(PDO::FETCH_ASSOC);
			if($res)return new Verif($res);
			else return null;
		
		}
		public function setDb($db){
			$this->_db=$db;
		
		}
		/*
		public function listing(){
		
					
		}
		*/
		 public function delete(Verif $ver)
		  {
			$req=$this->_db->prepare("DELETE FROM verif WHERE idVerif=:id");
			$req->execute(array(":id" => $ver->getIdVerif()));
		  }
		  
	}