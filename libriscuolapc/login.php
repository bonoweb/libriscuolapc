<?php
session_start();
if(isset($_SESSION['user'])){
	header('Location: index.php');
}
else{
	include_once("functions.inc.php");
?>

<!DOCTYPE html>
<html>
<head>
 <title>libriscuolapc - Libri Scuola Piacenza</title>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta name="keywords" content="libri, scuola, piacenza, pc, libri scolastici" />
 <meta name="description" content="LibriScuolaPC è il primo sito completamente gratuito 
 nel territorio Piacentino per comprare e vendere libri scolastici usati al miglior prezzo" />
 <link href="http://fonts.googleapis.com/css?family=Varela" rel="stylesheet" />
 <link href="default.css" rel="stylesheet" type="text/css" media="all" />
 <link href="fonts.css" rel="stylesheet" type="text/css" media="all" />
 <!--[if IE 6]><link href="default_ie6.css" rel="stylesheet" type="text/css" /><![endif]-->
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
			</ul>
			</div>
		</div>
	</div>

	<div id="page" class="container">
	<?php
	include_once('fbconnect.inc.php');
	echo "<h2>Per continuare, effettua il login con il tuo profilo Facebook:</h2><br>";
	echo  "<a href=\"".$loginUrl."\"> <img src=\"images/active_200.png\" alt=\"Login with Facebook\"> </a>";
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
<?php
}
?>
