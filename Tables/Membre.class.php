<?php
//exemple de table Membre
/*
//structure SQL : 
CREATE TABLE `Membres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(30) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `mail` varchar(40) NOT NULL,
  `pass` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
*/

class Membre extends Table{
	
	
		public $id;
		public $mail;
		public $nom;
		public $prenom;
		public $login;
		//etc.

		
		//fonctions publiques---------------------------------------------------------------		
		public function __construct($login,$nom,$prenom="",$mail="",$pass="",$id=-1){
			//appel du constructeur parent, initialise la référence sur la base de données $this->db
			parent::__construct();
			$this->mail=$mail;
			$this->nom=$nom;
			$this->prenom=$prenom;
			$this->pass=$pass;
			$this->login=$login;
			$this->id=$id;
			return $this;
		}

		function enregistrer(){
			if($this->id==-1)
				$this->id=$this->inserer();			
			else
				$this->modifier();
		}


		public function supprimer(){
			$sql="DELETE FROM Membre WHERE id='{$this->id}'";
			$this->db->exec($sql);
			$this->id=-1;
		}
		
		public static function chercherParId($id){
			$sql="SELECT * from Membres WHERE id=?";
			$res=$this->db->prepare($sql);
			$r=$res->execute(array($id));
			//gérer les erreurs éventuelles

			$m= $r->fetch();			
			return new Membre($m[1],$m[2],$m[3],$m[4],$m[5],$m[0]);			
		}
		public static function chercherParLogin($login){
			$sql="SELECT * from Membres WHERE Login=?";
			$res=DB::get_instance()->prepare($sql);
			$res->execute(array($login));
			//gérer les erreurs éventuelles
			if($res->rowCount()==0){
				echo "pas de ligne";
				return false;
				
			}
			$m= $res->fetch();			
			return new Membre($m[1],$m[2],$m[3],$m[4],$m[5],$m[0]);						
		}
		
		
		
		public function liste(){}   		
		public function listerParStatut(){}
		public function desactiver(){}
		public function activer(){}

		//fonctions privées-----------------------------------------------
		function inserer(){
			//la requête préparée nettoie les champs avant insertion
			$sql="INSERT INTO Membres VALUES('',?,?,?,?,?)";
			$res=$this->db->prepare($sql);
			$res->execute(array($this->login,$this->nom,$this->prenom,$this->mail,$this->pass));			
			return $this->db->lastInsertId();
		}

		function modifier(){
			//même remarque ici
			$sql="UPDATE Membres SET login=?,nom=?,prenom=?,mail=?,pass=? where id=?";
			$res=$this->db->prepare($sql);
			$res->execute(array($this->login,$this->nom,$this->prenom,$this->mail,$this->pass,$this->id));
			
			
		}		

}

?>