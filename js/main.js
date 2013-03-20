$(function(){
/*
	var URL=document.location.search.split('?')[1].split('=')[1].split('&')[0];
	if((URL!='loc')||(URL!='loc#'))
	{
		if($('a.poplight').text()=='Connexion')
		{
			$('a.poplight').hide();
		}
	}
	*/
	
	var who=$("#ifLog").html().split('<')[0].split(':')[1];
	
	if(who!="admin")
	{
		$("#menu>a[href=?module=admSpace]").hide();
		if(who!=undefined)$("#menu>a.nodisp").show();
	}
	$(document).delegate('input.co_pop[type=submit]','click',function(){
			var MINLENGTH_NDC=4;
			var MINLENGTH_MDP=8;
			if( ( $("#ndc_pop").val().length >= MINLENGTH_NDC) && ( $("#mdp_pop").val().length >= MINLENGTH_MDP))
				$.ajax({	type: 'GET',
					url: '?module=login&action=coajax&log='+$("#ndc_pop").val()+'&mdp='+$("#mdp_pop").val(),
					dataType: 'json',
					success: function(data,txtStatus, jqXHR){
						if(data['bool']==true)
						{
							$("#ifLog").html("Connecté : "+data['who']+"<a href='?module=login&action=deconnect'>Logout</a>");
							$("#menu>a.nodisp").show();
							$('a.close, #fade').trigger('click');
						}
						else if(data['bool']==false) $("#error_pop").html("Email ou Mot de passe incorrecte!");
					}
					});
			else
				$("#error_pop").html("Email ou Mot de passe incorrecte!");
			
		});
				
				//Lorsque vous cliquez sur un lien de la classe poplight et que le href commence par #
		$(document).delegate('a.poplight[href^=#]','click',function() {
			//var popID = $(this).attr('rel'); //Trouver la pop-up correspondante
			var popID ="popup_name"; //Trouver la pop-up correspondante
			/*var popURL = $(this).attr('href'); //Retrouver la largeur dans le href

			//Récupérer les variables depuis le lien
			var query= popURL.split('?');
			var dim= query[1].split('&amp;');
			var popWidth = dim[0].split('=')[1]; //La première valeur du lien
			*/
				
			var popWidth=800;
			//Faire apparaitre la pop-up et ajouter le bouton de fermeture
			$('#' + popID).fadeIn().css({
				'width': Number(popWidth)
			})
			.prepend('<a href="#" class="close"><img src="./images/close_pop.png" class="btn_close" title="Fermer" alt="Fermer" /></a>');

			//Récupération du margin, qui permettra de centrer la fenêtre - on ajuste de 80px en conformité avec le CSS
			var popMargTop = ($('#' + popID).height() + 80) / 2;
			var popMargLeft = ($('#' + popID).width() + 80) / 2;

			//On affecte le margin
			$('#' + popID).css({
				'margin-top' : -popMargTop,
				'margin-left' : -popMargLeft
			});

			//Effet fade-in du fond opaque
			$('body').append('<div id="fade"></div>'); //Ajout du fond opaque noir
			//Apparition du fond - .css({'filter' : 'alpha(opacity=80)'}) pour corriger les bogues de IE
			$('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn();

			return false;
		});

		//Fermeture de la pop-up et du fond
		$('a.close, #fade').live('click', function() { //Au clic sur le bouton ou sur le calque...
			$('#fade , .popup_block').fadeOut(function() {
				$('#fade, a.close').remove();  //...ils disparaissent ensemble
			});
			return false;
		});
});