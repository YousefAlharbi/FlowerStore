<?php
	session_start();
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
    
    var form=document.forms["register"];
    var username =form.username.value;
    var password = form.password.value;
    var email = form.email.value;
    var phoneno = form.phoneno.value;
    var firstName = form.firstName.value;
    var surname = form.surname.value;
    var address = form.address.value;
    var suburb = form.suburb.value;
    var Postcode = form.Postcode.value;
  
    

if (str == "0") { document.getElementById("txtHint").innerHTML=""; return;}
if (window.XMLHttpRequest) xmlhttp=new XMLHttpRequest();
else { xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");}

xmlhttp.onreadystatechange=process;
xmlhttp.open("POST","register.php", true);
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xmlhttp.send("username="+username +"&password="+password+"&email="+email+"&phoneno="+phoneno+"&address="+address+"&suburb="+suburb+"&Postcode="+Postcode+"&firstName="+firstName+"&surname="+surname);



}

function process() {

if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
{
	if(xmlhttp.responseText=="OK"){window.location="myaccount.php?action=registerSuccess";}
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
            <li class="selected"><a href="register.html">register</a></li>
            <li><a href="order.php">order</a></li>
			<li><a href="catalogue.xml">catalogue</a></li>
            <li><a href="contact.html">contact us</a></li>
            </ul>
        </div>     
            
            
       </div> 
       
       
       <div class="center_content">
       	<div class="left_content">
            <div class="title"><span class="title_icon"><img src="images/bullet1.gif" alt="" title="" /></span>contact form</div>
        
        	<div class="feat_prod_box_details">
             <p class="details">
            Enter the details as required in order to send your email to us. 
            </p>
            
              	<div class="contact_form">
                <div class="form_subtitle">Contact us</div>
                <form name="register" action="#" method="POST">  
                     
                    <div class="form_row">
                    <label class="contact"><strong>name:</strong></label>
                    <input type="text" name="username"  class="contact_input" />
                    </div>  


                    <div class="form_row">
                    <label class="contact"><strong>email:</strong></label>
                    <input type="text" name="password" id="password" class="contact_input" />
                    </div> 

                    <div class="form_row">
                    <label class="contact"><strong>phone:</strong></label>
                    <input type="text" name="email" id="email" class="contact_input" />
                    </div>
                     
                       <div class="form_row">
                    <label class="contact"><strong>message:</strong></label>
                    <textarea type="text box" class="contact_input" > </textarea>
                    </div>
                    <p>
				<img src="captchaz-example-image-generator.php" alt="Captcha" /><br/>
				<label for="captcha">The text above:</label>
				<input type="text" class="text" id="captcha" name="captcha" value=""/>
			</p>
            
            <?php
	
	// code from sit203 prac 11
	include("captchaz.class.php");

	// check if the user has pressed the submit button
	$has_posted = array_key_exists("submit", $_POST);
	
	if ($has_posted)
	{
		$success = Captchaz::Check($_POST['captcha']);
		if ($success)
		{
			// do the stuffs, put into database, etc.
		}
	}
	else
	{
		$has_posted = false;
	}
?>
              
              <?php
			if ($has_posted)
			{
				if ($success)
				{
					echo "Success.";
				}
				else
				{
					echo "Please try again.";
				}
			}
		?>      

                    
                    <div class="form_row">
                    <input type="submit" class="register" name="submit" value="send"" />
                    </div>
                    <br >  <br >
                    
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
        <p class="details">�Deakin University, School of Information Technology. 
		 This web page has been developed as a student assignment for the unit SIT203:
		 Web Programming. Therefore it is not part of the University's authorised web 
		 site. DO NOT USE THE INFORMATION CONTAINED ON THIS WEB PAGE IN ANY WAY.</p>
		<div class="right_footer">
        <a href="index.html">home</a>
        <a href="about.html">about us</a>
        <a href="category.html">flowers</a>
        <a href="term.html">terms and conditions</a>
        <a href="contact.html">contact us</a>
       
        </div>
        
       
       </div>
    

</div>

</body>
</html>