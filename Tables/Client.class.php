<?php

	class Client{
		private $_idClient;
		private $_nom;
		private $_prenom;
		private $_rue;
		private $_codePostal;
		private $_ville;
		private $_vip;
		private $_dateInscription;
		private $_mail;
		private $_mdp;//mdp crypter md5
		private $_validate;//Si le compte est validé ou non.
		private $_addable;
		
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
		
		public function getIdClient(){return $this->_idClient;}
		public function getNom(){ return $this->_nom;}
		public function getPrenom(){ return $this->_prenom;}
		public function getRue(){ return $this->_rue;}
		public function getCodePostal(){ return $this->_codePostal;}
		public function getVille(){ return $this->_ville;}
		public function getVip(){ return $this->_vip;}
		public function getDateInscription(){ return $this->_dateInscription;}
		public function getMail(){ return $this->_mail;}
		public function getMdp(){ return $this->_mdp;}
		public function getValidate(){ return $this->_validate;}
		public function getAddable(){ return $this->_addable;}
		
		
		public function setIdClient($client){
			$client=(int)$client;
			$this->_idClient=$client;
		}
		
		public function setNom($nom){ 
		
			if(is_string($nom)){ $this->_nom=$nom;}
			else{
				trigger_error("Le nom n'est pas une string",E_USER_WARNING);
				$this->_addable=false;
			}
		}
		
		public function setPrenom($prenom){ 
		
			if(is_string($prenom)){ $this->_prenom=$prenom;}
			else{
				trigger_error("Le prenom n'est pas une string",E_USER_WARNING);
				$this->_addable=false;
			}
		}
		
		public function setRue($rue){ 
			if(is_string($rue)){ $this->_rue=$rue;}
			else{
				trigger_error("La rue n'est pas une string",E_USER_WARNING);
				$this->_addable=false;
			}
		}
		
		
		public function setCodePostal($codePostal){
			$taille=strlen($codePostal);
			if($taille==5){ $this->_codePostal=$codePostal;}
			else{
				trigger_error("Le code postal ne convient pas ( format: XXXXX)",E_USER_WARNING);
				$this->_addable=false;
			}
		}
		
		
		public function setVille($ville){ 
			
			if(is_string($ville)){ $this->_ville=$ville;}
			else{
				trigger_error("La ville n'est pas une string",E_USER_WARNING);
				$this->_addable=false;
			}
		}
		
		public function setVip($vip){ 
			$vip=(int)$vip;
			
			if($vip==0 OR $vip==1){ $this->_vip=$vip;}
			else{
				trigger_error("VIP=0 ou 1",E_USER_WARNING);
				$this->_addable=false;
			}
		}
		
		public function setDateInscription($dateInscription){ 
		
			if(is_string($dateInscription)){ $this->_dateInscription=$dateInscription;}
			else{
				trigger_error("la date n'est pas une string",E_USER_WARNING);
				$this->_addable=false;
			}	
		}
		
		public function setMail($mail){
		
			if(filter_var($mail, FILTER_VALIDATE_EMAIL)){ $this->_mail=$mail;}
			else{
				trigger_error("mail non valide",E_USER_WARNING);
				$this->_addable=false;
			}
		}
		public function setMdp($mdp){ 
			if(is_string($mdp)){ $this->_mdp=md5($mdp);}
			else{
				trigger_error("le mdp n'est pas une string",E_USER_WARNING);
				$this->_addable=false;
			}
		}
		
		public function setValidate($val)
		{
			if( ($val==0) || ($val==1))
			{
				$this->_validate=$val;
			}
		}
	}