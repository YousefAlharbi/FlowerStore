<?php
// ---------------------------------------------------------------- //
// DATABASE CONNECTION PARAMETER //
// ---------------------------------------------------------------- //
// Modify global-connect.inc.php with your DB connection parameters or add them //
// directly below //
////commented by Yousef ALharbi 20/08/2013 sit203 web programming assignment 3
//include('global-connect.inc.php');

/* Set oracle user login and password info */
$dbuser = "ynal"; /* your deakin login */
$dbpass = "212639"; /* your deakin password */
$dbname = "SSID"; 
$db = OCILogon($dbuser, $dbpass, $dbname);

if (!$db) {
echo "An error occurred connecting to the database"; 
exit; 
}


// ---------------------------------------------------------------- //
// SET PHP VAR - CHANGE THEM //
// ---------------------------------------------------------------- //
// You can use these variables to define Query Search Parameters: //

// $SQL_FROM: is the FROM clausule, you can add a TABLE: books ...//

// $SQL_WHERE is the WHER clausule, you can add an table //
// field for example title //


$SQL_FROM = 'books';
$SQL_WHERE = 'title';

$searchq = strip_tags($_GET['q']);
$sql = "
    SELECT * FROM ".$SQL_FROM." WHERE UPPER(".$SQL_WHERE.") LIKE UPPER( '".$searchq."%')";

$stmt = OCIParse($db, $sql);

if(!$stmt) {
echo "An error occurred in parsing the sql string.\n";
exit;
}
OCIExecute($stmt);

$output[] = '<ul>';

while(OCIFetch($stmt)) {

$title= OCIResult($stmt,"TITLE");
$id= OCIResult($stmt,"ID");
$output[] = '<li><small>'.$title.'<a href="cart.php?action=add&id='.$id.'">Add to cart</a>';
}
$output[] = '</ul>';
echo join('',$output);

?>
