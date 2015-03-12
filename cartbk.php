<?php session_start();

if($_GET['action']=='add'){
   $_SESSION['cart'][$_GET['id']]++;
   foreach ($_SESSION['cart'] as $id => $qty) {
       echo  "$id $qty <br>";
   }
 
    
}elseif($_GET['action']=='del'){
       unset($_SESSION['cart'][$_GET['id']]);
          foreach ($_SESSION['cart'] as $id => $qty) {
       echo  "$id $qty <br>";
   }
}

elseif($_GET['action']=='update'){
       $_SESSION['cart'][$_GET['id']]=$_GET['qty'];
          foreach ($_SESSION['cart'] as $id => $qty) {
       echo  "$id $qty <br>";
   }
}
//session_unset();
//commented by Yousef ALharbi 20/08/2013 sit203 web programming assignment 3

?>

