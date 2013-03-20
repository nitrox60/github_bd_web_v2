$(function(){
		
		$('.min>img').click(function(){ // on reduit les infos peux utiles
			var who=$(this).parent().parent().parent().find('.body_loc');
			if($(who).css('display')!='none')
				$(this).parent().parent().parent().find('.body_loc').css('display','none').parent().css('height','100px').find('.header_loc').css('border-bottom','0px solid white');
			else if($(who).css('display')=='none')
				$(this).parent().parent().parent().find('.body_loc').css('display','block').parent().css('height','200px').find('.header_loc').css('border-bottom','1px solid black');
		});

		$('.close>img').click(function(){ //suppression d'une location
		
		if(confirm("Etes-vous sur de supprimer cette location?"))
		{
		 var who=$(this).parent().parent().parent().find('.header_loc').find('.idlocforajax');
		 alert($(who).text());
		
			$.ajax({
					type: 'GET',
					url: '?module=admloc&action=ajaxdelete&idloc='+$(who).text(),
					dataType: 'json',
					success: function(data,txtStatus, jqXHR){
						alert("Location supprimé");
					}
					});
		}
		});

});