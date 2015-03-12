<?php session_start();


if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    die('No post.');
}
/* commented by Yousef ALharbi 7/10/2013 sit203 web programming assignment 3  */

$dbuser = "ynal"; /* your deakin login */
$dbpass = "212639"; /* your oracle access password */
$dbname = "SSID";
$db = ocilogon($dbuser, $dbpass, $dbname);




//populate from POST variables
ini_set('display_errors', 'On');
$firsname = htmlentities ($_POST['firstname']);
$surname = htmlentities ($_POST['surname']);
$email = htmlentities ($_POST['email']);
$phoneno = htmlentities ($_POST['phoneno']);
$address = htmlentities ($_POST['add']);
$suburb = htmlentities ($_POST['suburb']);
$postcode = htmlentities ($_POST['Postalcode']);
$creditcard = htmlentities ($_POST['creditcard']);
$expiredate = htmlentities ($_POST['expirydate']);
$holder = htmlentities ($_POST['holdername']);
$amount = htmlentities ( $_POST['amount']);
$date = htmlentities ($_POST['date']);

$ok=true;
//data validation 
if($firsname==""){echo "Firstname cannot be blank<br>";$ok=false;}
if($surname==""){echo "Surname cannot be blank<br>";$ok=false;}
if($address==""){echo "Address cannot be blank<br>";$ok=false;}
if($suburb==""){echo "Suburb cannot be blank<br>";$ok=false;}
if($postcode==""){echo "Postal Code cannot be blank<br>";$ok=false;}
if($phoneno==""){echo "Phone cannot be blank<br>";$ok=false;}
if (ereg('[^0-9]', $phone)) {echo"'Your Phone number does only have Numbers.please try again<br>";$ok=false;}
if($email==""){echo "Email cannot be blank<br>";$ok=false;}
if (!eregi("^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$", $email)) {
    echo'Your email address does not follow the correct format.<br>';$ok=false;
}
if($creditcard==""){echo "Credit Card No cannot be blank<br>";$ok=false;}
if (ereg('[^0-9]', $creditcard)) {echo"'Your credit card number must only have Numbers.please try again<br>";$ok=false;}
if($expiredate==""){echo "Expiry Date cannot be blank<br>";$ok=false;}
if($holder==""){echo "Card Holder cannot be blank<br>";$ok=false;}
if($amount<1){echo "Order total must be at least $1<br>";$ok=false;}


if ($ok==false){exit;}


$stid = oci_parse($db, 'SELECT * FROM orderdetails');
oci_execute($stid);
$maxid = 0;
while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {

    if ($maxid < $row[ID]) {
        $maxid = $row[ID];
    }
}

$maxid++;

$dbtable="register";
$salt="afdk4af6"; //salt is used here, which can be an arbitrary string
//insert hashing
$creditcard = md5($salt.$creditcard);
$holder = md5($salt.$holder);



$query = "insert into orderdetails(id,customerid,firstname,surname,address,suburb,postcode,email,phoneno,creditcardno,holdername,expiredate,amount,orderdate) values('$maxid','".$_SESSION['loginid']."','$firstname','$surname','$address','$suburb','$postacode','$email','$phoneno','$creditcard','$holder','$expiredate','$amount','" . date("d/m/Y") . "')";
$stmnt = OCIParse($db, $query);
$stmnt = OCIExecute($stmnt);
oci_commit($db);

foreach ($_SESSION['cart'] as $id => $qty) {

    $query = "insert into cart(orderid,itemid,qty) values('$maxid','$id','$qty')";
   
    $stmnt = OCIParse($db, $query);
    $stmnt = OCIExecute($stmnt);
    oci_commit($db);
    
}

unset($_SESSION['cart']);



echo "OK";

?>
