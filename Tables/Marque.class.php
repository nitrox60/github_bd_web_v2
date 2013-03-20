<?php
class Marque{
	private $_idMarque;
	private $_nomMarque;
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
	
	public function getIdMarque(){ return $this->_idMarque;}
	public function getNomMarque(){ return $this->_nomMarque;}
	public function getAddable(){ return $this->_addable;}
	
	public function setIdMarque($marque){
		$marque=(int)$marque;
		$this->_idMarque=$marque;
	}
	
	public function setNomMarque($marque){ 
	
		if(is_string($marque)){ $this->_nomMarque=$marque;}
		else
		{	
			trigger_error("la marque n'est pas une string",E_USER_WARNING);
			$this->_addable=false;
		}
	}
	
}