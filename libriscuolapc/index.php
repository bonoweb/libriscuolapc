<?php
session_start(); 

include_once  "dbconnect.inc.php" ; 
include_once  "fbconnect.inc.php" ; 
include_once "functions.inc.php" ;
?>
<!DOCTYPE html>
<html>
<head>
 <title>libriscuolapc - Libri Scuola Piacenza</title>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta name="keywords" content="libri, scuola, piacenza, pc, libri scolastici" />
 <meta name="description" content="LibriScuolaPC è il primo sito completamente gratuito 
 nel territorio Piacentino per comprare e vendere libri scolastici usati al miglior prezzo" />
 <link rel="icon" href="./favicon.ico" type="image/x-icon">
 <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon"> 
 <link href="http://fonts.googleapis.com/css?family=Varela" rel="stylesheet" />
 <link href="default.css" rel="stylesheet" type="text/css" media="all" />
 <link href="fonts.css" rel="stylesheet" type="text/css" media="all" />
 <!--[if IE 6]><link href="default_ie6.css" rel="stylesheet" type="text/css" /><![endif]-->

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
	$(document).ready(function() {
		
	last_books=$("#booklist").html();
	
	$('#search').focus(function(){
			$("#sellbutton").slideUp();
		})
    $('#search').blur(function(){
			if($('#search').val().length==0){
				$("#sellbutton").slideDown();
			}
		})
    $('#search').keyup(function(){
		
		
		l=$( this ).val();
		len= l.length;

		if(len >= 3)
		{
			$("#LoadingImage").show();
			//alert("Ciao");
			$.ajax({
				url: "search.php",
				type: "get",
				data: {search: $('#search').val()},
				success: function(data){
					//adds the echoed response to our container
					$("#LoadingImage").hide();
					$("#tabtitle").text("Risultati ricerca per \""+$('#search').val()+"\"");
					$("#booklist").html(data);
					
				}
			})	
		}
		else{
				if(len==0){
					//torno a visualizzare gli ultimi libri
					$("#tabtitle").text("Ultimi Libri Aggiunti");
					$("#booklist").html(function(){
						return(last_books);
					});
				}
				else{
					
					$("#booklist").html(function(){
						$("#sellbutton").slideUp();
						$("#tabtitle").text("Risultati ricerca per \""+$('#search').val()+"\"");
						return "<p>inserisci almeno tre caratteri per cercare</p>";
					});
				}
		}
    });
});
</script> 
 <script>
  function popup(id){
	  $.ajax({
				url: "bookinfo.php",
				type: "get",
				data: {id: id},
				success: function(data){
					$("#popup").html(data);	
				}
			})	
	 $("#blackback").show();
	 $("#popup").fadeIn();
	 }
 </script>
</head>
<body>
<div id="blackback" style="display:none;" onclick="$(this).fadeOut(); $('#popup').fadeOut(100);"></div>
<div id="popup" style="display:none;"><img src="images/loading.gif"></div>
<div id="wrapper">
	<div id="header-wrapper">
	<div id="header" class="container">
		<div id="logo">
			<h1><a href="<?php echo $base; ?>/index.php">LibriScuolaPC</a></h1>
		</div>
		<div id="menu">
			<ul>
				<li class="active"><a href="<?php echo $base; ?>/index.php" accesskey="1" title="">Homepage</a></li>
				<li><a href="<?php echo $base; ?>/info.php" accesskey="2" title="">Informazioni</a></li>
				<li><a href="<?php echo $base; ?>/sell.php" accesskey="3" title="">Vendi un libro</a></li>
				<li><a href="<?php echo $base; ?>/contatti.php" accesskey="4" title="">Contatti</a></li>
<?php
ucp();
?>
				
			</ul>
		</div>
	</div>
	</div>
	<div id="banner">
		<div class="container">
			<div class="title">
				<h2>Vendi e compra i tuoi libri scolastici</h2>
				<span class="byline">a Piacenza, al miglior prezzo!</span> </div>
			<ul class="actions">
				<div id="sellbutton"><li><a href="sell.php" class="button">Vendi un Libro</a></li>
				<li>oppure</li>
				</div>
			    <li><input type="text" name="search" id="search" class="search"
			                placeholder="CERCA LIBRO: Inserisci ISBN, autore o titolo"></li>
			</ul>
		</div>
	</div>
	
	<div id="page" class="container">
      <div class="title">
	    <span class="byline" id="tabtitle">Ultimi Libri Aggiunti</span>
	  </div>
		
			<div class="LoadingImage" style="display: none"><img src="images/loading.gif"></div>
			<table class="booklist" id="booklist">
				
			<?php
				lastbooks();
			?>
			
			</table>

		
	</div>



<br><br>

<!-- inizio google ad -->
<div style="text-align:center;">
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- libriscuolapc1 -->
<ins class="adsbygoogle"
     style="display:inline-block;width:728px;height:90px"
     data-ad-client="ca-pub-1604072627158521"
     data-ad-slot="7078546395"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>
<!-- fine google ad -->

<br>
<br>

</div> <!--end wrapper-->
<?php
footer();
?>
</body>
</html>
