<?php

	class Commentaire{
		private $_idCom;
		private $_idModele;
		private $_idClient;
		private $_dateCom;
		private $_contenu;
		private $_note;
		private $_addable;
		
		public function __construct(array $donnees)
		{
			$this->hydrate($donnees);
		
		}
		
		public function hydrate(array $donnees)
	{
		foreach ($donnees as $key => $value)
		{
        $method = 'set'.ucfirst($key);
        
        if (method_exists($this, $method))
        {
            $this->$method($value);
        }
		}
	}
	//getters
		public function getIdCom(){ return $this->_idcom;}
		public function getIdModele(){ return $this->_idModele;}
		public function getIdClient(){ return $this->_idClient;}
		public function getDateCom(){ return $this->_dateCom;}
		public function getContenu(){ return $this->_contenu;}
		public function getNote(){ return $this->_note;}
		public function getAddable(){ return $this->_addable;}
		
	//setters
	
		 public function setIdCom($id)
		{
			$id=(int)$id;
			$this->_idCom=$id;
		}
	
		public function setIdModele($voiture){
		
			if($voiture!=null){
			$this->_idModele=$voiture;
			}
			else 
			{
				trigger_error("La CS IdModele ne peut pas être null",E_USER_WARNING);
				$this->_addable=false;
			}
		}
		
		public function setIdClient($auteur){
		
			if($auteur!=null){
			$this->_idClient=$auteur;
			}
			else 
			{
				trigger_error("La CS idClient ne peut pas être null",E_USER_WARNING);
				$this->_addable=false;
			}
			
		}
		
		public function setDateCom($date){
		
			if(is_string($date)){
			$this->_dateCom=$date;
			}
			else 
			{
				trigger_error("La dateCom n'est pas une string",E_USER_WARNING);
				$this->_addable=false;
			}
		}
		
		public function setContenu($contenu){
		
			if($contenu!=""){
			$this->_contenu=$contenu;
			}
			else 
			{
				trigger_error("Le contenu du comm ne peut pas etre vide",E_USER_WARNING);
				$this->_addable=false;
			}
		}
		
		public function setNote($note){
		
			$note=(int)$note;
				if(($note>=0) &&($note<6))
				$this->_note=$note;
				else{
					trigger_error("0<=note<=5 !!",E_USER_WARNING);
					$this->_addable=false;
				}
		}
}