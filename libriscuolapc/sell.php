<?php
session_start();
if(!isset($_SESSION['user'])){
	echo "Autenticati!";
	header('Location: login.php');
	exit;
}

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
 <link href="http://fonts.googleapis.com/css?family=Varela" rel="stylesheet" />
 <link href="default.css" rel="stylesheet" type="text/css" media="all" />
 <link href="fonts.css" rel="stylesheet" type="text/css" media="all" />
 <!--[if IE 6]><link href="default_ie6.css" rel="stylesheet" type="text/css" /><![endif]-->

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!--<script src="http://malsup.github.io/min/jquery.form.min.js"></script>-->

<!--add lines-->
<!--add lines too-->
<script language="javascript" type="text/javascript">

$(function(){
	$("#bookdata").find('input,textarea,select').prop('disabled',true);
});

//richesta ajax libro
function chiudilibro(){
	$("#book_sell").slideUp();
	$("#bookinfo").slideUp();
	$("#bookdata").find('input,textarea,select').prop('disabled',true);
}

$(document).on('submit','#booksearch',function(event){
	event.preventDefault();
	checkisbn();
	
});
function cercalibro(){
	//alert($("#isbn").val());
    var url = "getbook.php"; // the script where you handle the form input.
    $.ajax({
           type: "GET",
           url: url,
           beforeSend: chiudilibro,
           data: $("#booksearch").serialize(),// serializes the form's elements.
           success : function (response) {
			$("#bookinfo").html(response).slideDown();
			if (document.getElementById("theisbn")) {
				$("#book_sell").slideDown();
				$("#bookdata").find('input,textarea,select').prop('disabled',false);
			}
			} 
        });
}

//checkISBN
function checkisbn(){
	isbn=$("#isbn").val();
	if(isValidISBN10(isbn)||isValidISBN13(isbn)){
		//alert("valido!");
		cercalibro();
	}
	else{
		//alert("non valido!");
		chiudilibro();
		$("#bookinfo").html("<p>ISBN non valido! Ricontrolla!</p>");
		$("#bookinfo").slideDown();
	}
}
function isValidISBN10(a) {
    var c, b;
    if (10 != a.length) return !1;
    for (b = c = 0; 10 > b; b++)
        if ("X" == a[b] || "x" == a[b]) c += 10 * (10 - b);
        else if ($.isNumeric(a[b])) c += parseInt(a[b]) * (10 - b);
    else return !1;
    return 0 == c % 11
}

function isValidISBN13(a) {
    var c, b;
    if (13 != a.length) return !1;
    a = a.replace(/[-\s]/g, "");
    for (b = c = 0; 13 > b; b += 2) c += +a[b];
    for (b = 1; 12 > b; b += 2) c += 3 * +a[b];
    return 0 === c % 10
}

//controlli form
function check_form(event)
{
	var err=0;
	var errlist="";
	if($("#prezzo")=="") //prezzo non nullo
	{
			event.preventDefault();
			err=1;
			errlist="<p>inserisci un prezzo!</p>";
			$("#form_errlist").html(errlist).slideDown();
			
			return false;
	}
	else if(!($.isNumeric($("#prezzo").val()))) //prezzo numerico
		{
			event.preventDefault();
			err=1;
			errlist="Il prezzo deve essere un numero!";
			$("#form_errlist").html(errlist).fadeIn(100);
			$("#form_errlist").html(errlist).fadeOut(2000);
			
			return false;
		}
		else{
			return true;
		}
}

//counter notes
$(function() {
    //set up text length counter
    $('#notes').on("keypress", function() {
        update_chars_left(300, $('#notes')[0], $('#counter'));
    });
    //and fire it on doc ready, too
    update_chars_left(300, $('#notes')[0], $('#counter'));

});

