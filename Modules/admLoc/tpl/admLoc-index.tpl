

<style>
.loc
{
	background-color:white;
	border: 2px solid black;
	border-radius:10px ;
	width:50%;
	height:200px;
	margin-left:25%;
	margin-right:25%;
	margin-bottom:20px;
}

.header_loc
{	
	border-bottom:1px solid black;
	width:100%;
	height:30%;
}

.header_loc>span
{
	float:left;
	clear:both;
}

.gras
{
 text-decoration:underline;
 font-weight:bold;
}

.body_loc
{
	width:100%;
	height:70%;
}
.id_car
{
	margin-left:33%;
	display:inline-block;
	width:100%;
	margin-top:10px;
	margin-bottom:10px;
}

.nom_car
{	
	clear:both;	
	float:left;
}

.mod_car, .year_car
{
	float:left;
	clear:both;
}

.statut
{
	height:50px;
	width:50px;
	float:right;
}

.head
{
	position:absolute;
	margin-right:1px;
	margin-left:33%;
} 

.min>img
{
	height:15px;
	margin-right:3px;
} 

.close>img
{
	height:15px;
} 

.min>img, .close>img
{
	cursor:pointer;
}

</style>
		
	
{foreach $liste as $c}
	
<div class="loc"> <div class="head"><span class="min"><img src="./images/min.png"/></span><span class="close"><img src="./images/close.png"/></span></div>
	<div class="header_loc"> <span class="idloc"><span class="gras">Id Location</span>:<span class="idlocforajax">{$c->getIdLoc()}</span> </span><span class="date_start"><span class="gras">Date du début de location</span>: {$c->getDateLoc()}</span> <span class="date_stop"> <span class="gras">Date de fin de location </span>: {$c->getDateRendu()}</span>{if isset($c->stat)}<img class="statut" src="./images/{$c->stat}.jpg"/>{/if}

	</div>
	<div class="body_loc"><span class="id_car">Id de la voiture : {$c->getIdVoiture()}</span><span class="nom_car"> Marque de la voiture: {$c->marque->getNomMarque()}</span> <span class="mod_car">Modèle :{$c->mod->getNomModele()}</span> <span class="year_car">Année:{$c->car->getAnnee()} </span>
	</div>
	
</div>
{/foreach}

<div style="clear:both;"></div>
<script src="./js/jquery-1.4.3.min.js"></script>
<script src="./js/admLoc-index.js"></script>