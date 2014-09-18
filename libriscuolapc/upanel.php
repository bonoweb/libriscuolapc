<?php
session_start();
if(!isset($_SESSION['fbid'])){
	echo "Prima devi fare login!";
	header('Location: index.php');
	exit;
}
include_once("functions.inc.php");
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
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
 <script>
	 $(function(){
		$("#scuola").change(function(){
			if(this.value=="Altro")
				$("#scuola_altro").show();
			else
				$("#scuola_altro").hide();
			});
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
	if(isset($_GET['update']))
	{
	include_once('dbconnect.inc.php');
	$userid=$_SESSION['fbid'];
	//aggiorniamo i dati nel db e confermiamo l'aggiornamento.
	
	$cemail=mysql_real_escape_string($_POST['cemail']);
	$tel=mysql_real_escape_string($_POST['tel']);
	
	if(isset($_POST['contact_mail']))
		$c_mail=1;
	else
		$c_mail=0;
	if(isset($_POST['contact_fb']))
		$c_fb=1;
	else
		$c_fb=0;
	if(isset($_POST['contact_tel']))
		$c_tel=1;
	else
		$c_tel=0;
	$scuola=mysql_real_escape_string($_POST['scuola']);
	if($scuola=="Altro")
		$scuola=mysql_real_escape_string($_POST['altro']);
		
	$sql = "UPDATE users 
	SET cfb= '$c_fb', cmail= '$c_mail', ctel= '$c_tel', telefono='$tel', scuola='$scuola', cemail='$cemail'
	WHERE FBID='$userid'";  
	$ires = mysql_query($sql) or die('Query failed: ' . mysql_error() . "<br>\n");
	if($ires)
		echo "<h2>Dati Aggiornati!</h2><br>";
	else
		echo "<h2>Errore nell'aggiornamento dati. Riprova più tardi.</h2><br>";
	}

	//prendo i dati dell'utente dal db e li inserisco nel form di modifica
	include_once "dbconnect.inc.php";
	$fbid=$_SESSION['fbid'];
	$sql="SELECT * FROM users WHERE FBID='$fbid'";
	$query=mysql_query($sql);
	$r=mysql_fetch_row($query);
	$cemail=$r[8];
	$scuola=$r[9];
	$tel=$r[10];
	$cfb=$r[11];
	$cmail=$r[12];
	$ctel=$r[13];

	$slctd=0;
?>
<div id="regdata">
<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>?update=1">
		<label>Che Scuola frequenti?</label>
		<select name="scuola" id="scuola">
			<option value="" ><strong>Scegli</strong></option>
			<option value="Respighi" <?php if($scuola=="Respighi"){$slctd=1; echo "selected";} ?>>Respighi</option>
			<option value="Gioia"<?php if($scuola=="Gioia"){$slctd=1; echo "selected";} ?>>Gioia</option>
			<option value="Colombini" <?php if($scuola=="Colombini"){$slctd=1; echo "selected";} ?>>Colombini</option>
			<option value="SanBenedetto" <?php if($scuola=="SanBenedetto"){$slctd=1; echo "selected";} ?>>San Benedetto</option>
			<option value="ISII" <?php if($scuola=="ISII"){$slctd=1; echo "selected";} ?>>ISII</option>
			<option value="Romagnosi" <?php if($scuola=="Romagnosi"){$slctd=1; echo "selected";} ?>>Romagnosi</option>
			<option value="Casali" <?php if($scuola=="Casali"){$slctd=1; echo "selected";} ?>>Casali</option>
			<option value="Cassinari" <?php if($scuola=="Cassinari"){$slctd=1; echo "selected";} ?>>Cassinari</option>
			<option value="Tramello" <?php if($scuola=="Tramello"){$slctd=1; echo "selected";} ?>>Tramello</option>
			<option value="Marconi" <?php if($scuola=="Marconi"){$slctd=1; echo "selected";} ?>>Marconi</option>
			<option value="Raineri-Marcora" <?php if($scuola=="Raineri-Marcora"){$slctd=1; echo "selected";} ?>>Raineri-Marcora</option>
			<option value="Altro" <?php if(!$slctd) echo "selected" ?>>Altro</option>
		</select>
		<?php 
		if(!$slctd) echo "<input type=\"text\" name=\"altro\" placeholder=\"scuola\" id=\"scuola_altro\" 
		value=\"$scuola\" style=\"display:inline;\">";
		else
			echo "<input type=\"text\" name=\"altro\" placeholder=\"scuola\" id=\"scuola_altro\" style=\"display:none;\">";
		?>
		<br>
		<label>Come vuoi essere contattato/a?</label>
		<br>
		<input type="checkbox" name="contact_tel" <?php if($ctel) echo "checked"; ?> >Telefono
		<input type="text" name="tel" value="<?php echo $tel; ?>">
		<br>
		<input type="checkbox" name="contact_fb" <?php if($cfb) echo "checked"; ?> >Facebook
		<br>
		<input type="checkbox" name="contact_mail" <?php if($cmail) echo "checked"; ?> >E-Mail
		<input type="text" name="cemail" value="<?php echo $cemail; ?>">
		<br>
		<input type="submit" value="Aggiorna Dati">
		
	</form>
	</div>
	<p style="font-style:italic; color: #EE0000;">Importante: se hai scelto di essere contattato via Facebook, ricorda di controllare la sezione "Altri" dei messaggi!!</p>
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
