<?php session_start();

//insert htmlentities to protect from XSS Attack 
$username = htmlentities ($_POST['username']);
$password = htmlentities ($_POST['password']);

$ok=true;

// Data Validation
if(empty ($username)){echo "Username cannot be blank<br />";$ok=false;}
if(empty ($password)){echo "Password cannot be blank<br />";$ok=false;}
if($ok==false){exit;}

$dbtable="register";
$salt="afdk4af6"; //salt is used here, which can be an arbitrary string
//insert hashing
$password = md5($salt.$password);

$dbuser = "ynal"; /* your deakin login */
$dbpass = "212639"; /* your oracle access password */
$dbname = "SSID";
$db = ocilogon($dbuser, $dbpass, $dbname);

if (!$db) {
    echo "An error occurred connecting to the database";
    exit;
}
$stid = oci_parse($db, "SELECT * FROM register where username='$username' and password='$password'" );
oci_execute($stid);
$row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);

if ($row[ID] > 0) {
      $_SESSION['loginid']=$row['ID'];
    echo "ok";
    exit;
    
}
else {
    die("login Problem.Please enter again ");
}
    
    
    

/*
 * commented by Yousef ALharbi 7/10/2013
 */
?>
