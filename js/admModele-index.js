$(function(){
	
		$('.suppr').click(function(e){
			return confirm("Etes-vous sur de supprimer "+$('.suppr').val());
		});
		
		
			
			
			$('.mod').each(function(){
				$(this).click(function(){
					
				//$('.ajax').html('je suis mod '+$(this).text()+' et mon id est '+$(this).attr('id')+'<br />').show();
			
				
				
				var idModele=$(this).attr('id');
				$.ajax({
					type: 'GET',
					url: '?module=admVoiture&action=ajax&id='+$(this).attr('id'),
					dataType : 'json',	//Evite de faire $.parseJSON
					success: function(data, txtStatus, jqXHR){
						
						$('.ajax').html('');
							var i=0;
							var prompt="";
							var an=[];
							var km=[];
							var marq=[];
							for(i=0;i<data.length;i++)
							{
								$('.ajax').html($('.ajax').html()+"<br />Année : "+data[i]['annee']+"<br />Kilométrage :"+data[i]['km']+"<br />Description :"+data[i]['description']+"<br /><div class=\"sup_car button\" id="+i+"><a href=\"?module=admVoiture&action=delete&idModele="+idModele+"&idVoiture="+data[i]['idVoiture']+"\" >Supprimer</a></div>").show();
								//prompt+="<br /> Année : "+data[i]['annee']+"<br />Kilométrage :"+data[i]['km']+"<br />Description :"+data[i]['description']+"<br /><div class=\"sup_car\">Supprimer</div>";
							//On stock les informations concernant l'objet en cour d'affichage
								marq[i]=$('#mq').text();
								an[i]=data[i]['annee'];
								km[i]=data[i]['km'];
								
							}
							//On assigne une fonction évenementielle a chaque élement qui ont la classe .sup_car pour demander une confirmation avant la confirmation.
							$('.sup_car').click(function(){
								
									var j=$(this).attr('id');
									return confirm("Etes vous sur d'éffectuer la suppression de la "+marq[j]+" de "+an[j]+" avec " +km[j]+" km ?");
								});
							//$('.ajax').html(prompt).show();
							
					}
					
					
					
				
				});
				
			});
			});
			
			
		/* --- Variable de stockage temporaire --- */
		var quoi;
		var tag;
		var idactuel;
		var modif;
		var obj;
		var flag=false;
		/* --- On associe a chaque élement suceptible dêtre modifié une fonction sur les événement clique et blur. --- */
		$('.upd').dblclick(function(){
			if(!flag)
			{
				flag=true;
				quoi=$(this).html();
				if(!($(this).is(".inp")))
					$(this).html('<input type="text" value="'+quoi+'"/> ').toggleClass("inp");
				obj=$(this);	
				idactuel=$(this).parent().attr("id");
				tag=$(this).attr("tag");
				
				$(".upd input").keyup(function(e){
					if(e.keyCode == 13){
					modif=$(this).val();
					
					/* --- On procéde a l'update via une requete ajax ---- */
					$.getJSON("?module=admModele&action=ajax&id="+idactuel+"&what="+tag+"&mod="+modif,"",function(data){ 
						if(data=="ok") 
						{
							$(obj).html(modif).toggleClass("inp");
						}
						else
						{
							$(obj).html(quoi).toggleClass("inp");
							alert(data);
						}
						flag=false;
						
					});
					}
				});
			}
		
		})		
			
		
	});
	
