<link rel="stylesheet" href="./styles/admMarque-index.css"/>
<a href="?module=admMarque&action=add"><img src="./images/boutton.jpg"/></a>

<table>
<tr><th>Id</th><th>Marque</th><th>Modifier</th><th>Supprimer</th></tr>
	{foreach $liste as $c}
		<tr><td>{$c->getIdMarque()}</td><td><a href="?module=admModele&action=index&id={$c->getIdMarque()}">{$c->getNomMarque()}</a></td><td><a href="?module=admMarque&action=add&id={$c->getIdMarque()}"><img src="./images/update.png" alt="buttonUpdate"/></a></td><td><a href="?module=admMarque&action=delete&id={$c->getIdMarque()}" class="suppr" onclick="return confirm('Etes-vous sur de vouloir supprimer cette marque?')"><img src="./images/delete.png" alt="buttonUpdate"/></a></td></tr>
	{/foreach}
<table>
{foreach $liste as $c}
<div class="box">
	<div class="infomarque">
		<a href="#">{$c->getNomMarque()}</a>
		

	</div>
	<div class="adm hidden info"><a href="?module=admModele&action=index&id={$c->getIdMarque()}">Administrer la marque {$c->getNomMarque()}</a></div>
		<div class="upd hidden info"><a href="?module=admMarque&action=add&id={$c->getIdMarque()}"><img src="./images/update.png" alt="buttonUpdate"/></a></div>
		<div class="suppr hidden info"><a href="?module=admMarque&action=delete&id={$c->getIdMarque()}" class="suppr" onclick="return confirm('Etes-vous sur de vouloir supprimer cette marque?')"><img src="./images/delete.png" alt="buttonUpdate"/></a></div>
</div>
		
		{/foreach}


<div style="clear:both;"></div>
<script src="./js/jquery-1.4.3.min.js"></script>
 <script src="./js/admMarque-index.js"></script>


