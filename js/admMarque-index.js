$(function(){
	
	$(".infomarque>a").click(function(){
		$(this).parent().parent().find('div.info').toggleClass('hidden');
		$(this).parent().parent().toggleClass('box').toggleClass('boxup');
		return false;
	});

});