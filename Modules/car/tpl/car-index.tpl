
<style>
	.image
	{
		height:57px;
		width:100px;
		cursor:pointer;
	}
	#big
	{
		height:500px;
		width:750px;
		display: block; 
		margin: 0 auto; 
	}
	table.tabcom
	{
		border:1px solid black;
		border-collapse: collapse;
		text-align:center;
	}
	th, td
	{
		border: 1px solid black;
		padding:10px;
	}
	
	
	
	
	#notation
	{
		-webkit-transform: rotate(-180deg);
		position:relative;
		margin-top:50px;
		margin-left:130px;
		float:left;
	}
	
	#notation div:nth-child(5)
	{
		width:10px;
		height:20px;
		margin-right:3px;
		background-color: white;
		float:left;
		
	}
	
	#notation div:nth-child(4)
	{
		background-color:white;
		width:10px;
		height:25px;
		float:left;
		margin-right:3px;
	}
	
	#notation div:nth-child(3)
	{
	margin-right:3px;
		background-color:white;
		width:10px;
		height:30px;
		float:left;
	}
	
	#notation div:nth-child(2)
	{
		background-color:white;
		width:10px;
		height:40px;
		float:left;
		margin-right:3px;
	}
	
	#notation div:nth-child(1)
	{
		background-color:white;
		width:10px;
		height:45px;
		margin-right:3px;
		float:left;
		content:"1";
	}
	
	.contenucom {
		border : solid white 1px;
		border-radius: 10px 10px 10px;
		padding-left:5px;
		padding-top:2px;
		width: 500px;
		height:70px;
		background-color:rgba(153,153,153,0.8);
		
	}
	.infocom
	{
		background-color:rgba(153,153,153,1);
		margin-bottom:-18px;
		position:relative;
		width:500px;
		border-radius: 20px 20px 20px;
		box-shadow: 0px 1px 1px white;
		padding:2px;
	}
	
	.groupcom
	{
		margin-top:10px;
		margin-left:17%;
		margin-bottom:-20px;
	}
</style>

<div id="sel"></div>
<div style="clear:both;"></div>
<div id="min" tag="tagok">
	<table class=ok><tr>
	{foreach $photo as $p}
		<td><img id={$p->getIdImage()} class=image src=./images/{$p->getIdImage()}.jpg /></td>
	{/foreach}
	</tr></table></div>
<div id="photo"></div>


<div id="comm">
	
	{foreach $com as $c}
		<div class="groupcom"><div class="infocom">Commentaire posté le {$c->getDateCom()} par (IdClient) {$c->getIdClient()}Note {$c->getNote()}</div><br /> <div class="contenucom">{$c->getContenu()}</div></div>
	{/foreach}
</div>
	<div id="notation">
			<div></div>
			<div></div>
			<div></div>
			<div></div>
			<div></div>
	</div>
<div id="addcom">{$f_com}</div>

</div>
<div style="clear:both;"></div>
<script src="./js/jquery-1.4.3.min.js"></script>
<script>
	$(function(){
		$('#addcom textarea').css("max-width","800px").css("max-height","200px").css("min-width","500").css("min-height","100");
	
		$('img').live('click', function(){
			
			if($(this).attr('id')!="big")
			{
			var image='';
				$var=$(this).attr('src');
				image='<img id="big" src='+$var+' />'
				$('#photo').html(image).hide();
				$('#photo').animate({
					width: "show",
					height:"show",
					margin: "0 auto"
				},500);
			}
			else if ($(this).attr('id')=="big")
			{
				$('#photo').html("");
			
			}
        });
		
		$('#notation div:nth-child(1)').hover(function(){
		
				$('#notation div:nth-child(1)').css("background-color","yellow");
				$('#notation div:nth-child(2)').css("background-color","yellow");
				$('#notation div:nth-child(3)').css("background-color","yellow");
				$('#notation div:nth-child(4)').css("background-color","yellow");
				$('#notation div:nth-child(5)').css("background-color","yellow");
				
		});
		
		$('#notation div:nth-child(2)').hover(function(){
		
				$('#notation div:nth-child(1)').css("background-color","white");
				$('#notation div:nth-child(2)').css("background-color","yellow");
				$('#notation div:nth-child(3)').css("background-color","yellow");
				$('#notation div:nth-child(4)').css("background-color","yellow");
				$('#notation div:nth-child(5)').css("background-color","yellow");
				
		});
		
		$('#notation div:nth-child(3)').hover(function(){
		
				$('#notation div:nth-child(1)').css("background-color","white");
				$('#notation div:nth-child(2)').css("background-color","white");
				$('#notation div:nth-child(3)').css("background-color","yellow");
				$('#notation div:nth-child(4)').css("background-color","yellow");
				$('#notation div:nth-child(5)').css("background-color","yellow");
				
		});
		
		$('#notation div:nth-child(4)').hover(function(){
		
				$('#notation div:nth-child(1)').css("background-color","white");
				$('#notation div:nth-child(2)').css("background-color","white");
				$('#notation div:nth-child(3)').css("background-color","white");
				$('#notation div:nth-child(4)').css("background-color","yellow");
				$('#notation div:nth-child(5)').css("background-color","yellow");
				
		});
		
		$('#notation div:nth-child(5)').hover(function(){
		
				$('#notation div:nth-child(1)').css("background-color","white");
				$('#notation div:nth-child(2)').css("background-color","white");
				$('#notation div:nth-child(3)').css("background-color","white");
				$('#notation div:nth-child(4)').css("background-color","white");
				$('#notation div:nth-child(5)').css("background-color","yellow");
				
		});
		
	});
</script>