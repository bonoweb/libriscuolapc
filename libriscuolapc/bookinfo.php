<?php
include_once("dbconnect.inc.php");
include_once("functions.inc.php");
session_start();

$bookid=(int)$_GET['id'];
$sql="SELECT books.author, books.date, books.isbn10, books.isbn13, books.pagine, books.thumbnail, books.title, books.year, 
users.cemail, users.cfb, users.cmail, users.ctel, users.FBprofile, users.telefono, users.scuola, users.nome, users.cognome, 
user_books.date, user_books.notes, user_books.price, user_books.status, user_books.lastupdate, user_books.ID
FROM users, user_books, books
WHERE user_books.venduto = '0'
AND user_books.ID = $bookid
AND users.FBID = user_books.userid
AND books.ID = user_books.bookid;";
$query=mysql_query($sql) or die("Errore query.<br>");
$arr=mysql_fetch_array($query);

$username=$arr["nome"]." ".$arr["cognome"];
$fblink=$arr["FBprofile"];
$cfb=$arr["cfb"];
$cmail=$arr["cmail"];
$ctel=$arr["ctel"];
$tel=$arr["telefono"];
$cemail=$arr["cemail"];
$scuola=$arr["scuola"];

$titolo=$arr["title"];
$author=$arr["author"];
$isbn10=$arr["isbn10"];
$isbn13=$arr["isbn13"];
$pagine=$arr["pagine"];
$thumbnail=$arr["thumbnail"];
$year=$arr["year"];

$date=$arr["date"];
$notes=$arr["notes"];
$price=$arr["price"];
$status=$arr["status"];


?>
<table style="width: 100%; text-align:center;">
<tr>
	<td rowspan="12"><img src="<?php echo $thumbnail; ?>"></td>
	<td><strong>Titolo:</strong> <?php echo $titolo; ?></td>
</tr>
<tr><td><strong>Autore/i:</strong> <?php echo $author; ?></td></tr>
<tr><td><strong>Pagine:</strong> <?php echo $pagine; ?></td></tr>
<tr><td><strong>Anno:</strong> <?php echo $year; ?></td></tr>
<tr><td><strong>ISBN10:</strong> <?php echo $isbn10; ?></td></tr>
<tr><td><strong>ISBN13:</strong> <?php echo $isbn13; ?></td></tr>
<tr><td><strong>Stato:</strong> <?php echo quality($status); ?></td></tr>
<tr><td><strong>Prezzo:</strong> €<?php echo $price; ?></td></tr>
<tr><td><strong>Note:</strong> <?php echo $notes; ?></td></tr>
<?php
//visualizzo informazioni sul venditore solo se l'utente è collegato
if(!isset($_SESSION['user'])){
	echo "Per informazioni sul venditore devi fare prima <a href=\"login.php\">login</a>";
}
else{
?>

<tr><td><strong>Venduto da:</strong> <?php echo $username; ?></td></tr>
<?php echo"<tr><td><strong>Scuola:</strong> $scuola</td></tr>"; ?>
<?php if($ctel){ echo"<tr><td><strong>Telefono:</strong> $tel</td></tr>";} ?>
<?php if($cmail){ echo"<tr><td><strong>Email:</strong> $cemail</td></tr>";} ?>
<?php if($cfb){ echo"<tr><td><a href=\"$fblink\">Profilo Facebook</a></td></tr>";} ?>
<?php
} // fine else
?>
</table>
