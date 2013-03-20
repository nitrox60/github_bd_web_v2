$(function(){
	var fadeInTime=2000 //Temps d'apparation des formulaire en ms.
	
	// --- Changement dynamique du mail --- //
	$("#change_mail").click(function(){
		var mail=$("#email").html();
		$("#scrollbox").html('').hide();
		$("#scrollbox").html('<form id="scrollbox_f" enctype="text/plain" action="#mail"><span style="margin-top:10%"><label for"newmail">Mail</label><input name="newmail"  id="newmail" type="text" value="'+mail+'"/><label for="sub">&nbsp</label><input name="sub" id="sub" type="submit" value="Valider"/></span></form>').fadeIn(fadeInTime);
	});

	// --- Changement dynamique des coordonnés --- //
	$("#change_adr").click(function(){
		var rue=$("#rue").html();
		var ville=$("#ville").html();
		var cp=$("#cp").html();
		$("#scrollbox").html('').hide();
		$("#scrollbox").html('<form id="scrollbox_f" enctype="text/plain" action="#adr"><span><label for"newrue">Rue</label><input name="newrue"  id="newrue" type="text" value="'+rue+'"/><label for"newville">Ville</label><input name="newville"  id="newville" type="text" value="'+ville+'"/><label for"newcp">Code Postal</label><input name="newcp"  id="newcp" type="text" value="'+cp+'"/><label for="sub">&nbsp</label><input name="sub" id="sub" type="submit" value="Valider"/></span></form>').fadeIn(fadeInTime);
	});
	
	// --- Changement dynamique du mdp --- //
	$("#change_mdp").click(function(){
		$("#scrollbox").html('').hide();
		$("#scrollbox").html('<form id="scrollbox_f" enctype="text/plain" action="#mdp"><span><label for"oldmdp">Mot de passe actuel</label><input name="oldmdp" type="password" id="oldmdp" /><label for"newmdp">Nouveau mot de passe</label><input name="newmdp"  type="password" id="newmdp"/><label for"newmdpconf">Retapez le nouveau mot de passe</label><input name="newmdpconf" type="password"  id="newmdpconf"/><label for="sub">&nbsp</label><input name="sub" id="sub" type="submit" value="Valider"/></span></form>').fadeIn(fadeInTime);
	});
	//Variable qui passe a true quand les spans d'erreur sont en place.
	var err=false;
	var errRue=false;
	var errCp=false;
	var errVille=false;
	var errOldMdp=false;
	var errNewMdp=false;
	var errNewMdpConf=false;
	
	
	$(document).delegate('#scrollbox_f','submit',function(){
		var action=$(this).attr("action").split('#')[1];//Récupère l'action voulu: changez le mail OU l'adresse OU le mdp
		
		if(action=="mail")
		{
			var newmail=$("#newmail").val();
			var oldmail=$("#email").html();
			$.ajax({type:'GET',
					dataType: 'json',
					url: '?module=clientmanage&action=valmailajax&mail='+newmail,
					success: function(data,txtStatus, jqXHR){
						if(data==true)
						{
							
							$("#email").html(newmail);
							$("#ifLog").replaceWith("<span id='ifLog' >Connecté : "+newmail+"<a href='?module=login&action=deconnect'>Logout</a></span>");
							$("#scrollbox").html("<div id='validation'>Changement du mail éffectué</div>");
						}
						else if(data=="invalide")
						{
							if(err==false){
							$("#newmail").after("<span id='err_mail'></span>");
							err=true;
							}
							$("#err_mail").html("Ce mail existe déjà.")
						}
						else
						{
							
							if(err==false){
							$("#newmail").after("<span id='err_mail'></span>");
							err=true;
							}
							$("#err_mail").html("Format invalide.")
							
						}
					}
			
			});
		}
		else if(action=="adr")
		{
			var newrue=$("#newrue").val();
			var newville=$("#newville").val();
			var newcp=$("#newcp").val();
			
			if( (newrue=="") || (newville=="") || (newcp==""))
			{
				alert("Veuillez remplir tous les champs, si vous ne voulez pas tous les changez laissez les champs pré-remplis.");
			}
			else
			{
				$("#sub").attr("value","Chargement...").css("color","grey");
				$.ajax({type:'GET',
						dataType: 'json',
						url: '?module=clientmanage&action=valadrajax&rue='+newrue+'&ville='+newville+'&cp='+newcp,
						success: function(data,txtStatus, jqXHR){
							
							if(data['ok']==false)
							{
								$("#scrollbox").css("width","70%");
								if(data['rue']!="")
								{
									
									if(errRue==false){
									$("#newrue").after("<span id='err_rue'></span>");
									errRue=true;
									}
									$("#err_rue").html(data['rue'])
								}
								
								if(data['ville']!="")
								{
									if(errVille==false){
									$("#newville").after("<span id='err_ville'></span>");
									errVille=true;
									}
									$("#err_ville").html(data['ville'])
								}
								
								if(data['cp']!="")
								{
									
									if(errCp==false){
									$("#newcp").after("<span id='err_cp'></span>");
									errCp=true;
									}
									$("#err_cp").html(data['cp'])
								}
							}
							else if(data['ok']==true)
							{
								$("#rue").html(newrue);
								$("#ville").html(newville);
								$("#cp").html(newcp);
								$("#scrollbox").html("<div id='validation'>Changement des coordonnées éffectué</div>");

							}
							$("#sub").attr("value","Valider").css("color","black");
						}
					
				});
			}
		}
		else if(action=="mdp")
		{
			var oldmdp=$("#oldmdp").val();
			var newmdp=$("#newmdp").val();
			var newmdpconf=$("#newmdpconf").val();
			
			if(newmdp!=newmdpconf)alert("La confirmation du mot de passe ne correspond pas au nouveau mot de passe.");
			else
			{
				if( (oldmdp=="")  || (newmdp=="") || (newmdpconf==""))
				{
					alert("Veuillez remplir tous les champs du formulaire.");
				}
				else
				{
					$.ajax({type:'POST',
						dataType: 'json',
						url: '?',
						data: 'module=clientmanage&action=valmdpajax&oldmdp='+oldmdp+'&newmdp='+newmdp+'&newmdpconf='+newmdpconf,
						success: function(data,txtStatus, jqXHR){
							if(data['ok']==false)
							{
								$("#scrollbox").css("width","70%");
								if(data['oldmdp']!="")
								{
									
									if(errOldMdp==false){
									$("#oldmdp").after("<span id='err_oldmdp'></span>");
									errOldMdp=true;
									}
									$("#err_oldmdp").html(data['oldmdp']);
								}
								
								if(data['mdpconf']!="")
								{
									if(errNewMdpConf==false){
									$("#newmdpconf").after("<span id='err_newmdpconf'></span>");
									errNewMdpConf=true;
									}
									$("#err_newmdpconf").html(data['mdpconf'])
								}
								
								if(data['newmdp']!="")
								{
									
									if(errNewMdp==false){
									$("#newmdp").after("<span id='err_newmdp'></span>");
									errNewMdp=true;
									}
									$("#err_newmdp").html(data['newmdp'])
								}
							}
							else if(data['ok']==true)
							{
								
								$("#scrollbox").html("<div id='validation'>Changement du mot de passe éffectué</div>");

							}
							$("#sub").attr("value","Valider").css("color","black");
						
						}
			
					});
				}
			}
		}
		return false;
	});
});