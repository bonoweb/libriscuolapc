<?php
include_once "dbconnect.inc.php";
include_once "functions.inc.php";
if(isset($_GET['isbn']))
{
$isbn=$_GET['isbn'];
if(!is_numeric($isbn)){
	echo "non è un numero!";
	exit;
}
echo "<strong>ISBN:</strong> $isbn <br>";

/*
 * ricerca isbn nel db, così se abbiamo già un libro lo prendiamo dal db!
 * */
if($bid=book_already_stored($isbn)){
	$sql="SELECT * FROM books WHERE ID='$bid'";
	if($query=mysql_query($sql)){
		$row=mysql_fetch_row($query);
		$title=$row[1];
		$authors=$row[2];
		$year=$row[3];
		$isbn10=$row[4];
		$isbn13=$row[5];
		$pagine=$row[6];
		$thumbnail=$row[7];
	}
	else{
			die("Errore query select");
			exit;
		}
	
		echo "<strong>Titolo:</strong> ".$title; 
		echo "<br>";
		echo "<strong>Autori:</strong> ".$authors;    
		echo "<br>";
		echo "<strong>Pagine:</strong> ".$pagine;
		echo "<br>";
		echo "<img src=\"" . $thumbnail ."\">";
		echo "<input type=\"hidden\" id=\"theisbn\" name=\"theisbn\" value=\"".$isbn."\">";
	}
else{//libro non nel db e non trovato su google books -> lo inserisce l'utente!
	$page = file_get_contents("https://www.googleapis.com/books/v1/volumes?q=isbn:$isbn");
	$data = json_decode($page, true);
	if($data['totalItems']==0)
	{
		echo "Nessun testo trovato. Ricontrolla l'ISBN!<br><br>";
		echo "Se l'ISBN è corretto puoi aggiungere il libro inserendo tu stesso i dati!<br>";
		//inserimento dati utente
		echo "<strong>Titolo:</strong> "."<input type=\"text\" name=\"title\" required>"; 
		echo "<br>";
		echo "<strong>Autori:</strong> "."<input type=\"text\" name=\"authors\" required>";    
		echo "<br>";
		echo "<strong>Pagine:</strong> "."<input type=\"text\" name=\"pagecount\">";
		echo "<br>";
		echo "<strong>Anno:</strong> "."<input type=\"text\" name=\"year\">";
		echo "<br>";
		echo "<input type=\"hidden\" id=\"theisbn\" name=\"theisbn\" value=\"".$isbn."\">";
		echo "<input type=\"hidden\" id=\"manualadd\" name=\"manualadd\" value=\"1\">";
	}
	else{
		//inserisco dati da google books
		//google books mi da un link al libro con tutte le info (pare..), apro e cerco li!
		$selflink=$data['items'][0]['selfLink'];
		$page2=file_get_contents($selflink);
		$data = json_decode($page2, true);
		/*
		* DEBUG
		* 
		print_r($data);
		*/
		$title=stripslashes(mysql_real_escape_string($data['volumeInfo']['title']));
		$authors=stripslashes(mysql_real_escape_string(@implode(", ", $data['volumeInfo']['authors']))); 

		if(!isset($data['volumeInfo']['pageCount']))
			$pagecount=0;
		else
			$pagecount=$data['volumeInfo']['pageCount'];

		if(!isset($data['volumeInfo']['imageLinks']))	
			$thumbnail="images/noimg.png";
		else
			$thumbnail=$data['volumeInfo']['imageLinks']['thumbnail'];
	
		echo "<strong>Titolo:</strong> ".$title; 
		echo "<br>";
		echo "<strong>Autori:</strong> ".$authors;    
		echo "<br>";
		echo "<strong>Pagine:</strong> ".$pagecount;
		echo "<br>";
		echo "<img src=\"" . $thumbnail ."\">";
		echo "<input type=\"hidden\" id=\"theisbn\" name=\"theisbn\" value=\"".$isbn."\">";
		}
	}
}
?>
