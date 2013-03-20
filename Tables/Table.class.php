<?php
class Table {
	static  $db;
	
	public function __construct(){
		$this->db=DB::get_instance();
	}

	public function __sleep(){
		unset($this->db);
		return array_keys( (array)$this );	
	}				
}
?>