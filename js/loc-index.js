//Jquery page loc-index.tpl
$(function(){
	
	var mq="";
	var ml=4;
	var w=4;
		$("#marque>option").each(function(){
			if($(this).val()!=0)
				mq=mq+"<p class=\"mq_but\"style=\"margin-left:"+ml+"%;  width:auto; display:inline-block;\"><a href=\"#\" >"+ $(this).html()+"</a></p>";
		});
		
		$("#test").html("<div id='testmq'>Marque</div>"+mq);
		
		var marq="";
		$('#test a').click(function(){ //Appelé quand un changement s'éffectue sur la premier liste déroulante
				$(".voiture").each(function(){
				$(this).hide();
				});
				
				$('#load').html('<img class="imgload" src="./images/ajax-loader_loc.gif"/>').show(); //Pendant le chargement
				$("#test a").parent().css("box-shadow"," none");
				$(this).parent().css("box-shadow","1px 1px 1px 1px white ");
				
				marq=$(this)
					$.ajax({
						type: 'GET',
						url: '?module=loc&action=ajax&name='+$(marq).html(),
						
						dataType : 'json',	//Evite de faire $.parseJSON
						success: function(data, txtStatus, jqXHR){
							
							var i=0;
							var txt='';
							
							if(data) 
							{
								for(i=0;i<data.length;i++)
								{
									txt+="<span class='mod_but'><a href=\"#\">"+data[i]+"</a></span>"
								}
								//$('#sel').html("<label for=\"mod\">Modèle</label><select id=\"mod\" name=\"mod\">"+txt+"</select>").show();
								$('#test2').html("<div id='testmq'>Modèle</div>"+txt).show();
								$('#load').html('');
							}
							else
							{	
								$('#test2').html('').hide();
								$('#load').html("Aucune modèle disponible");
								marq.parent().css("background","red");
							}
						}
					});	
				return false;
			});
	
		
		
		$(document).delegate("#test2 a","click",function(){
			$('#load').html('<img class="imgload" src="./images/ajax-loader_loc.gif"/>').show();
			if($('#mod').val()==0) $('#car').html('').hide();
			else
			{	
			
			
			mod=$(this);
				$('#infos').html("<div id='divinfo'><a href='?module=car&action=index&name="+$(mod).html()+"'>Informations sur le modèle "+$(mod).html()+".</a></div>").show
				//Test de connexion a éffectuer ici. via ajax
				$.ajax({
					type: 'GET',
					url: '?module=loc&action=ajaxmod&name='+$(mod).html(),
					dataType: 'json',
					success: function(data,txtStatus, jqXHR){
							
						var i=0;
						var prompt='';
						if(data)
						{
							for(i=0;i<data.length;i++)
							{
								if(data[i]['disp']==true)// a revoir le disp.								
										prompt+="<div class=\"voiture\"><div class='info'> Annee : "+data[i]['annee']+" &nbsp Kilométrage : "+data[i]['km']+" </div><br /><span class='desc'> Description :</span>&nbsp"+data[i]['description']+"<div class='b_loc'><a href='?module=loc&action=rent&id="+data[i]['id']+"' class='rentme'>Louer</a></div></div><br />";
									else if(data[i]['disp']==false) 
										prompt+="<div class=\"voiture\"><div class='info'> Annee : "+data[i]['annee']+" &nbsp Kilométrage : "+data[i]['km']+" </div><br /><span class='desc'> Description :</span>&nbsp"+data[i]['description']+"<div class='b_loc'><a href='?module=loc&action=rent&id="+data[i]['id']+"' class='rentme' >Louer</a></div></div><br />";
							}
									if(prompt=='') prompt="<div class=\"voiture\">Aucune voiture n'est actuellement disponible</div>";
							$('#car').html(prompt).show();
							$('#load').html('');
										
						}
						else $('#car').html('').hide();
					}
				});
			}
		});
		
		
		// sa marche faire un truc qui quand on CLICK sur LOUER apel un ajax qui soit redirige vers loc soit vers connexion comme sa pas besoin de refresh.
		
		//se declenche quand on click sur LOUER
		$(document).delegate('a.rentme','click',function(){
			var res=false;
				//on test de facon synchrone si user est co.
				$.ajax({type: 'GET',
						async: false,
						url: '?module=loc&action=isOK',
						dataType: 'json',						
						success: function(data){
							res=data;
						}
						
				
				});
			
			if(res==false) 
				 $('a.poplight[href^=#]').trigger('click');
			return res;
		
		});
		
		
});
