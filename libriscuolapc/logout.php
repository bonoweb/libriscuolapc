<?php
session_start();
unset($_SESSION['user']);  
//
/*unset($_SESSION['reg']);
unset($_SESSION['reg2']);*/
//
session_destroy();
header("Location:index.php");  
exit;
?>
