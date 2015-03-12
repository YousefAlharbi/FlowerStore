<?php

session_start();




if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    die('No post.');
}

//commented by Yousef ALharbi 20/08/2013 sit203 web programming assignment 3

//populate from POST variables
//insert htmlentities to protect from XSS Attack 
$password = htmlentities ($_POST['password']);
$email = htmlentities ($_POST['email']);
$phone = htmlentities ($_POST['phoneno']);
$address = htmlentities ($_POST['address']);
$suburb = htmlentities ($_POST['suburb']);
$postcode = htmlentities ($_POST['Postcode']);
$firstName = htmlentities ($_POST['firstName']);
$surname = htmlentities($_POST['surname']);


$ok = true;
//data validation
if (empty($username)) {echo ('Your Usename Cannot be blank.<br/>');$ok = false;}
if (empty($password)) {echo ('Your Password Cannot be blank.<br/>');$ok = false;}
if (empty($email)) {echo ('Your Email Cannot be blank.<br/>');$ok = false;}
if (!eregi("^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$", $email)) {
    echo'Your email address does not follow the correct format.<br>';$ok=false;
}
if (empty($firstName)) {echo ('Your First Name Cannot be blank.<br/>');$ok = false;}
if (empty($surname)) {echo ('Your Surname Cannot be blank.<br/>');$ok = false;}
if (empty($address)) {echo ('Your Address Cannot be blank.<br/>');$ok = false;}
if (empty($postcode)) {echo ('Your Postcode Cannot be blank.<br/>');$ok = false;}
if (empty($suburb)) {echo ('Your Suburb Cannot be blank.<br/>');$ok = false;}
if (empty($phone)) {echo ('Your Phone Cannot be blank.<br/>');$ok = false;}
if (ereg('[^0-9]', $phone)) {echo('You Phone number does only have Numbers only. please try again<br/>');$ok = false;}


if ($ok == false){exit;}

$dbuser = "ynal"; /* your deakin login */
$dbpass = "212639"; /* your oracle access password */
$dbname = "SSID";
$db = ocilogon($dbuser, $dbpass, $dbname);

$dbtable="register";
$salt="afdk4af6"; //salt is used here, which can be an arbitrary string

if (!$db) {
    echo "An error occurred connecting to the database";
    exit;
}


//check usename exsist
$stid = oci_parse($db, "SELECT * FROM register where username='$username'");
oci_execute($stid);
$row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);

if ($row[ID] > 0) {
    die("Sorry this usename is already registered");
    $ok = false;
}


//check email exsist
$stid = oci_parse($db, "SELECT * FROM register where email='$email'");
oci_execute($stid);
$row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);

if ($row[ID] > 0) {
    die("Sorry this email is already registered");
    $ok =false;
}





//get next id
$stid = oci_parse($db, 'SELECT * FROM register');
oci_execute($stid);
$maxid = 0;
while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {

    if ($maxid < $row[ID]) {
        $maxid = $row[ID];
    }
}

$maxid++;
//insert hashing
$password = md5($salt.$password);
//insert record 
$query = "
insert into register (id,username,password,email,phoneno,address,suburb,postcode,firstname,surname) 
values('$maxid','$username','$password','$email','$phoneno','$address','$suburb','$postcode','$firstName','$surname')";

$stmnt = OCIParse($db, $query);
$stmnt = OCIExecute($stmnt);
oci_commit($db);


$stid = oci_parse($db, 'SELECT * FROM register');
oci_execute($stid);
$maxid = 0;
while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {

    if ($maxid < $row[ID]) {
        $maxid = $row[ID];
    }
}


$_SESSION['loginid'] = $maxid;

echo OK;










