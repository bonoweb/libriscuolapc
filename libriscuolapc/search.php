<?php
include_once('dbconnect.inc.php');
include_once('functions.inc.php');
date_default_timezone_set('Europe/Rome');
$search=mysql_real_escape_string($_GET['search']);
$low=0;
$high=$low+20;
$sql="SELECT title, author, year, price, status, user_books.date, user_books.ID 
FROM books, user_books
WHERE user_books.bookid = books.ID
AND user_books.venduto =0
AND (
title LIKE '%$search%'
OR books.author LIKE '%$search%'
OR books.isbn10 LIKE '%$search%'
OR books.isbn13 LIKE '%$search%'
)
";/*LIMIT $low,$high*/
$query=mysql_query($sql);
if(!$query)
	echo "errore query";
else{
		//stampo tabella risultati
		if(mysql_num_rows($query)==0)
			echo "Nessun Risultato Trovato";
		else{
			echo "<tr><th>Titolo</th><th>Autori</th><th>Anno</th><th>Prezzo</th><th>Stato</th><th>Data Aggiunta</th></tr>";
			while($r=mysql_fetch_row($query)){
				echo "<tr><td><a href=\"javascript:void(0);\"onclick=\"popup($r[6]);\">".$r[0]."</a></td><td>".$r[1]."</td><td>".
				$r[2]."</td><td>".$r[3]."</td><td>".quality($r[4])."</td><td title=\"".date('H:i - d/m/Y',strtotime($r[5]))."\">".convertDate(strtotime($r[5]))."</td>";
				}
			
			}
	}
?>
