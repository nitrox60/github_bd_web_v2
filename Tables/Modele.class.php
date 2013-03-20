<?php
	class Modele{
	
		private $_idModele;
		private $_nomModele;
		private $_IdMarque;
		private $_addable;
		private $_qteStock;
		private $_prix;
		private $_tauxRemise;
		
		public function __construct(array $donnees)
		{
				$this->_addable=true;
			
			$this->hydrate($donnees);
		
		}
		// hydrate appel chaque setters  de la classe pour attribuer les valeurs aux attributs de la classes
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
		
		public function getIdModele(){ return $this->_idModele;}
		public function getNomModele(){ return $this->_nomModele;}
		public function getIdMarque(){ return $this->_idMarque;}
		public function getAddable(){ return $this->_addable;}
		public function getQteStock(){ return $this->_qteStock;}
		public function getPrix(){ return $this->_prix;}
		public function getTauxRemise() { return $this->_tauxRemise;}

		public function setIdModele($modele){
			$modele=(int)$modele;
			$this->_idModele=$modele;
		}
	
		public function setNomModele($nomModele){

			if(is_string($nomModele)){ $this->_nomModele=$nomModele;}
			else 
			{
				trigger_error("Le nom modele n'est pas une string",E_USER_WARNING);	
				$this->_addable=false;
			}
		}
		
		public function setIdMarque($idMarque){ 
		
			if($idMarque!=null)$this->_idMarque=$idMarque;
			else
			{
				trigger_error("La cs idMarque ne peut pas etre null",E_USER_WARNING);
				$this->_addable=false;
			}
		}
		
		public function setQteStock($qteStock){
			// $qteStock=(int)$qteStock;
			$this->_qteStock=$qteStock;
		}
		
		public function setPrix($prix){
			
			$this->_prix=$prix;
		}
		
		public function setTauxRemise($tx){
			
			$this->_tauxRemise=$tx;
		}
	}