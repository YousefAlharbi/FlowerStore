<?php
session_start();



if ($_GET['action'] == 'logout') {
    session_unset();
    header( 'Location: myaccount.html' ) ;
}

$userid = $_SESSION['loginid'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title>Flower Shop</title>
<link rel="stylesheet" type="text/css" href="style.css" />
<script>
function showResult(str)
{
if (str.length==0)
  { 
  document.getElementById("livesearch").innerHTML="";
  document.getElementById("livesearch").style.border="0px";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("livesearch").innerHTML=xmlhttp.responseText;
    document.getElementById("livesearch").style.border="1px solid #A5ACB2";
    }
  }
xmlhttp.open("GET","livesearch.php?q="+str,true);
xmlhttp.send();
}
</script>
</head>
<!--     
        commented by Yousef ALharbi 7/10/2013
		sit203 web programming assignment 1
		Student Name : Yousef ALharbi
		Student Id :212390239

         Deakin University, School of Information Technology. 
		 This web page has been developed as a student assignment for the unit SIT203:
		 Web Programming. Therefore it is not part of the University's authorised web 
		 site. DO NOT USE THE INFORMATION CONTAINED ON THIS WEB PAGE IN ANY WAY.      

		 -->
<body>
<div id="wrap">

       <div class="header">
       		<div class="logo"><a href="index.html"><img src="images/logo.gif" alt="" title="" border="0" /></a></div>            
        <div id="menu">
            <ul>                                                                       
            <li><a href="index.html">home</a></li>
            <li><a href="about.html">about us</a></li>
            <li><a href="category.html">flowers</a></li>
            <li><a href="search.html">search</a></li>
            <li class="selected"><a href="myaccount.html">my account</a></li>
            <li><a href="register.html">register</a></li>
			<li><a href="order.php">order</a></li>
			<li><a href="catalogue.xml">catalogue</a></li>
            <li><a href="contact.php">contact us</a></li>
            </ul>
        </div>     
            
            
       </div> 
       
       
    <div class="center_content">
       	<div class="left_content">
            <div class="title"><span class="title_icon"><img src="images/bullet1.gif" alt="" title="" /></span>My account</div>
        
        	<div class="feat_prod_box_details">
            <p class="details">
            
           
              	<div class="contact_form">
               

<?php



$dbuser = "ynal"; /* your deakin login */
$dbpass = "212639"; /* your oracle access password */
$dbname = "SSID";
$db = ocilogon($dbuser, $dbpass, $dbname);

$stmt = oci_parse($db, "SELECT * FROM register where id = $userid");
oci_execute($stmt);
$user = oci_fetch_array($stmt, OCI_ASSOC + OCI_RETURN_NULLS);

?>

<?php

echo "Welcom $user[FIRSTNAME] $user[SURNAME]! <a href='myaccount.php?action=logout'>logout</a>";
?>

<?php

//disply Register success message
if ($_GET['action'] == 'registerSuccess') {

    echo "<h3 style='color:green;'> Your registration successfull</h3>";
}

//disply order success message
if ($_GET['action'] == 'orderSuccess') {

    echo "<h3 style='color:green;'> Your Order Was successfuly placed</h3>";
}


?>

<h3><a href="order.php">Make New Order</a> </h3>



<h3>My Details</h3>
<?php
echo "$user[FIRSTNAME] $user[SURNAME]<br/>";
echo "$user[ADDRESS] $user[SUBURB]<br/>";
echo "$user[POSTCODE]<br/>
$user[PHONENO]<br/>";
?>     

<h3>My Previous Orders</h3>
        <table border="1" width="300" >
            <tr>
                <td>ORDER ID</td>
                <td>DATE</td>                
                <td>TOTAL</td>
            </tr>
            <?php
            $stmt = oci_parse($db, "SELECT * FROM orderdetails where customerid = $loginid order by id");
