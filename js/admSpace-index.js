$(function(){


	$(".clickable").click(function(){
		
		var where=$(this).parent().find('a').attr('href');
		
		location.href = where;  //redirection jq.
	});
	
	


});