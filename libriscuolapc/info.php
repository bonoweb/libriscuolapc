<?php
session_start(); 

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
</head>
<body>
<div id="blackback" style="display:none;" onclick="$(this).fadeOut(); $('#popup').fadeOut(100);"></div>
<div id="popup" style="display:none;"><img src="images/loading.gif"></div>
<div id="wrapper">
	<div id="header-wrapper">
	<div id="header" class="container">
		<div id="logo">
			<h1><a href="<?php echo $base; ?>/index.php">LibriScuolaPC</a></h1>
		</div>
		<div id="menu">
			<ul>
				<li><a href="<?php echo $base; ?>/index.php" accesskey="1" title="">Homepage</a></li>
				<li class="active"><a href="<?php echo $base; ?>/info.php" accesskey="2" title="">Informazioni</a></li>
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
      <div class="title">
	    <span class="byline" id="tabtitle">Informazioni</span>
	</div>    
	<div>
		<strong>LibriScuolaPC</strong> è la prima piattaforma online completamente gratuita
	    nel territorio Piacentino con lo scopo di favorire e permettere
	    la compravendita di libri scolastici usati senza intermediari 
	    tra venditori e acquirenti. L'obiettivo è fare in modo che lo 
	    scambio di libri scolastici avvenga al prezzo più vantaggioso 
	    per ogni parte, con un prezzo concordato direttamente.
	</div>
	<br>
	<div>
		<strong>LibriScuolaPC</strong> è stato creato da studenti per gli studenti: 
		per aiutarci a renderlo sempre migliore, puoi inviarci 
		suggerimenti o segnalare bug ai nostri contatti.
	</div>
	<br>
	<div class="title">
	    <span class="byline" id="tabtitle">Guida Rapida all'uso</span>
	</div>
	
	<div>
	<table class="flat-table">
  <tbody>
    <tr>
      <th style="background-color: #dc572e">Vendere un libro</th>
      <th style="background-color: #7ac0e8">Comprare un libro</th>
    </tr>
    <tr>
	      <td>Clicca su <a href="sell.php">Vendi un Libro</a> e segui le istruzioni!</td>
	      <td>Vai sulla <a href="index.php">Homepage</a> e cerca il tuo libro, i risultati si caricano in automatico!</td>
	    </tr>

	    <tr>
	      <td>
	    	Controlla periodicamente mail, telefono e Facebook per vedere se qualcuno ti ha contattato
		</td>
		  <td>
			Clicca sul titolo del libro e contatta il venditore (Facebook, telefono o mail)
		</td>
		</tr>
		 <tr>
	      <td>
		Vendi!
		 </td>
		 <td>
		Compra!
		 </td>
		  
		</tr>
		<tr>
	      <td>
		Fatto! Ricordati di andare su <a href="ubooks.php">I tuoi Libri</a> e segnare il libro come venduto!
		 </td>
		  <td>
			Non devi fare nient'altro. Facile, no?
		 </td>
		</tr>
     </tbody> 
   </table>
	<br>
     Se scegli di essere contattato via Facebook, ricorda di controllare anche la cartella <a href="https://www.facebook.com/messages/other">"Altri"</a> della posta!
		
	</div>
	
	  

		
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

</div> <!--end wrapper-->
<?php
footer();
?>
</body>
</html>
