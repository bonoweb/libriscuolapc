<?php
	$host="localhost";
	$user="DB USER";
	$pass="DB PASS";
	
	$db="DB NAME";
	
	$conn=@mysql_connect($host,$user,$pass) or die("errore di connessione al DB: ").mysql_error();
	@mysql_select_db($db) or die("Errore nella selezione del DB $db: ").mysql_error();
	
?>
