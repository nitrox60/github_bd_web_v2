<link rel="stylesheet" href="./styles/admClient.css"/>

<table align="center" valign="middle">
		<tr><th>Id</th><th>Nom</th><th>Prenom</th><th>Rue</th><th>Code Postal</th><th>Ville</th><th>VIP</th><th>Date Inscription</th><th>Mail</th><th>Supprimer</th></tr>
	
{foreach $liste as $c}
	
	<tr id="{$c->getIdClient()}"> <td id="id{$c->getIdClient()}">{$c->getIdClient()}</td> <td>{$c->getNom()}</td><td>{$c->getPrenom()}</td> <td>{$c->getRue()}</td> <td>{$c->getCodePostal()}</td> <td>{$c->getVille()}</td> <td>{$c->getVip()}</td><td>{$c->getDateInscription()}</td> <td>{$c->getMail()}</td><td><a href="?module=admClient&action=delete&id={$c->getIdClient()}" class="suppr"><img src="./images/delete.png"/></a></td></tr>
{/foreach}
</table>
<div style="clear:both;"></div>