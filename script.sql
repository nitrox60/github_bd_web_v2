create database basec5;
create table client(
	idClient int(3) primary key AUTO_INCREMENT, 
	nom varchar(20),
	prenom varchar(20),
	rue varchar(50),
	codePostal varchar(6),
	ville varchar(30),
	vip boolean,
	dateInscription date,
	mail varchar(50),
	mdp varchar(50),
	validate boolean
	)engine=innodb;
	
create table marque(
	idMarque int(3) primary key AUTO_INCREMENT,
	nomMarque varchar(20)
	)engine=innodb;

create table modele(
	idModele int(3) primary key AUTO_INCREMENT,
	nomModele varchar(20),
	idMarque int(3),
	qteStock int(2),
	prix float(7,2),
	tauxRemise float(4,2),
	constraint csm FOREIGN KEY (idMarque) references marque(idMarque)
	)engine=innodb;
	
create table voiture(
	idVoiture int(3) primary key AUTO_INCREMENT,
	annee year,
	km int(6),
	description text,
	idModele int(3),
	constraint csv FOREIGN KEY (idModele) references modele(idModele)
	)engine=innodb;
	
CREATE TABLE commentaire(
  	idCom int(5) primary key AUTO_INCREMENT,
  	dateCom datetime ,
  	contenu text ,
  	note int(1),
  	idModele int(3),
  	idClient int(3),
  	constraint csc1 FOREIGN KEY (idModele) references modele(idModele),
  	constraint csc2 FOREIGN KEY (idClient) references client(idClient)
	)engine=innodb;

create table location(
	idLoc int(5) primary key AUTO_INCREMENT,
	dateLoc datetime,
	dateRendu datetime,
	prixLoc float(7,2),
	idVoiture int(3),
    idClient int(3),
    constraint csl1 FOREIGN KEY (idVoiture) references voiture(idVoiture),
    constraint csl2 FOREIGN KEY (idClient) references client(idClient)
	)engine=innodb;

create table image(
	idImage varchar(13) primary key,
	idModele int(3),
	constraint csci FOREIGN KEY (idModele) references modele(idModele)
	)engine=innodb;
	
create table admin(
	idAdm int(3) auto increment,
	mdpAdm varchar(33)
	)engine=innodb;
	
create table verif(
	idVerif varchar(13) primary key,
	codeVerif varchar(33),
	idClient int(3),
	constraint csci FOREIGN KEY (idClient) references client(idClient)
	)engine=innodb;
	
	

INSERT INTO admin VALUES('','21232f297a57a5a743894a0e4a801fc3');