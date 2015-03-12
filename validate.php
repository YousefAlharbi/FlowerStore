<?php
ini_set('display_errors',1);



if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    die('No post.');
}

//Person First name

$firstname = (string) $_POST['firstname'];
if (empty($firstname)) {
    echo ('Your First Name Cannot be blank.<br/>');
}

if (ereg('[^A-Za-z]', $firstname)) {
    echo ('Your First Name does only have letters only. Sorry, please try again!<br/>');
}
//echo sprintf('Your Book Title "%s"
//looks valid. Thank you!', $booktitle);
//Person Surname

$surname = (string) $_POST['surname'];
if (empty($surname)) {
    echo('Your Last Name Cannot be blank
<br/>');
}

if (ereg('[^A-Za-z]', $surname)) {
    echo('Your Last Name does only have letters only. Sorry, please try again!<br/>');
}
//echo sprintf('Your Book Title "%s"
//looks valid. Thank you!', $booktitle);
// Your Address
$add = (string) $_POST['add'];
if (empty($add)) {
    echo('Your Address Cannot be blank. Please go
<a href="javascript:history.back(-1);">back</a>.');
}

if (ereg('[^A-Za-z0-9]', $add)) {
    echo('Your Address does only have letters only. Sorry, please try again!');
}
//echo sprintf('Your Book Title "%s"
//looks valid. Thank you!', $booktitle);
// suburb
$suburb = (string) $_POST['suburb'];
if (empty($suburb)) {
    die('Your suburb Cannot be blank. Please go
<a href="javascript:history.back(-1);">back</a>.');
}

if (ereg('[^A-Za-z]', $suburb)) {
    die('Your suburb does only have letters only. Sorry, please try again!');
}
//echo sprintf('Your Book Title "%s"
//looks valid. Thank you!', $booktitle);
//echo sprintf('Your Book Title "%s"
//looks valid. Thank you!', $booktitle);
//Post Code

$postcode = (string) $_POST['postcode'];
if (empty($postcode)) {
    die('Your Address PostCode Cannot be blank. Please go
<a href="javascript:history.back(-1);">back</a>.');
}

if (ereg('[^0-9]', $postcode)) {
    die('Your Address Post Code does only have Numbers only. Sorry, please try again!');
}
//echo sprintf('Your Book Title "%s"
//looks valid. Thank you!', $booktitle);
//phone number

$phone = (string) $_POST['phone'];
if (empty($phone)) {
    die('Your Address phone Cannot be blank. Please go
<a href="javascript:history.back(-1);">back</a>.');
}

if (ereg('[^0-9]', $phone)) {
    die('Your Address Phone number does only have Numbers only. Sorry, please try again!');
}
//echo sprintf('Your Book Title "%s"
//looks valid. Thank you!', $booktitle);
// Your Email
$email = (string) $_POST['email'];
if (empty($email)) {
    die('You did not enter anything. Please go
<a href="javascript:history.back(-1);">back</a>.');
}
if (!eregi("^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$", $email)) {
    die('Your email address does not follow the
basic format. Sorry, please try again!');
}
//echo sprintf('Your email address "%s"
//looks valid. Thank you!', $email);
//card number

$card = (string) $_POST['card'];
if (empty($card)) {
    die('Your Card number Cannot be blank. Please go
<a href="javascript:history.back(-1);">back</a>.');
}

if (ereg('[^0-9]', $card)) {
    die('Your card number does only have Numbers only. Sorry, please try again!');
}
//echo sprintf('Your Book Title "%s"
//looks valid. Thank you!', $booktitle);
//Card Holder Name 
$holdername = (string) $_POST['holdername'];
if (empty($holdername)) {
    die('Credit Card Holder Name Cannot be blank. Please go
<a href="javascript:history.back(-1);">back</a>.');
}

if (ereg('[^A-Za-z]', $holdername)) {
    die('Card Holder name does only have letters only. Sorry, please try again!');
}

// Delivey Address
$daddress = (string) $_POST['daddress'];
if (empty($daddress)) {
    die('Your Delivey Address Cannot be blank. Please go
<a href="javascript:history.back(-1);">back</a>.');
}

if (ereg('[^A-Za-z0-9]', $daddress)) {
    die('Your Delivery Address does only have Numbers and letters only. Sorry, please try again!');
}
$book = (string) $_POST['book'];
if (empty($book)) {
    die('Your book Cannot be blank. Please go
<a href="javascript:history.back(-1);">back</a>.');
}

if (ereg('[^A-Za-z]', $book)) {
    die('Your book does only have letters only. Sorry, please try again!');
}
$bnumber = (string) $_POST['bnumber'];
if (empty($bnumber)) {
    die('Your Address bnumber Cannot be blank. Please go
<a href="javascript:history.back(-1);">back</a>.');
}

if (ereg('[^0-9]', $bnumber)) {
    die('Your Address bnumberdoes only have Numbers only. Sorry, please try again!');

//echo sprintf('Your Book Title "%s"
//looks valid. Thank you!', $booktitle);
}
?>

<html>
    <body>
        The Form Validate Successfully :<br/>



        Customer Order Details :<br/>

        First Name :<?php echo $_POST["firstname"]; ?> <br/>
        Last Name	:<?php echo $_POST["surname"]; ?> <br/>
        Address  	:<?php echo $_POST["address"]; ?><br />
        suburb	 	:<?php echo $_POST["suburb"]; ?> <br/>
        Post Code  	:<?php echo $_POST["postcode"]; ?><br />
        Email 		:<?php echo $_POST["email"]; ?> <br/>
        Delivery Address 	:<?php echo $_POST["daddress"]; ?> <br/>

        Payment Details : <br/>

        Card Holder Name :<?php echo $_POST["holdername"]; ?> <br/>
        Card Number :<?php echo $_POST["card"]; ?> <br/>
        Expaire Date : <?php echo $_POST[""]; ?> <br/>
    </body>
</html> 

