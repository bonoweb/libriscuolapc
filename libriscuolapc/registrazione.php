<?php
session_start();
//print_r($_SESSION);
if(!isset($_SESSION['reg'])){
	header('Location: index.php');
	exit;
}
include_once "functions.inc.php";
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
				<!--<li><a href="#" accesskey="5" title="">Contact Us</a></li>-->				
			</ul>
			</div>
		</div>
	</div>

	<div id="page" class="container">
	<?php
	$fbid=$_SESSION['fbid'];
	$name=$_SESSION['name'];
	$email=$_SESSION['email'];
	$gender=$_SESSION['gender'];
	$first_name=$_SESSION['first_name'];
	$last_name=$_SESSION['last_name'];
	$fblink=$_SESSION['fblink'];
	$school=$_SESSION['school'];
	
if(isset($_SESSION['reg2'])&&isset($_POST['reg2']))
{
	//step2
	
	include_once('dbconnect.inc.php');
	
	/*$name=$_SESSION['name'];
	$email=$_SESSION['email'];
	$gender=$_SESSION['gender'];
	$first_name=$_SESSION['first_name'];
	$last_name=$_SESSION['last_name'];
	$fblink=$_SESSION['fblink'];
	$school=$_SESSION['school'];*/
	
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
	if($scuola=="")
		$scuola=mysql_real_escape_string($_POST['altro']);
		
	$iquery = "INSERT INTO users values('','$first_name','$last_name',NOW(),'$fbid','$fblink','$gender','$email','$cemail','$scuola','$tel','$c_fb','$c_mail','$c_tel')";  
	$ires = mysql_query($iquery) or die('Query failed: ' . mysql_error() . "<br>\n");
	if($ires)
		echo "<h2>Registrazione Completata!</h2><br>
		<a href=\"".$base."/index.php\">Homepage</a> - <a href=\"".$base."/sell.php\">Vendi un Libro</a>";
	$_SESSION['user'] = $fbid;
	unset($_SESSION['reg']);
	unset($_SESSION['reg2']);
}
else
{
	
	//chiedo ulteriori info
	//scuola
	//come essere contattato
	
	$_SESSION['reg2']=1;
	?>
	<p>Un paio di domande per registrarti...</p>
	<div id="regdata">
	<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
		<label>Che Scuola frequenti?</label>
		<select name="scuola" id="scuola">
			<option value=""><strong>Scegli</strong></option>
			<option value="Respighi">Respighi</option>
			<option value="Gioia">Gioia</option>
			<option value="Colombini">Colombini</option>
			<option value="SanBenedetto">San Benedetto</option>
			<option value="ISII">ISII</option>
			<option value="Romagnosi">Romagnosi</option>
			<option value="Casali">Casali</option>
			<option value="Cassinari">Cassinari</option>
			<option value="Tramello">Tramello</option>
			<option value="Marconi">Marconi</option>
			<option value="Raineri-Marcora">Raineri-Marcora</option>
			<option value="Altro">Altro</option>
		</select>
		<input type="text" name="altro" placeholder="scuola" id="scuola_altro" style="display:none;">
		<br>
		<label>Come vuoi essere contattato/a?</label>
		<br>
		<input type="checkbox" name="contact_tel">Telefono
		<input type="text" name="tel" value="">
		<br>
		<input type="checkbox" name="contact_fb" checked>Facebook
		<br>
		<input type="checkbox" name="contact_mail">E-Mail
		<input type="text" name="cemail" value="<?php echo $email; ?>">
		<br>
		 <input type="hidden" name="reg2" value="1"> 
		 <span style="font-size:0.8em;">Registrandoti accetti i <a href="terms.php">termini e condizioni</a> e <a href="privacy.php">l'informativa sulla privacy</a></span>
		 <br>
		<input type="submit" value="Invia!">
	</form>
	</div>
	
<?php
}
?>
	</div> <!--end div page-->
</div> <!--end wrapper-->
<?php
footer();
?>

</body>
</html>
