<?php 
	class Location{
	
		private $_idLoc;
		private $_dateLoc;
		private $_dateRendu;
		private $_prixLoc;
		private $_idVoiture;
		private $_idClient;
		private $_addable;
		
		public function __construct(array $donnees)
		{ 
			$this->_addable=true;
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
		public function getIdLoc(){ return $this->_idLoc;}
		public function getDateLoc(){ return $this->_dateLoc;}
		public function getDateRendu(){ return $this->_dateRendu;}
		public function getPrixLoc(){ return $this->_prixLoc;}
		public function getIdVoiture(){ return $this->_idVoiture;}
		public function getIdClient(){ return $this->_idClient;}
		public function getAddable(){ return $this->_addable;}
		
		
		public function setIdLoc($location){
			$location=(int)$location;
			$this->_idLoc=$location;
		}
		
		public function setDateLoc($dateLoc){ 
		
			if(is_string($dateLoc)){ $this->_dateLoc=$dateLoc;}
			else {
				trigger_error("Date Loc n'est pas une string",E_USER_WARNING);
				$this->_addable=false;
				}
		}
		
		public function setDateRendu($dateRendu){ 		
		
			if(is_string($dateRendu)){ $this->_dateRendu=$dateRendu;}
			else 
			{
				trigger_error("Date rendu n'est pas une string",E_USER_WARNING);
				$this->_addable=false;
			}
		}
		
		public function setPrixLoc($prixLoc){
		
			 $this->_prixLoc=$prixLoc;
			
		}
			
		public function setIdVoiture($idVoiture){
			if($idVoiture!=null)
			{
				$idVoiture=(int)$idVoiture;
				 $this->_idVoiture=$idVoiture;
			}
			else
			{
				trigger_error("La CS idVoiture ne peut pas etre null",E_USER_WARNING);
				$this->_addable=false;
			}
			
		}
		
		public function setIdClient($idClient){ 
			if($idClient!=null){
				$idClient=(int)$idClient;
				$this->_idClient=$idClient;
			
			}
			else
			{
				trigger_error("la CS idClient ne peut pas etre null",E_USER_WARNING);
				$this->_addable=false;
			}
		}	
	}