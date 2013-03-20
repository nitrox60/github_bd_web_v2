$(function(){

	/** ----- Vérification Jquery de chaque champs du formulaire (Après un blur) -----**/
	var nom=false;
	$("#nom").blur(function(){
	
		if($(this).val().length>=20) 
		{
			if(!nom)
			{
				$(this).after("<span class=\"error\"> Le nom doit être inférieur à 20 caractères</span>");
				nom=true;
			}
	
		}
		else if  ($(this).val().length==0)
		{
			if(!nom)
			{
				$(this).after("<span class=\"error\"> Le Champs nom n'est pas rempli</span>");
				nom=true;
			}
		
		}
		else
		{
			$("#nom+ .error").hide();
			nom=false;
		}
	});
	
	
	var prenom=false;
	
	$("#prenom").blur(function(){
	
		if($(this).val().length>=20)
		{
			if(!prenom)
			{
				$(this).after("<span class=\"error\"> Le nom doit être inférieur à 20 caractères</span>");
				prenom=true;
			}
			
		}
		else if  ($(this).val().length==0)
		{
			if(!prenom)
			{
				$(this).after("<span class=\"error\"> Le Champs prénom n'est pas rempli</span>");
				prenom=true;
			}
		
		}
		else
		{
			$("#prenom + .error").hide();
			prenom=false;
		}
	
	});
	
	var rue=false;
	$("#rue").blur(function(){
	
		
		if($(this).val().length>=50)
		{
			if(!rue)
			{
			
				$(this).after("<span class=\"error\"> La rue doit être inférieur à 50 caractères</span>");
				rue=true;
			}
		}
		else if(!(/^[0-9]{1,4} [a-zA-Z]+/.test($(this).val())))
		{
			if(!rue)
			{
			
				$(this).after("<span class=\"error\"> La rue n'est pas bonne</span>");
				rue=true;
			}
		}
		else 
		{
			$("#rue + .error").hide();
			rue=false;
		}
	});
	
	var cp=false;
	$("#cp").blur(function(){
	
		
		
		if ( (!(/^[0-9]{5}$/.test($(this).val()))) || (/^0{2}[0-9]{3}$/.test($(this).val())))
		{
			if(!cp)
			{
				$(this).after("<span class=\"error\"> Code postal incorrect format XXXXX</span>");
					cp=true;
			}
		}
		else 
		{	
			$("#cp + .error").hide();
			cp=false;
		}
		
	});
	
	var ville=false;
	$("#ville").blur(function(){
	
		
		
		if($(this).val().length>=30)
		{
			if(!ville)
			{
				$(this).after("<span class=\"error\"> La ville doit être inférieur à 30 caractères</span>");
				ville=true;
			}
			
		}
		else if  ($(this).val().length==0)
		{
			if(!ville)
			{
				$(this).after("<span class=\"error\"> Le Champs ville n'est pas rempli</span>");
				ville=true;
			}
		
		}
		else 
		{	
			$("#ville + .error").hide();
			ville=false;
		}
		
	});
	
	var mdp=false;
	$("#mdp").blur(function(){
	
		
		
		if($(this).val().length>=19)
		{
			if(!mdp)
			{
				$(this).after("<span class=\"error\"> La taille du mot de passe doit être inférieur à 18 caractères</span>");
				mdp=true;
			}
			
		}
		else if  ($(this).val().length<8)
		{
			if(!mdp)
			{
				$(this).after("<span class=\"error\"> La taille du mot de passe doit être supérieur a 8 caractères</span>");
				mdp=true;
			}
		
		}		
		else 
		{	
			$("#mdp + .error").hide();
			mdp=false;
		}
		
	});
	
	var mdp2=false;
	$('#mdp2').blur(function(){
		if($(this).val()!=$('#mdp').val())
		{
			if(!mdp2)
			{
				$(this).after("<span class=\"error\"> La confirmation ne correspond pas au mot de passe</span>");
				mdp2=true;
			}
		
		
		}
		else 
		{	
			$("#mdp2 + .error").hide();
			mdp2=false;
		}
	
	
	});
	
	//On vérifie si le mail existe déjà.
	$(function(){
		$('#mail').blur(function(){
			$.ajax({
				type: 'GET',
				url: '?module=inscription&action=ajax&login='+$('#mail').val(),
				
				dataType : 'json',	//Evite de faire $.parseJSON
				success: function(data, txtStatus, jqXHR){
					if(data)
						$('#mail').after("<span class=\"error\">"+data+"</span>");
					else $("#mail+ .error").remove();
				}
			})
		})
	})

	
	

});