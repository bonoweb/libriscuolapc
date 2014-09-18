<?php

//questo serve solo se non è ancora stato settato $_SESSION['user'], cioè
//l'utente non si è ancora autenticato al sito. Se è già autenticato siamo a posto.
if(!isset($_SESSION['user'])) 	
{
	//fb app
	
	 $app_id        = "YOUR-APP-ID";  
    $app_secret    = "YOUR-APP-SECRET"; 
    $site_url      = "http://SITEURL.COM/";  
	include "src/facebook.php";  
	$facebook = new Facebook(array(  
		'appId'    => $app_id,  
		'secret'    => $app_secret,  
		));
	$user = $facebook->getUser();  

	if($user){  // -->utente già collegato a facebook
    // Get logout URL 
    $logoutUrl = $facebook->getLogoutUrl();  
	}else{
    // Get login URL
    $loginUrl = $facebook->getLoginUrl(array(  
	'scope'           => 'email',  
	'redirect_uri'    => $site_url,  
	));  
	}	  

	if($user){  // -->utente già collegato a facebook
		$user_profile = $facebook->api('/me');  
		
		//DEBUG: 
		//print_r($user_profile);
		
		include_once "./dbconnect.inc.php";
		 
		$name ="'".$user_profile['name']."'";  
		if(isset($user_profile['email']))
			$email ="'".$user_profile['email']."'";
		else
			$email=NULL;
		$gender ="'".$user_profile['gender']."'";
		$first_name="'".$user_profile['first_name']."'";
		$last_name="'".$user_profile['last_name']."'";
		$fblink="'".$user_profile['link']."'";
		$fbid="'".$user_profile['id']."'";
		if(isset($user_profile['education']))
			$school="'".$user_profile['education'][0]['school']['name']."'";
	    else
			$school=false;
		
		  
		$query = "SELECT * FROM users WHERE FBID =".$fbid;
		$res = mysql_query($query) or die('Query failed: ' . mysql_error() . "<br>\n$sql");  
		if(mysql_num_rows($res) == 0)  
		{  
			//registro l'utente nel db --> ridirezionandolo a registrazione.php
			$_SESSION['reg']=1;
			$_SESSION['fbid']=$user_profile['id'];
			$_SESSION['name']=$user_profile['name'];
			if(isset($user_profile['email']))
				$_SESSION['email']=$user_profile['email'];
			else
				$_SESSION['email']=NULL;
			$_SESSION['gender']=$user_profile['gender'];
			$_SESSION['first_name']=$user_profile['first_name'];
			$_SESSION['last_name']=$user_profile['last_name'];
			$_SESSION['fblink']=$user_profile['link'];
			if(isset($user_profile['education']))
				$_SESSION['school']=$user_profile['education']['school']['name'];
			else
				$_SESSION['school']=false;
			
			header('Location: registrazione.php');
			exit;
			//$iquery = sprintf("INSERT INTO newmember values('',%s,%s,%s,%s,'yes')",$name,$email,$gender,$bio);  
			//$ires = mysql_query($iquery) or die('Query failed: ' . mysql_error() . "<br>\n$sql");  
			//$_SESSION['user'] = $user_profile['email'];  
		}  
		else  
		{  
			// utente già nel db, lo autentico settando user
			$row = mysql_fetch_array($res);  
			$_SESSION['user'] = $row['FBID'];//FBID al posto di email
			$_SESSION['nome']=$row['nome'];
			$_SESSION['cognome']=$row['cognome'];  
			$_SESSION['fbid']=$row['FBID'];
		}  
	}
}
?>