function update_chars_left(max_len, target_input, display_element) {
   var text_len = target_input.value.length;
   if (text_len >= max_len) {
       target_input.value = target_input.value.substring(0, max_len); // truncate
       display_element.html("0");
   } else {
       display_element.html(max_len - text_len);
   }
}
//
$(document).on('submit','#bookdata',function(event){
	check_form(event);
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
				<li class="active"><a href="<?php echo $base; ?>/sell.php" accesskey="3" title="">Vendi un libro</a></li>
				<li><a href="<?php echo $base; ?>/contatti.php" accesskey="4" title="">Contatti</a></li>
				
<?php
ucp();
?>
				
			</ul>
		</div>
	</div>
	</div>
	
<?php
if(isset($_GET['submit']))
{
	echo "<div id=\"page\" class=\"container\">";
	if(isset($_POST['theisbn']))
	{
		$isbn = str_replace(' ', '', $_POST['theisbn']);
		$isbn=preg_replace('/[^\-\d]*(\-?\d*).*/','$1',$isbn);
		
		$price=$_POST['prezzo'];
		$price = str_replace(',', '.', $price); // change comma to fullstop
		$price = floatval($price);
		if(!is_numeric($price)){
			echo "NOT NUMERIC:".$price."<br>";
			$price=0; //error: price is not numeric!
			
		}
		//$price = str_replace('.', '', $price); // remove fullstop
		$price = str_replace(' ', '', $price); // remove spaces
		
		$status=mysql_real_escape_string($_POST['status']);
		$notes=mysql_real_escape_string($_POST['notes']);
		
		//controllo se ho già il libro nel db, nel caso non lo avessi lo aggiungo.
		$bid=book_already_stored($isbn);
		//echo "debug bid:".$bid."<br>";
		
		if($bid) //ho già il libro nel db, lo inserisco tra i libri dell'utente
			store_user_book($bid,$price,$status,$notes);
		else{ 
			//inserisco il libro in books e poi tra quelli dell'utente
			
			//se è un'aggiunta manuale la faccio, altrimenti scarico da google books le info
		$page = file_get_contents("https://www.googleapis.com/books/v1/volumes?q=isbn:$isbn");
		$data = json_decode($page, true);
		if($data['totalItems']==0)
		{
			if(isset($_POST['manualadd']))
			{
				//aggiunta manuale
				$title=substr($_POST['title'], 0, 60);
				$title=mysql_real_escape_string($title);
				
				$authors=substr($_POST['authors'], 0, 60);
				$authors=mysql_real_escape_string($authors);
				
				$pagecount=substr($_POST['pagecount'], 0, 5);
				$pagecount=intval($pagecount);
				
				$year=intval($_POST['year']);
				$year=substr($_POST['year'], 0, 4);
				
				if(strlen($isbn)==10)
				{
					$isbn10=$isbn;
					$isbn13=NULL;
				}
				else{
					$isbn13=$isbn;
					$isbn10=NULL;
				}
				
				$thumbnail="images/noimg.png";
				$manualadd=1;
			}
			else{
				//perchè sei qua? non hai aggiunto il libro manualmente e non è su google books
			echo "Testo non trovato. (ISBN: $isbn)";
			exit;
			}
		}
		else{
		//google books mi da un link al libro con tutte le info (pare..), apro e cerco li!
		$selflink=$data['items'][0]['selfLink'];
		$page2=file_get_contents($selflink);
		$data = json_decode($page2, true);
		
		$title=mysql_real_escape_string($data['volumeInfo']['title']);
		$authors=mysql_real_escape_string(@implode(", ", $data['volumeInfo']['authors']));
		    
		if(!isset($data['volumeInfo']['pageCount']))
			$pagecount=0;
		else
			$pagecount=$data['volumeInfo']['pageCount'];
			
		$year=$data['volumeInfo']['publishedDate'];
		
		if(!isset($data['volumeInfo']['imageLinks']))
			$thumbnail="images/noimg.png";
		else
			$thumbnail=$data['volumeInfo']['imageLinks']['thumbnail'];
		
		
		$isbn10=$data['volumeInfo']['industryIdentifiers'][0]['identifier'];
		$isbn13=$data['volumeInfo']['industryIdentifiers'][1]['identifier'];
		
		$manualadd=0;
			//fine scaricamento dati da google books
		}
			//inizio inserimento dati nel db
			$bid=insertbook($title,$authors,$year,$isbn10,$isbn13,$pagecount,$thumbnail,$manualadd);
			if($bid){
				store_user_book($bid,$price,$status,$notes); //le stampe di conferma inserimento sono fatte dalla funzione!
				}
			else
				echo "Errore inserendo il libro. Contattaci.";
			}	
	}
	else
	{
		echo "Errore. Riprova o Contattaci<br>";
	}
	
	echo "</div>";
}
else{
	//stampo il form di inserimento libro
?>	
	<div id="banner">
		<div class="container">
			<div class="title">
				<h2>Vendi un libro</h2>
			<ul class="actions">
			    <li><form id="booksearch" action="getbook.php" method="GET">
					<input type="text" name="isbn" id="isbn" class="search"
			                placeholder="Inserisci codice ISBN">
			        <a href="#" class="button" id="bt_cerca" onclick='checkisbn();'>Cerca</a>
			        </form>
			    </li>
			</ul>
			</div>
		</div>
	</div>
	
	<div id="page" class="container">
		
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>?submit=1" method="POST" id="bookdata">
		<div id="bookinfo">
		</div>
		<div id="book_sell" style="display:none;">
		<label>Prezzo: €</label><input type="text" name="prezzo" id="prezzo"> <span id="form_errlist"></span>
		<br>
		<label>Condizioni del libro </label><select name="status">
			<option value="0">Nuovo/Mai usato</option>
			<option value="1">Sottolineato</option>
			<option value="2">Danneggiato ma leggibile</option>
		</select>
		<br>
		<label>Note: </label><textarea name="notes" id="notes"></textarea><p>Caratteri Rimanenti: <span id="counter"></span></p>
 		<br>
		<input type="submit" id="bt_invia" value="Invia">
		</div>
	</form>
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
<?php
}
?>
</div> <!--end wrapper-->
<?php
footer();
?>

</body>
</html>
