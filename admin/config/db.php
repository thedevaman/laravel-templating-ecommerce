<?php

session_start();
ob_start();
$db_host		= 'localhost';
$db_user		= 'root';
$db_pass		= '';
$db_database	= 'kashi'; 

/* End config */

$conn = new PDO('mysql:host='.$db_host.';dbname='.$db_database, $db_user, $db_pass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

date_default_timezone_set('Asia/Kolkata');
include('include/classes/Login.php');
$db = new Main($conn);
?>