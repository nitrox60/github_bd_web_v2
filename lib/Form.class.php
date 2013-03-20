<?php
/**
* OMGL3
* Class Form : Formulaire HTML
* Gère les champs, le pré-remplissage, la génération HTML
*/
class Form{

	protected $fields;
	protected $action='?';
	protected $method='POST';
	protected $enc=null;

	
	public function __construct($action,$id){
		$this->id=$id;
		$this->action=$action;
	} 

	function add_select($name,$id,$label='&nbsp;',$options=array()){
		$s =  new HTMLInput(SELECT,$name,$id,$label,$options);
		$this->fields[][$name]=$s;
		return $s;		
	}
	
	

	function add_text($name,$id,$label='&nbsp;'){
		$s =  new HTMLInput(TEXT,$name,$id,$label);
		$this->fields[][$name]=$s;
		return $s;		
	}
	
	function add_captcha($name,$id,$label='&nbsp;'){
		$s =  new HTMLInput(CAPTCHA,$name,$id,$label);
		$this->fields[][$name]=$s;
		return $s;		
	}
	
	function add_dateAndTime($name,$id,$label='&nbsp;'){
		$s =  new HTMLInput(DATEANDTIME,$name,$id,$label);
		$this->fields[][$name]=$s;
		return $s;		
	}
	
	function add_file($name,$id,$label='&nbsp;'){
		$s =  new HTMLInput(FILE,$name,$id,$label);
		$this->fields[][$name]=$s;
		$this->enc='multipart/form-data';
		return $s;
	}
	
	function add_date($name,$id,$label='&nbsp;'){
		$s =  new HTMLInput(DATUM,$name,$id,$label);
		$this->fields[][$name]=$s;
		return $s;		
	}
	
	function add_textarea($name,$id,$label='&nbsp;'){
		$s =  new HTMLInput(TEXTAREA,$name,$id,$label);
		$this->fields[][$name]=$s;
		return $s;		
	}
	
	function add_hidden($name,$id,$label='&nbsp;'){
		$s =  new HTMLInput(HIDDEN,$name,$id,$label);
		$this->fields[][$name]=$s;
		return $s;		
	}

	function add_password($name,$id,$label='&nbsp;'){
		$s =  new HTMLInput(PASSWORD,$name,$id,$label);
		$this->fields[][$name]=$s;
		return $s;		
	}

	function add_submit($name,$id,$label='&nbsp;'){
		$s =  new HTMLInput(SUBMIT,$name,$id,$label);
		$this->fields[][$name]=$s;
		return $s;		
	}

	function add_checkbox($name,$id,$label='&nbsp;',$checked=FALSE){
		$s =  new HTMLInput(CHECK,$name,$id,$label);
		$s->check($checked);
		$this->fields[][$name]=$s;
		return $s;		
	}

	function add_radio($name,$id,$label='&nbsp;',$checked=FALSE){
		$s =  new HTMLInput(RADIO,$name,$id,$label);
		$s->check($checked);
		$this->fields[][$name]=$s;
		return $s;		
	}


	//remplissage des champs avec les valeurs issues de _REQUEST
	function populate(){
		echo "<h2>populate</h2>";
		print_r($_REQUEST);echo "<br />";

		foreach($this->fields as $k=>$arr){
			$k=key($arr);
			$f=current($arr);

			if(isset($_REQUEST[$k])){
				echo "<li>$k = ".$_REQUEST[$k]."</li>";
				if($f->type==RADIO){
					if($f->value == $_REQUEST[$k])
						$f->check();
					else
						$f->check(false);
				}
				elseif($f->type==CHECK)
						$f->check();
				else{
					$f->set_value( $_REQUEST[$k]  ) ;
				}
			}
			else
				$f->check(FALSE);
				
		}
	}


	//génération HTML du formulaire
	function __toString(){
		if(!$this->enc)
		$s="<form method='{$this->method}' action='{$this->action}' >";
		else
		$s="<form method='{$this->method}' action='{$this->action}' enctype='{$this->enc}'>";
		foreach($this->fields as $k=>$f){
			$s=$s.array_pop($f);
		}
		$s.="</form>";
					
		return $s;
	}
 
}