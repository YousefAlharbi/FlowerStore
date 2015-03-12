<?
session_start();

$dbuser = "ynal"; /* your deakin login */
$dbpass = "212639"; /* your oracle access password */
$dbname = "SSID";
$db = ocilogon($dbuser, $dbpass, $dbname);

//commented by Yousef ALharbi 20/08/2013 sit203 web programming assignment 3
$gandtotal = 0;
foreach ($_SESSION['cart'] as $id => $qty) {

    $sql = "SELECT * FROM books where id = $id";
    $stmt = OCIParse($db, $sql);

    if (!$stmt) {
        echo "An error occurred in parsing the sql string.\n";
        exit;
    }

    OCIExecute($stmt);
    OCIFetch($stmt);
    $price = OCIResult($stmt, "PRICE");
    $total = $price * $qty;
    $grandtotal = $total + $grandtotal;
}





$loginid = $_SESSION['loginid'];


if (!$db) {
    echo "An error occurred connecting to the database";
    exit;
}
$stid = oci_parse($db, "SELECT * FROM register where id = '$loginid'");
OCIExecute($stid);

//(OCIFetch($stid));
$row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);

$stid = oci_parse($db, "SELECT * FROM register where id = '$loginid'");
OCIExecute($stid);

//(OCIFetch($stid));
$row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS);
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
 <script type="text/javascript">

            function validate(str) 
            {
    
                var form=document.forms["order"];
                var firstname =form.firstname.value;
                var surname =form.surname.value;
                var add =form.add.value;
                // alert(add); return;
                var subburb=form.suburb.value;
                var Postalcode=form.Postalcode.value;
                var phoneno=form.phoneno.value;
                var email=form.email.value;
                var creditcard=form.creditcard.value;
                var expirydate=form.expirydate.value;
                var holdername=form.holdername.value;
                var phoneno=form.phoneno.value;
                var amount=form.amount.value;
		
		
		
		
     
    
    
    

                if (str == "0") { document.getElementById("txtHint").innerHTML=""; return;}
                if (window.XMLHttpRequest) xmlhttp=new XMLHttpRequest();
                else { xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");}

                xmlhttp.onreadystatechange=process;
                xmlhttp.open("POST","ordersubmit.php", true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send("firstname="+firstname +"&surname="+surname+"&add="+add+"&suburb="+subburb+"&Postalcode="+Postalcode+"&phoneno="+phoneno+"&email="+email+"&creditcard="+creditcard+"&expirydate="+expirydate+"&phoneno="+phoneno+"&holdername="+holdername+"&amount="+amount);



            }

            function process() {

                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
                {
                     if(xmlhttp.responseText=="OK"){window.location="myaccount.php?action=orderSuccess";}
                    document.getElementById("error").innerHTML = xmlhttp.responseText;
                    // alert( xmlhttp.responseText);
                }
            }

        </script>


</head>
<!--     
        commented by Yousef ALharbi 20/08/2013
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
            <li><a href="myaccount.html">my account</a></li>
			<li><a href="register.html">register</a></li>
            <li class="selected"><a href="order.php">order</a></li>
			<li><a href="catalogue.xml">catalogue</a></li>
            <li><a href="contact.php">contact us</a></li>
            </ul>
        </div>     
            
            
       </div> 
       
       
       <div class="center_content">
       	<div class="left_content">
            <div class="title"><span class="title_icon"><img src="images/bullet1.gif" alt="" title="" /></span>checkout for your order</div>
        
        	<div class="feat_prod_box_details">
           <p class="details">
                            Please enter the details given below in order to make an order. This will help you to trade with us much easier and quikly. Fill out the form and click on order to make your order.
                        </p>
                        <div class="contact_form">
                            <div class="form_subtitle">Your Details</div>
                            <form name="order" action="#"> 
                                
                                <div class="form_row">
                                    <label class="contact"><strong>first name:
                                        </strong></label>
                                    <input type="text" name="firstname" value="<?php echo $row["FIRSTNAME"] ?>" id="firstname" class="contact_input" />

                                </div>

                                <div class="form_row">
                                    <label class="contact"><strong>surname:
                                        </strong></label>

                                    <input type="text" name="surname" value="<?php echo $row["SURNAME"] ?>" id="surname"  class="contact_input" />
                                </div> 

                                <div class="form_row">
                                    <label class="contact"><strong>address 
                                            :</strong></label>
                                    <input type="text" name="add" id="add" value="<?php echo $row["ADDRESS"] ?>" class="contact_input" />
                                </div>

                                <div class="form_row">
                                    <label class="contact"><strong>suburb </strong>
                                    </label>
                                    <input type="text" name="suburb" id="suburb" value="<?php echo $row["SUBURB"] ?>" class="contact_input" />
                                </div>


                                <div class="form_row">
                                    <label class="contact"><strong>postal code
                                        </strong>
                                    </label>
                                    <input type="text" name="Postalcode" id="postalcode" value="<?php echo $row["POSTCODE"] ?>" class="contact_input" />
                                </div>

                                <div class="form_row">
                                    <label class="contact"><strong>phone no:
                                        </strong></label>
                                    <input type="text" name="phoneno" id="phoneno" value="<?php echo $row["PHONENO"] ?>" class="contact_input" />
                                </div>

                                <div class="form_row">
                                    <label class="contact"><strong>email:
                                        </strong> </label>
                                    <input type="text" name="email" id="email" value="<?php echo $row["EMAIL"] ?>" class="contact_input" />
                                </div>                    

                                <div class="form_row">
                                    <label class="contact"><strong>
                                            credit card no:</strong></label>
                                    <input type="text" name="creditcard" id="creditcard" class="contact_input" />
                                </div> 

                                <div class="form_row">
                                    <label class="contact"><strong>expiry date:					                    </strong></label>
                                    <input type="text" name="expirydate" id="expirydate" class="contact_input" />
                                </div> 


                                <div class="form_row">
                                    <label class="contact"><strong>card holder 					                    name:</strong></label>
                                    <input type="text" name="holdername" id="holder" class="contact_input" />
                                </div> 

                                <div class="form_row">
                                    <label class="contact"><strong>				                    Amount AUD: </strong></label>
                                    <input type="text" name="amount" id="amount" disabled value="<?php echo $grandtotal ?>" class="contact_input" />
                                </div> 
                                
                             







                                <div class="form_row">
                                    <input type="button" class="order" value="order" onclick="validate()" />
                                </div>
                                
                                <div id ="error" style="color:red"></div>
                            </form> 


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
				 <form>
                 <input type="text" size="30" onkeyup="showResult(this.value)">
                 <input type="submit" class="register" value="Search" />
                <div id="livesearch"></div>

                   </form>
                    
					</div> 
                <!-- live search start -->
                
                
            
			   		
        
        
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