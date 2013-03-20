<?php
	if(isset($_POST['attr']))
	{
	
		$tabnotexpl=$_POST['attr'];
		$tab=explode(";",$tabnotexpl);
		foreach($tab as $val){ echo 'private $_'.$val.';<br />';}
		echo 'public function __construct(array $donnees)<br />
	{
			$this->hydrate($donnees);<br />
		
	}<br /><br />
		
	public function hydrate(array $donnees)
	{<br />
		foreach ($donnees as $key => $value)
		{
			$method = \'set\'.ucfirst($key);
			
			if (method_exists($this, $method))
			{
				$this->$method($value);
			}
		}<br />
	}<br />';
		foreach($tab as $val)
		{
			echo "public function get".ucfirst($val).'(){ return $this->_'.$val.
			';}<br />';
		
		}
		
		
		foreach($tab as $val)
		{
			echo "public function set".ucfirst($val).'($'.$val.'){ if(){ $this->_'.$val.
			'=$'.$val.';}}<br />';
		
		}
		
	
	}

?>