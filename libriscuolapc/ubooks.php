<?php
session_start();
if(!isset($_SESSION['user'])){
	header('Location: login.php');
	exit;
}
date_default_timezone_set('Europe/Rome');
include_once  "dbconnect.inc.php" ;
include_once  "functions.inc.php" ; 
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
<?php
ucp();
?>				
			</ul>
			</div>
		</div>
	</div>

	<div id="page" class="container">
		
		<?php
$fbid=$_SESSION['fbid'];

$sql="SELECT user_books.ID, title, author, year, price, status, notes, user_books.date, bookid, user_books.venduto
FROM books, user_books
WHERE books.ID = user_books.bookid
AND user_books.userid = $fbid
AND user_books.venduto = 0 
ORDER BY user_books.date DESC";

$sql2="SELECT user_books.ID, title, author, year, price, status, notes, user_books.date, bookid, user_books.venduto
FROM books, user_books
WHERE books.ID = user_books.bookid
AND user_books.userid = $fbid
AND user_books.venduto = 1 
ORDER BY user_books.date DESC";

$query=mysql_query($sql) or die("errore".mysql_error());
if($query){
	$num_fields = mysql_num_rows($query); 
	if(!($num_fields))
		echo "Non hai libri in vendita.<br>
		<a href=\"sell.php\"><img src=\"images/book_add.png\">Vendi un Libro</a>";
	else{
	echo "<table class=\"booklist\"><tr><th>Titolo</th><th>Autori</th><th>Anno</th><th>Prezzo</th><th>Stato</th><th>Note</th><th>Data Aggiunta</th><th colspan=\"3\">Azioni</th></tr>";
	while ($riga = mysql_fetch_array($query)) {
		if($riga[9]==0){
			echo("<tr><td>$riga[1]</td><td>$riga[2]</td><td>$riga[3]</td><td>$riga[4]</td>
			<td>".quality($riga[5])."</td><td>$riga[6]</td><td title=\"".date('H:i - d/m/Y',strtotime($riga[7]))."\">".convertDate(strtotime($riga[7]))."</td>
			<td><a href=\"deletebook.php?id=$riga[0]\"><img src=\"images/book_delete.png\"> Elimina</a></td>
			<td><a href=\"marksold.php?id=$riga[0]\"><img src=\"images/tick.png\"> Segna come venduto</a></td></tr>");
			}
		}
	echo "</tbody></table>";
	}
}
echo "<br><br>";
$query2=mysql_query($sql2) or die("errore".mysql_error());
if($query2){
	$num_fields = mysql_num_rows($query2); 
	if(!($num_fields))
		{ /*echo ""; */}
	else{
	//tabella libri già venduti
	echo "Storico libri già venduti:<br>";
	echo "<table class=\"booklist\"><tr><th>Titolo</th><th>Autori</th><th>Anno</th><th>Prezzo</th><th>Stato</th><th>Note</th><th>Data Aggiunta</th><th>Elimina</th></tr>";
	$query=mysql_query($sql2) or die("errore".mysql_error());
	while ($riga = mysql_fetch_array($query)) {
		if($riga[9]==1){
			echo("<tr><td>$riga[1]</td><td>$riga[2]</td><td>$riga[3]</td><td>$riga[4]</td>
			<td>".quality($riga[5])."</td><td>$riga[6]</td><td title=\"".date('H:i - d/m/Y',strtotime($riga[7]))."\">".convertDate(strtotime($riga[7]))."</td>
			<td><a href=\"deletebook.php?id=$riga[0]\"><img src=\"images/book_delete.png\"> Elimina</a></td></tr>");
			}
		}
	echo "</tbody></table><br>";
	echo "<a href=\"sell.php\"><img src=\"images/book_add.png\">Vendi un Libro</a>";
	
	}
}
?>
<br>
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
