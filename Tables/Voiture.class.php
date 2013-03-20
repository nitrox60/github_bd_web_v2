<?php

	class Voiture{
	
		private $_idVoiture;
		private $_annee;
		private $_km;
		private $_description;
		private $_idModele;
		private $_addadable;
		
		public function __construct(array $donnees)
		{ 
			$this->_addable=true;
			$this->hydrate($donnees);
			
		}

		public function hydrate(array $donnees) {
		
			foreach ($donnees as $key => $value)
			{
				$method = 'set'.ucfirst($key);
				if (method_exists($this, $method))
				{
					$this->$method($value);
				}
			}
		}
		
		public function getIdVoiture(){ return $this->_idVoiture;}
		public function getAnnee(){ return $this->_annee;}
		public function getKm(){ return $this->_km;}
		public function getDescription(){ return $this->_description;}
		public function getIdModele(){ return $this->_idModele;}
		public function getAddable(){ return $this->_addable;}
	
		public function setIdVoiture($voiture){
			$voiture=(int)$voiture;
			$this->_idVoiture=$voiture;
		}
		
		public function setAnnee($annee){
			$reg='/^[1-2]{1}+[0-9]{3}$/';
			if(preg_match($reg,$annee)){ $this->_annee=$annee;}
			else {
				trigger_error("L'année ne convient pas au format (2XXX ou 1XXX)",E_USER_WARNING);
				$this->_addable=false;
			}
		}
		public function setKm($km){
			
			if(($km>=0) && ($km< 1000000)){ $this->_km=$km;}
			else {
				trigger_error(" 0<=km<=1 000 000",E_USER_WARNING);
				$this->_addable=false;
				}
			
		}
		
		
		public function setDescription($description){
		
			if(is_string($description)){ $this->_description=$description;}
			else {
				trigger_error("la description n'est pas une string",E_USER_WARNING);
				$this->_addable=false;
				}
		}

		public function setIdModele($idModele){
			
			if($idModele!=null){ $this->_idModele=$idModele;}
			else {
					trigger_error("la cle etrangere idModele ne peut pas etre null",E_USER_WARNING);
					$this->_addable=false;
				}
		}
	
	}