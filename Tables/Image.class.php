<?php

	class Image{
	
		private $_idImage;
		private $_idModele;
		private $_addable;
		
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
		
		public function getIdImage(){ return $this->_idImage;}
		public function getIdModele(){ return $this->_idModele;}
		public function getAddable(){ return $this->_addable;}
		
		public function setIdModele($modele){
			$modele=(int)$modele;
			$this->_idModele=$modele;
		}
		
		public function setIdImage($image){
			$this->_idImage=$image;
		}
	}
?>