oci_execute($stmt);
            while ($row = oci_fetch_array($stmt, OCI_ASSOC + OCI_RETURN_NULLS)) {
                // print_r($row);


                echo "<tr> 
        <td>$row[ID]</td>
        <td>$row[ORDERDATE]</td>
        
        <td>$$row[AMOUNT]</td>
    </tr>
    ";
            }





            /*
             * To change this template, choose Tools | Templates
             * and open the template in the editor.
             */
            ?>
        </table>

      </table> 
				
				
				
                    
                    
                </div>  
            
            </div>	
            
              
            
              

            

            
        <div class="clear"></div>
        </div><!--end of left content-->
        
        <div class="right_content">
        	<div class="languages_box">
            <span class="red">Languages:</span>
            
            <img src="images/au.gif" alt="" title="" border="0" height="12px" width="15px"/>
            <!-- commented by Shang 09/07/2013 
            <a href="#" class="selected"><img src="images/gb.gif" alt="" title="" border="0" /></a>
            <a href="#"><img src="images/de.gif" alt="" title="" border="0" /></a> -->
            </div>
			<div class="currency">
                <span class="red">Currency: </span>
                <!-- commented by shang 09/07/2013 
                <a href="#">GBP</a>
                <a href="#">EUR</a> -->
				
                <a href="" class="selected">AUD</a>
                </div>
          
				
				<!-- live search start -->
				<div class="form_row">
				 <form name="register" action="livesearch.php">  
                <input type="text" id="name" name="name""class="contact_input" size="30" onkeyup="showResult(this.value)" />
                 <input type="submit" class="register" value="Search" />
                <div id="livesearch"></div>

                   </form>
                    
					</div> 
                <!-- live search start -->
                
                 <!-- start Cart  -->
					<div class="cart">
                  <div class="title"><span class="title_icon"><img src="images/cart.gif" alt="" title="" /></span>My cart</div>

                  <a href="cart.php" class="view_cart">view cart</a>
                  <a href="myaccount.php" class="view_cart">My Account</a>
              
              </div>
				<!-- end cart -->	
            
			   		
        
        
             <div class="title"><span class="title_icon"><img src="images/bullet3.gif" alt="" title="" /></span>About Our Shop</div> 
             <div class="about">
             <p>
             <img src="images/about.gif" alt="" title="" class="right" />
             Flowershop is a Member of an International award winning network of skilled professional Florists which provide fabulous floral designs for all occasions.We buy Fresh flowers daily to ensure that you - our most valued customers and your clients, family or friends are completely satisfied when receiving our fresh long lasting floral arrangements
			  
             </p>
             
             </div>
             
             <div class="right_box">
             
             	<div class="title"><span class="title_icon"><img src="images/bullet4.gif" alt="" title="" /></span>Promotions</div> 
                    <div class="new_prod_box">
					<a href="Orchids.html">La Luna</a>
                        <div class="new_prod_bg">
                        <span class="new_icon"><img src="images/promo_icon.gif" alt="" title="" /></span>
                        <a href="Orchids.html"><img src="images/370.jpg" alt="" title="" class="thumb" border="0" /></a>
                        </div>           
                    </div>
                    
                    <div class="new_prod_box">
                        <a href="Gerberas.html">Sweetness</a>
                        <div class="new_prod_bg">
                        <span class="new_icon"><img src="images/promo_icon.gif" alt="" title="" /></span>
                        <a href="Gerberas.html"><img src="images/378.jpg" alt="" title="" class="thumb" border="0" /></a>
                        </div>           
                    </div> 
                    
                                    
                    <!-- commented by Shang 09/07/2013 
                    <div class="new_prod_box">
                        <a href="details.html">product name</a>
                        <div class="new_prod_bg">
                        <span class="new_icon"><img src="images/promo_icon.gif" alt="" title="" /></span>
                        <a href="details.html"><img src="images/thumb3.gif" alt="" title="" class="thumb" border="0" /></a>
                        </div>           
                    </div> -->             
             
             </div>
             
             <div class="right_box">
            
             	<div class="title"><span class="title_icon"><img src="images/bullet5.gif" alt="" title="" /></span>Flowers Type</div> 
                
                <ul class="list">
                <li><a href="bouquets.html">Bouquets</a></li>
                <li><a href="Arrangements.html">Arrangements</a></li>
                <li><a href="Boxes.html">Boxes</a></li>
                <li><a href="Baskets.html">Baskets</a></li>
                <li><a href="Hampers.html">Hampers</a></li>
                <li><a href="Roses.html">Roses</a></li>
                <li><a href="lilies.html">lilies</a></li>
                <li><a href="Gerberas.html">Gerberas</a></li>
                <li><a href="Tropical.html">Tropical</a></li>
                <li><a href="Orchids.html">Orchids</a></li>                                             
                </ul>
                
                <!-- commented by Shang 09/07/2013 
             	<div class="title"><span class="title_icon"><img src="images/bullet6.gif" alt="" title="" /></span>Partners</div> 
                
                <ul class="list">
                <li><a href="#">accesories</a></li>
                <li><a href="#">flower gifts</a></li>
                <li><a href="#">specials</a></li>
                <li><a href="#">hollidays gifts</a></li>
                <li><a href="#">accesories</a></li>
                <li><a href="#">flower gifts</a></li>
                <li><a href="#">specials</a></li>
                <li><a href="#">hollidays gifts</a></li>
                <li><a href="#">accesories</a></li>                              
                </ul>  -->    
             
             </div>         
             
        
        </div><!--end of right content-->
        
        
       
       
       <div class="clear"></div>
       </div><!--end of center content-->
       
              
       <div class="footer">
	    
       	<div class="left_footer"><img src="images/footer_logo.gif" alt="" title="" /><br /> <a href="http://csscreme.com/freecsstemplates/" title="free templates"><img src="images/csscreme.gif" alt="free templates" title="free templates" border="0" /></a></div>
        <p class="details">©Deakin University, School of Information Technology. 
		 This web page has been developed as a student assignment for the unit SIT203:
		 Web Programming. Therefore it is not part of the University's authorised web 
		 site. DO NOT USE THE INFORMATION CONTAINED ON THIS WEB PAGE IN ANY WAY.</p>
		<div class="right_footer">
        <a href="index.html">home</a>
        <a href="about.html">about us</a>
        <a href="category.html">flowers</a>
        <a href="term.html">terms and conditions</a>
        <a href="contact.php">contact us</a>
       
        </div>
        
       
       </div>
    

</div>

</body>
</html>