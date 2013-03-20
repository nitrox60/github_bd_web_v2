<?php
class Admin{
	private $_idAdm;
	private $_mdpAdm;
	
	public function __construct(array $donnes)
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
	
	public function getIdAdm(){ return $this->_idAdm;}
	public function getMdpAdm(){ return $this->_mdpAdm;}
	
	public function setIdAdm($id){$this->_idAdm=$id;}
	public function setMdpAdm($mdp){$this->_mdpAdm=md5($mdp) ;}
	
	
}
	