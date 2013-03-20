<?php

	class Verif{
		private $_idClient;
		private $_idVerif;
		private $_codeVerif;
		
		
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
		
		public function getIdVerif(){return $this->_idVerif;}
		public function getIdClient(){return $this->_idClient;}
		public function getCodeVerif(){ return $this->_codeVerif;}
		
		public function setIdVerif($v){
			$this->_idVerif=$v;
		}
		public function setIdClient($client){
			$client=(int)$client;
			$this->_idClient=$client;
		}
		public function setCodeVerif($cv){
			
			$this->_codeVerif=$cv;
		}
		
}
		