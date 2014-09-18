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
	<!--fb social plugin-->
	<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=283750735145935&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
	<!--end fb social plugin-->
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
				<li class="active"><a href="<?php echo $base; ?>/contatti.php" accesskey="4" title="">Contatti</a></li>
<?php
ucp();
?>
				
			</ul>
		</div>
	</div>
	</div>
	
	<div id="page" class="container">
      <div class="title">
	    <span class="byline" id="tabtitle">Contatti</span>
	  </div>
	  <div>
		Aiutaci a migliorare sempre di più!
		<br>
		Per dubbi, domande, consigli e critiche puoi contattarci via mail a <a href="mailto:info@libriscuolapc.it">info@libriscuolapc.it</a>
		oppure sulla nostra <a href="https://www.facebook.com/libriscuolapc/">pagina facebook</a>
		<br>
		<br>
		<!--fb social plugin-->
		<div class="fb-like-box" data-href="https://www.facebook.com/libriscuolapc" data-width="700" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="false"></div>
		<!--end fb social plugin-->
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
