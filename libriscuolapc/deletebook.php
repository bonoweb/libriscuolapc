<?php
session_start();
if(!isset($_SESSION['user'])){
	echo "Autenticati!";
	header('Location: index.php');
	exit;
}
include_once "dbconnect.inc.php" ;
include_once "functions.inc.php" ;
$bookid=(int)$_GET['id'];
$userid=$_SESSION['fbid'];
$sql="DELETE FROM user_books WHERE ID='$bookid' AND user_books.userid='$userid'";

?>

<!DOCTYPE html>
<html>
<head>
 <title>libriscuolapc - Libri Scuola Piacenza</title>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta name="keywords" content="" />
 <meta name="description" content="" />
 <link href="http://fonts.googleapis.com/css?family=Varela" rel="stylesheet" />
 <link href="default.css" rel="stylesheet" type="text/css" media="all" />
 <link href="fonts.css" rel="stylesheet" type="text/css" media="all" />
 <!--[if IE 6]><link href="default_ie6.css" rel="stylesheet" type="text/css" /><![endif]-->
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
 <script>
	 $(function(){
		$("#scuola").change(function(){
			if(this.value=="Altro")
				$("#scuola_altro").show();
			else
				$("#scuola_altro").hide();
			});
	});
 </script>
 </head>
 <body>
 <div id="wrapper">
	<div id="header-wrapper">
	<div id="header" class="container">
		<div id="logo">
			<h1><a href="<?php echo $base; ?>/index.php">LibriScuolaPC</a></h1>
		</div>
		<div id="menu">
			<ul>
				<li><a href="<?php echo $base; ?>/index.php" accesskey="1" title="">Homepage</a></li>
				<li><a href="<?php echo $base; ?>/info.php" accesskey="2" title="">Informazioni</a></li>
				<li><a href="<?php echo $base; ?>/sell.php" accesskey="3" title="">Vendi un libro</a></li>
				<li><a href="<?php echo $base; ?>/contatti.php" accesskey="4" title="">Contatti</a></li>
				<!--<li><a href="#" accesskey="5" title="">Contact Us</a></li>-->				
			</ul>
			</div>
		</div>
	</div>

	<div id="page" class="container">
<?php
$query=mysql_query($sql);
if($query)
	if(mysql_affected_rows()==1){
		echo "<h2>Libro Eliminato!</h2><br>";
		echo "<a href=\"".$base."/ubooks.php\">I tuoi libri</a> - <a href=\"".$base."/sell.php\">Vendi un Libro</a>";
	}
	else
		echo "<h2>Libro NON Eliminato!</h2><br>";
else
	echo "Errore nell'eliminazione! Contattaci";
?>

</div> <!--end div page-->
</div> <!--end wrapper-->

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
<?php
footer();
?>

</body>
</html>
