<?php
/*$base="//libriscuolapc.altervista.org/testing";*/
$base="//192.168.1.3/libriscuolapc";
/*$base="//libriscuolapc.it";*/
function ucp(){
	include_once  "dbconnect.inc.php" ; 
	include_once  "fbconnect.inc.php" ; 
	global $loginUrl;
	if (!isset($_SESSION['user'])) 
	{ 

		echo  "<span>  <a href=\"".$loginUrl."\"> <img src=\"images/active_200.png\" alt=\"Login with Facebook\"> </a></span>"; 
	}
	else
	{ 
	
	
		$FBID  = $_SESSION['user']; 
 
		$query  = "SELECT * FROM users WHERE FBID ='".$FBID."'"; //FBID al posto di email

		$res  = mysql_query($query)  or die('query non riuscita:'.mysql_error()."<br> \n $query" ); 
		$riga = mysql_fetch_array($res); 
		$name = $riga['nome']; 
		echo "<li id=\"ucp\">";
		
		echo "<a>Ciao, $name!</a>";
		echo "<div id=\"ucplinks\">";
		echo "<a href=\"upanel.php\"><img src=\"images/cog.png\">Impostazioni</a> ";
		echo "<a href=\"ubooks.php\"><img src=\"images/book.png\">I tuoi libri</a> ";
		echo "<a href=\"logout.php\"><img src=\"images/door_out.png\">Logout</a> " ;
		
		echo "</div></a>";
		echo "</li>";

	}  
}


function quality($q){
	switch($q){
		case 0:
			return "Nuovo/Mai Usato";
			break;
		case 1:
			return "Sottolineato";
			break;
		case 2:
			return "Danneggiato ma leggibile";
			break;
		default:
			return "Non segnalato";
		}
}

function lastbooks(){
	date_default_timezone_set('Europe/Rome');
	//echo "<table class=\"booklist\">";
	echo "<tr><th>Titolo</th><th>Autori</th><th>Anno</th><th>Prezzo</th><th>Stato</th><th>Data Aggiunta</th></tr>";
	$sql="SELECT user_books.ID, title, author, year, price, status, notes, user_books.date, bookid
FROM books, user_books WHERE bookid=books.ID AND user_books.venduto=0 ORDER BY user_books.date DESC LIMIT 10";
	$q=mysql_query($sql) or die("errore.<br>");
	while ($riga = mysql_fetch_array($q)) {
		echo("<tr><td><a href=\"#\" onclick=\"popup($riga[0]);\">$riga[1]</a></td><td>$riga[2]</td><td>$riga[3]</td><td>$riga[4]</td>
		<td>".quality($riga[5])."</td><td title=\"".date('H:i - d/m/Y',strtotime($riga[7]))."\">".convertDate(strtotime($riga[7]))."</td></tr>");	/*date('H:i - d/m/Y',strtotime($riga[7]))."</td></tr>");*/
		}
	//echo "</table>";
	
}

function book_already_stored($isbn){ //ritorna l'id del libro se è già memorizzato, altrimenti ritorna 0
	$sql="SELECT * FROM books WHERE isbn10='$isbn' OR isbn13='$isbn'";
	if($query=mysql_query($sql))
		if(mysql_num_rows($query)==0)
			return 0;
		else{
				$row = mysql_fetch_row($query);
				//echo $row[0];
				return $row[0]; //id del libro
				
			}
	else
		echo "error - function book_already_stored(): ".mysql_error()."<br>";
			
	
}
function insertbook($title,$author,$year,$isbn10,$isbn13,$pages,$thumbnail,$manualadd){
	
	$sql="INSERT INTO books VALUES('','$title','$author','$year','$isbn10','$isbn13','$pages','$thumbnail','$manualadd',NOW())";
	include_once('dbconnect.inc.php');
	$query=mysql_query($sql) or die("Errore: ".mysql_error()."<br>");
	if($query){
		//echo "Nuovo libro inserito nel database<br>";
		return mysql_insert_id(); //ritorno l'id del libro inserito
	}
	else
		return 0;
	//inserisco il libro in books
	//ritorno l'id del libro nel db?
	//return $ID;
	
}

function store_user_book($bid,$price,$status,$notes){
	$fbid=$_SESSION['fbid'];
	$IP=$_SERVER['REMOTE_ADDR'];
	$sql="INSERT INTO user_books VALUES('','$fbid','$bid','$price','$status',NOW(),NOW(),'$IP','$notes',0)";
	$query=mysql_query($sql);
	if(!$query)
		echo "Errore nell'inserimento";
	else
		echo "<div><h2>Libro Inserito!</h2><br><a href=\"index.php\">Home Page</a> | <a href=\"ubooks.php\">I tuoi Libri</a></div>";
	
	
}

function convertDate($date)
{
	$d = time()-$date;
	if($d<=40) return "Meno di un minuto fa";
	if($d<60*60) return sprintf("%d minut%s fa", (int)($d/60), (((int)($d/60)==1)?'o':'i'));
	if($d<60*60*24) return sprintf("%d or%s fa", (int)($d/60/60), (((int)($d/60/60)==1)?'a':'e'));
	return date("d/m/Y", $date);
}

/*function printmenu(){
	print('<div id="menu">
			<ul>
				<li class="active"><a href="#" accesskey="1" title="">Homepage</a></li>
				<li><a href="#" accesskey="2" title="">Chi siamo</a></li>
				<li><a href="#" accesskey="3" title="">Vendi un libro</a></li>
				<li><a href="#" accesskey="4" title="">Contattaci</a></li>
				<!--<li><a href="#" accesskey="5" title="">Contact Us</a></li>-->				
			</ul>
		</div>
		');
}*/

function footer()
{
	echo "<div id=\"copyright\" class=\"container\">";
	echo "<p>&copy; Libriscuolapc ".date('Y').". All rights reserved. | <a href=\"terms.php\">Termini e Condizioni</a> | <a href=\"privacy.php\">Privacy</a> | Tema base di <a href=\"http://templated.co\" rel=\"nofollow\">TEMPLATED</a>.</p>";
	echo "</div>";
	/*google analytics*/
	/*
	echo "<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-46219730-2', 'auto');
  ga('send', 'pageview');

	</script>
	";
	*/
}
?>
