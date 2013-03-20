<style>

p{
margin-bottom:8%;
}

#infob{
    color:black;
    text-shadow:0 -1px 0 black; 
padding:2px;    
border-radius: 6px;
	
}
#infob:hover,#infob:focus{
    background:rgba(0,0,0,.4);
    box-shadow:0 1px 0 rgba(255,255,255,.4);
	cursor:help;
}

#infob span{
    position:absolute;  
		margin-top:23px;
    margin-left:-35px;
	  color:#09c;
    background:rgba(0,0,0,.9);
    padding:15px;
    border-radius:3px;
    box-shadow:0 0 2px rgba(0,0,0,.5);
	transform:scale(0) rotate(-12deg);
	transition:all .25s;
	opacity:0;
}

#infob:hover span,#infob:focus span{
	 transform:scale(1) rotate(0); 
    opacity:1;
}

#infob span::before{
content:'';
position:absolute;
top:-6px;
left:10px;
width:0;
height:0;
border-bottom:6px solid rgba(0,0,0,.9);
border-left:6px solid transparent;
border-right:6px solid transparent;
}
</style>
<link rel="stylesheet" href="./styles/admModele-index.css"/>
<div id="mq">{$marque->getNomMarque()}</div>
<p>
<a href="#" id="infob">Informations<span> Cliquez sur le nom du modèle pour voir les voitures et pour acceder a leur suppression.<br />
Double cliquez pour modifier le nom, le prix ou le taux	</span></a>
</p>
<div class="button_add button"><a href="?module=admModele&action=add&op=add&id={$id}">Ajouter</a></div>
<table align="center" valign="middle">
		<tr><th>Id</th><th>Modèle</th><th> Quantité Stock</th><th> Prix par jour</th><th>Taux de remise (%)</th><th>Modifier</th><th>Supprimer</th><th> Ajouter Voiture</th><th> Ajouter Photo</th></tr>
	
{foreach $liste as $c}
	<tr id="{$c->getIdModele()}"> <td id="id{$c->getIdModele()}">{$c->getIdModele()}</td> <td class="mod upd" tag="nomModele" id="{$c->getIdModele()}">{$c->getNomModele()}</td><td>{$c->getQteStock()}</td> <td tag="prix" class="upd">{$c->getPrix()}</td> <td tag="tauxRemise" class="upd">{$c->getTauxRemise()}</td> <td><a href="?module=admModele&action=add&op=update&idmod={$c->getIdModele()}&id={$marque->getIdMarque()}"><img src="./images/update.png"/></a></td> <td><a href="?module=admModele&action=delete&id={$c->getIdModele()}" class="suppr"><img src="./images/delete.png"/></a></td> <td><a href="?module=admVoiture&id={$c->getIdModele()}" ><img src="./images/car_add.png"/></a></td><td><a href="?module=admModele&action=addPhoto&id={$c->getIdModele()}"><img src="./images/photo.jpg"/></a></td></tr>
	<tr class="car"><td>ID Voiture</td><td>année</td><td>km</td></tr>
{/foreach}
</table>

<div class="ajax"></div>
<div style="clear:both;"></div>
<script src="./js/jquery-1.4.3.min.js"></script>
<script src="./js/admModele-index.js"></script>

	