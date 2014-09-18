<?php
session_start();
if(!isset($_SESSION['user'])){
	echo "Devi prima effettuare login!";
	header('Location: login.php');
	exit;
}
include_once('dbconnect.inc.php');
include_once('functions.inc.php');
$bookid=(int)$_GET['id'];
$uid=$_SESSION['fbid'];
/*
echo "bookid: ".$bookid;
echo "<br>fbid: ".$uid;
*/
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
$sql="UPDATE user_books
SET user_books.venduto=1
WHERE user_books.ID=$bookid
AND user_books.userid=$uid";
$query=mysql_query($sql);
if($query)
	if(mysql_affected_rows()==1){
		echo "<h2>Operazione Completata - Libro segnato come venduto.</h2><br>";
		echo "<a href=\"".$base."/index.php\">Homepage</a> - <a href=\"".$base."/ubooks.php\">I tuoi libri</a>";
	}
	else
		echo "<p>Errore!? Operazione NON completata! (non ricaricare la pagina!)</p><br>";
else
	echo "<p>Errore. Riprova o Contattaci.</p>";
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

