<style>
#change_mail, #change_adr, #change_mdp
{
	background-color:#A5AA95;
	border: 1px solid white;
	border-radius:10px;
	width: 25%;
	height:7%;
	text-align:center;
	cursor:pointer;
	padding-top:2%;
	float:left; clear:right;
	margin-left:5%;
}

.hidden
{
	display:none;
}

#scrollbox
{
	border:1px solid white;
	border-radius:10px;
	height:30%;
	width:60%;
	position:relative;
	margin-top:10%;
	margin-left:21%;
	padding-top:2%;
	
	display:none;
}

#validation
{
	font-size:2em;
	margin-top:10%;
	margin-left:2%;
}

#err_mail, #err_ville, #err_cp, #err_rue, #err_oldmdp, #err_newmdp, #err_newmdpconf
{
	font-size:12px;
	color:black;
	margin-top:2%;
	border:1px solid white;
	border-radius:10px;
	background-color:#FF0004;
	padding-right:4px;
	padding-left:4px;
	padding-top:2px;
	padding-bottom:2px;
	
}
</style>

<div id="email" class="hidden">{$user->getMail()}</div>
<div id="rue" class="hidden">{$user->getRue()}</div>
<div id="ville" class="hidden">{$user->getVille()}</div>
<div id="cp" class="hidden">{$user->getCodePostal()}</div>


<div id="change_mail">Changer votre mail</div>
<div id="change_adr">Changer votre adresse</div>
<div id="change_mdp">Changer votre mot de passe</div>

<div id="scrollbox"></div>

<div style="clear:both"></div>
<script src="./js/jquery-1.4.3.min.js"></script>
<script src="./js/clientmanage-index.js"></script>