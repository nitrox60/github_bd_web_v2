$(function(){

$.datepicker.regional['fr'] = {
				closeText: 'Fermer',
				prevText: '&#x3c;Préc',
				nextText: 'Suiv&#x3e;',
				currentText: 'Courant',
				monthNames: ['Janvier','Février','Mars','Avril','Mai','Juin',
				'Juillet','Août','Septembre','Octobre','Novembre','Décembre'],
				monthNamesShort: ['Jan','Fév','Mar','Avr','Mai','Jun',
				'Jul','Aoû','Sep','Oct','Nov','Déc'],
				dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
				dayNamesShort: ['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'],
				dayNamesMin: ['Di','Lu','Ma','Me','Je','Ve','Sa'],
				weekHeader: 'Sm',
				firstDay: 1,
				isRTL: false,
				showMonthAfterYear: false
				};
			$.datepicker.setDefaults($.datepicker.regional['fr']);
			
			var idURL=document.location.search.split('=')[3];//récupère l'idée dans la barre d'url.
					$("#dateloc").datepicker({ dateFormat: "yy-mm-dd" , showAnim: "fold" , minDate: new Date()});
					$("#daterendu").datepicker({ dateFormat: "yy-mm-dd" , showAnim: "fold", minDate: new Date()});		
					
					//On rend les samedi-dimanche rouge et transparent car on ne peux pas louer samedi-dimanche car magasin fermé!
					$('.hasDatepicker').live('focus',function(){
						
					$('td.ui-datepicker-week-end>a').css("background","none").css("border","none");
					$('td.ui-datepicker-week-end>a').hover(function(){$(this).css("cursor","default");});
					
					
					// (0) Début :04-Mars-2013 00:00:00 -- Fin : 10-Avril-2013 00:00:00 .
					var txt_init=$("#infoloc").text();
					var spliter=txt_init.split('.');
					var a=0;
					for(a=0;a<spliter.length;a++)
					{
						txt=spliter[a];
						if(txt!="")
						{
							
							var start=txt.split('--')[0];
							var stop=txt.split('--')[1];
							
							start=start.split(' ')[3].substr(1);// on recupere "dd-Mois-YYYY"
							year_start=start.split('-')[2];
							month_start=start.split('-')[1];
							day_start=start.split('-')[0];
							
							
							
							stop=stop.split(' ')[3];
							year_stop=stop.split('-')[2];
							month_stop=stop.split('-')[1];
							day_stop=stop.split('-')[0];
							
							 colorDay(Number(year_start),month_start,Number(day_start),Number(year_stop),month_stop,Number(day_stop));
							// faire un chargement
						}
					}
					//colorDay(2013,"Mars",4,2013,"Avril",10);
						
					});
					//var obj={Mars: 0, Avril:1};
					//alert(obj.Mars);
					//alert(obj["Mars"]);
					
					/** Function qui permet de coloré un intervalle de temps
					@param yearStart : Année du début d'intervalle
					@param monthStart : Mois du début d'intervalle
					@param numberStart : Numéro du jour du début d'intervalle
					
					@param yearStop : Année de fin d'intervalle
					@param monthStop : Mois de fin d'intervalle
					@param numberStop : Numéro du jour de fin d'intervalle
					
					
					
					**/
					
					function colorDay(yearStart,monthStart,numberStart,yearStop,monthStop,numberStop)
					{
						var COLOR= 'red';
						var find=false;
						// alert(yearStart+monthStart+numberStart+yearStop+monthStop+numberStop);
						//tableau qui contient les mois et leur équivalent numérique pour comparé.
						var month={Janvier:0, Février:1,Mars:2, Avril:3, Mai:4, Juin:5, Juillet:6, Août:7, Septembre: 8, Octobre: 9, Novembre: 10, Décembre:11};
					
						$('tbody').find('a.ui-state-default').each(function(){
							//On distingue 2 cas celui ou tous se passe sur la meme année, et celui ou sa se passe sur 2 année en meme temps. ( le temps max d'une location/personne est de 6 mois).
							if(yearStart==yearStop)
							{
								if(yearStart==$('.ui-datepicker-year').html())
								{
									//On distingue 2 cas, celui ou un doit colorié dans le meme mois et celui ou on est sur plusieur mois
									if(monthStart==monthStop)
									{
										
										if($('.ui-datepicker-month').html()==monthStart)
										{
										//alert($('.ui-datepicker-month').html());
											if( ( ($(this).html()==numberStart) || (find))&& ($(this).html()<=numberStop) )
											{
												
												find=true;
												$(this).css("background","none").css("border","none").parent().css("border","1px solid "+COLOR).toggleClass('ui-datepicker-unselectable').toggleClass('ui-state-disabled') ;
												$(this).hover(function(){$(this).css("cursor","default");});
											}
										}	
									}
									else
									{
										
										if($('.ui-datepicker-month').html()==monthStart)//Si on est au mois de départ on passe findMonth a true pour colorié jusqu'a la fin.
										{
											if( ($(this).html()>=numberStart) && ($(this).html()<=31) )
											{
												
												
												$(this).css("background","none").css("border","none").parent().css("border","1px solid "+COLOR).toggleClass('ui-datepicker-unselectable').toggleClass('ui-state-disabled');
												$(this).hover(function(){$(this).css("cursor","default");});
											}
											
										}
										else if( (month[$('.ui-datepicker-month').html()]>month[monthStart]) && (month[$('.ui-datepicker-month').html()]<month[monthStop]))
										{
											
													
													
													$(this).css("background","none").css("border","none").parent().css("border","1px solid "+COLOR).toggleClass('ui-datepicker-unselectable').toggleClass('ui-state-disabled');
													$(this).hover(function(){$(this).css("cursor","default");});
												
											
										}
										else if($('.ui-datepicker-month').html()==monthStop)
										{
											if($(this).html()<=numberStop) 
											{
												
												
												$(this).css("background","none").css("border","none").parent().css("border","1px solid "+COLOR).toggleClass('ui-datepicker-unselectable').toggleClass('ui-state-disabled');
												$(this).hover(function(){$(this).css("cursor","default");});
											}
										}
										
											
									}
								}
							}
							else
							{
								if( yearStart==$('.ui-datepicker-year').html())
								{
									if($('.ui-datepicker-month').html()==monthStart)
									{
										// findMonth=true;
										if( ($(this).html()>=numberStart) && ($(this).html()<=31) )
										{
											
											
											$(this).css("background","none").css("border","none").parent().css("border","1px solid "+COLOR).toggleClass('ui-datepicker-unselectable').toggleClass('ui-state-disabled');
											$(this).hover(function(){$(this).css("cursor","default");});
										}
										
									}
									else if(month[$('.ui-datepicker-month').html()]>month[monthStart])
									{
										$(this).css("background","none").css("border","none").parent().css("border","1px solid "+COLOR).toggleClass('ui-datepicker-unselectable').toggleClass('ui-state-disabled');
											$(this).hover(function(){$(this).css("cursor","default");});
									}
								}
								else if( ($('.ui-datepicker-year').html()>yearStart) &&($('.ui-datepicker-year').html()<yearStop))
								{
										$(this).css("background","none").css("border","none").parent().css("border","1px solid "+COLOR).toggleClass('ui-datepicker-unselectable').toggleClass('ui-state-disabled');
												$(this).hover(function(){$(this).css("cursor","default");});
								
								}
								else if($('.ui-datepicker-year').html()==yearStop)
								{
									if($('.ui-datepicker-month').html()==monthStop)
									{
										if($(this).html()<=numberStop) 
										{
											
											
											$(this).css("background","none").css("border","none").parent().css("border","1px solid "+COLOR).toggleClass('ui-datepicker-unselectable').toggleClass('ui-state-disabled');
											$(this).hover(function(){$(this).css("cursor","default");});
										}
									}
									else if(month[$('.ui-datepicker-month').html()]<month[monthStop])
									{
										$(this).css("background","none").css("border","none").parent().css("border","1px solid "+COLOR).toggleClass('ui-datepicker-unselectable').toggleClass('ui-state-disabled');
											$(this).hover(function(){$(this).css("cursor","default");});
									}
								}
							
							}
						});
						find=false;
						
					
					}
					
	//Ici on recupère les dates de début/fin de location
	//apparition chargement.
	$('#load').toggleClass('activeLoad');
	$('body').prepend($('#load').show().css("height","110%"));
	$.ajax({type: 'GET',
			url: '?module=loc&action=infoajax&id='+idURL,
			dataType: 'json',
			success: function(data, txtStatus, jqXHR){
			
				var i=0;
				var prompt="";
				var dr="";
				var dl="";
				if(data!="undefined")
				{
					for(i=0;i<data.length;i++)
					{
						day_dl=data[i]['dateLoc'].split(' ')[0].split('-')[2]
						month_dl=data[i]['dateLoc'].split(' ')[0].split('-')[1];
						if(month_dl==1)month_dl="Janvier";
						else if (month_dl==2)month_dl="Février";
						else if (month_dl==3)month_dl="Mars";
						else if (month_dl==4)month_dl="Avril";
						else if (month_dl==5)month_dl="Mai";
						else if (month_dl==6)month_dl="Juin";
						else if (month_dl==7)month_dl="Juillet";
						else if (month_dl==8)month_dl="Août";
						else if (month_dl==9)month_dl="Septembre";
						else if (month_dl==10)month_dl="Octobre";
						else if (month_dl==11)month_dl="Novembre";
						else if (month_dl==12)month_dl="Décembre";
						year_dl=data[i]['dateLoc'].split(' ')[0].split('-')[0] ;
						
						dl=day_dl + "-" + month_dl+ "-" +  year_dl +" "+ data[i]['dateLoc'].split(' ')[1] ;
						
						day_dr=data[i]['dateRendu'].split(' ')[0].split('-')[2];
						month_dr=data[i]['dateRendu'].split(' ')[0].split('-')[1];
						if(month_dr==1)month_dr="Janvier";
						else if (month_dr==2)month_dr="Février";
						else if (month_dr==3)month_dr="Mars";
						else if (month_dr==4)month_dr="Avril";
						else if (month_dr==5)month_dr="Mai";
						else if (month_dr==6)month_dr="Juin";
						else if (month_dr==7)month_dr="Juillet";
						else if (month_dr==8)month_dr="Août";
						else if (month_dr==9)month_dr="Septembre";
						else if (month_dr==10)month_dr="Octobre";
						else if (month_dr==11)month_dr="Novembre";
						else if (month_dr==12)month_dr="Décembre";
						year_dr=data[i]['dateRendu'].split(' ')[0].split('-')[0] ;
						dr=day_dr+ "-" + month_dr+ "-" +  year_dr+" "+ data[i]['dateRendu'].split(' ')[1] ;
						
						//dr et dl sont les dates mais version francaise.
						
						
						
						prompt+="("+i+")  Début :"+dl+" -- Fin : "+dr+" .<br />";
						//terminer le chargement ici.
						$('#load').fadeOut();
					
					}
					
					$('#infoloc').html(prompt);
				}
				else
				{
					$('#infoloc').html("Aucune location en cours sur cette voiture.");
				}
				
			}
	
	
	});


});