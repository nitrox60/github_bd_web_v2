<?php
/**
* OMGL3
* Class HTMLInput : champ de saisie pour formulaire HTML
*
*/
define ("TEXT","text");
define ("TEXTAREA","textarea");
define ("PASSWORD","password");
define ("CHECK","checkbox");
define ("RADIO","radio");
define ("SELECT","select");					
define ("SUBMIT","submit");					
define ("HIDDEN","hidden");	
define ("DATUM","date");				
define ("DATEANDTIME","dateandtime");	
define ("FILE","file");				
define ("CAPTCHA","captcha");				

class HTMLInput{
		
	public $name;
	public $value;
	public $id;
	public $label;
	public $type;
	public $options;
	public $checked=false;
	public $selected="";
	public $required=false;
	public $error=false;
	public $cap="e";
		
	public function __construct($type,$name='',$id='',$label='&nbsp;',$options=array()){
		$this->type=$type;
		$this->name=$name;
		$this->id=$id;
		$this->label=$label;		
		$this->options=$options;
	}
	
	public function check($bool=TRUE){
		$this->checked= $bool;	
		return $this;
	}

	public function set_value($val){
		$this->value=htmlspecialchars($val,ENT_QUOTES);
		return $this;
	}
	
	public function set_captcha($val){
		$this->cap=$val;
		return $this;
	}

	public function set_required($val=true){
		$this->required= $val ? 'required' : '';
		return $this;
	}
	public function set_error($err=true){
		$this->error= $err ? 'error' : '';
		return $this;
	}



	function __toString(){

		$label="<label>{$this->label}</label>";
		$common = "id='{$this->id}' name='{$this->name}' class='{$this->error} {$this->required}'"; 

		
		switch($this->type){
			case TEXT : 
			return "$label<input $common type='text' value='{$this->value}' />" ;	
			
			case CAPTCHA : 
			return "$label<input $common type='text'  /><img style='clear:right;float:left;' id='captcha' src='./images/captcha/{$this->cap}'/>" ;	

			case DATUM : 
			return "$label<input $common type='date' value='{$this->value}' />" ;

			case HIDDEN : 
			return "<input $common type='hidden' value='{$this->value}' />" ;		

			
			case TEXTAREA :
			return "$label<textarea $common>{$this->value}</textarea>" ;
			
			case PASSWORD : 
			return "$label<input $common type='password' value='{$this->value}' />" ;
			
			case CHECK : 
			return "$label<input type='checkbox' "
					.($this->checked?"checked='checked'":'')
					." value='{$this->value}' $common' />" ; 
					
			case RADIO : return "$label<input type='radio' "
					.($this->checked?"checked='checked'":'')
					." value='{$this->value}' $common' />"
					."<span>{$this->value}</span>" ; 
					
			case DATEANDTIME:
			// ---- DATEANDTIME crée un champs qui lorsque l'on clique dessus ouvre un calendrier (datepicker en jq) et deux select pour choisir l'heure et les minutes
				$r="$label<input $common  type='text' value='{$this->value}' />" ;
				$e=" <label for='h' >Heure</label><select id='{$this->id}h' name='{$this->name}h'>";
				$i=0;
				$h="";
				$m="";
					for($i=8;$i<19;$i++){
						
							if($i<10) {$a='0'.$i;$h.="<option value=\"$a\">$a</option>";}
							else $h.="<option value=\"$i\">$i</option>";
						
					}
				$p="</select> <label for='m'>Minute</label><select id='{$this->id}m' name='{$this->name}m'>";
					for($j=0;$j<60;$j+=5){
						if($j<10){ $b='0'.$j; $m.="<option value=\"$b\">$b</option>";}
						else	$m.="<option value=\"$j\">$j</option>";
					}
				$s="</select>";
				return  $r.$e.$h.$p.$m.$s;
				
			case FILE : 
			return "$label<input type='file' $common value='{$this->value}' />" ;
			
			case SELECT : $s="$label<select $common>";
				foreach($this->options as $k=>$v)
					$s.='<option value="'.$k.'" '.($k===$this->value || $v===$this->value ? "selected='selected'":'').">$v</option>";
				$s.="</select>";
				return $s;
					
			
			break;
			case SUBMIT : 
			return "$label<input type='submit' value='{$this->value}' $common />" ; 
			
			default: return "[CHAMP INCONNU]";			
			
			
		}
		return "[CHAMP INCONNU]";
	}
}
?>