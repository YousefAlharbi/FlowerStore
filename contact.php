<?php

session_start();
ob_start();
//ini_set('error_reporting', E_NONE);
//commented by Yousef ALharbi 20/08/2013 sit203 web programming assignment 3

if(isset($_POST["submitted"]) && $_POST["submitted"] == 1)
{
	//Read POST request params into global vars
	$to_email          = "ynal@deakin.edu.au"; 
	$from_fullname     = trim(strip_tags($_POST['vpbfullname']));
	$from_email        = trim(strip_tags($_POST['email']));
	$email_subject     = trim(strip_tags($_POST['subject']));
	$email_message     = nl2br(trim(strip_tags($_POST['message'])));
	$security_code     = trim(strip_tags($_POST['vpb_captcha_code']));
	
	//Set up the email headers
    $headers      = "From: $from_fullname <$from_email>\r\n";
    $headers   .= "Content-type: text/html; charset=iso-8859-1\r\n";
    $headers   .= "Message-ID: <".time().rand(1,1000)."@".$_SERVER['SERVER_NAME'].">". "\r\n";   
	
	if($from_fullname == "")
	{
		$submission_status = '<div class="vpb_info" align="left">Please enter your fullname in the required field to proceed. Thanks.</div>';
	}
	elseif($from_email == "")
	{
		$submission_status = '<div class="vpb_info" align="left">Please enter your email address in the required email field to proceed.</div>';
	}
	elseif(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $from_email))
	{
		$submission_status = '<div class="vpb_info" align="left">Sorry, your email address is invalid. Please enter a valid email address to proceed. Thanks.</div>';
	}
	elseif($email_subject == "")
	{
		$submission_status = '<div class="vpb_info" align="left">Please enter the subject of your message in the required field to proceed.</div>';
	}
	elseif($email_message == "")
	{
		$submission_status = '<div class="vpb_info" align="left">Please enter your message in the required message field to proceed. Thanks.</div>';
	}
	elseif($security_code == "")
	{
		$submission_status = '<div class="vpb_info" align="left">Please enter the security code in its field to send us your message. Thanks.</div>';
	}
	elseif(!isset($_SESSION['vpb_captcha_code']))
	{
		$submission_status = '<div class="vpb_info" align="left">Sorry, there is no session created on this page at the moment, please refresh this page and try again.</div>';
	}
	else
	{
		if(empty($_SESSION['vpb_captcha_code']) || strcasecmp($_SESSION['vpb_captcha_code'], $_POST['vpb_captcha_code']) != 0)
		{
			//Note: the captcha code is compared case insensitively. If you want case sensitive match, update the check above to strcmp()
			$submission_status = '<div class="vpb_info" align="left">Sorry, the security code you provided was incorrect, try again.</div>';
		}
		else
		{
			$vasplus_mailer_delivers_greatly = @mail($to_email, $email_subject, $email_message, $headers);
					
			if ($vasplus_mailer_delivers_greatly) 
			 {
				//Displays the success message when email message is sent
				  $submission_status = "<div align='left' class='vpb_success'>Congrats $from_fullname, your email message has been sent successfully!<br>We will get back to you as soon as possible. Thanks.</div>";
			 } 
			 else 
			 {
				 //Displays an error message when email sending fails
				  $submission_status = "<div align='left' class='vpb_info'>Sorry, your email could not be sent at the moment. <br>Please try again or contact this website admin to report this error message if the problem persist. Thanks.</div>";
			 }
		}
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title>Flower Shop</title>
<link rel="stylesheet" type="text/css" href="style.css" />

<script type="text/javascript">
function vpb_refresh_aptcha()
{
	return document.getElementById("vpb_captcha_code").value="",document.getElementById("vpb_captcha_code").focus(),document.images['captchaimg'].src = document.images['captchaimg'].src.substring(0,document.images['captchaimg'].src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
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
            <li><a href="contact.php">contact us</a></li>
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
               <!-- start edit-->
			   
<div>

<form method="post" action="contact.php" enctype="multipart/form-data">


 <label class="contact"><strong>Fullname:</strong></label>
<div><input type="text" id="vpbfullname"  name="vpbfullname" value="<?php echo strip_tags($_POST["vpbfullname"]); ?>" class="contact_input"></div><br clear="all"><br clear="all">



<label class="contact"><strong>Email:</strong></label>
<div><input type="text" id="email" name="email" value="<?php echo strip_tags($_POST["email"]); ?>" class="contact_input"></div><br clear="all"><br clear="all">


<label class="contact"><strong>Subject:</strong></label>
<div ><input type="text" id="subject" name="subject" value="<?php echo strip_tags($_POST["subject"]); ?>" class="contact_input"></div><br clear="all"><br clear="all">



<label class="contact"><strong>Message:</strong></label>
<div><textarea id="message" name="message" class="contact_textarea" rows="6" cols="60" ><?php echo strip_tags($_POST["message"]); ?></textarea></div><br clear="all"><br clear="all">



<label class="contact"><strong>Security Code:</strong></label>
<div>
<div class="vpb_captcha_wrappers"><input type="text" id="vpb_captcha_code" name="vpb_captcha_code" style="border-bottom: solid 2px #cbcbcb;" class="contact_input"></div></div><br clear="all">
<div>&nbsp;</div>
<div><div class="vpb_captcha_wrapper"><img src="vasplusCaptcha.php?rand=<?php echo rand(); ?>" id='captchaimg' ></div><br clear="all">
<div ><font>Can't read the above security code? <a href="javascript:void(0);" style="text-decoration:none;" onClick="vpb_refresh_aptcha();">Refresh</a></font></div>

</div>
<br clear="all"><br clear="all">

<div><?php echo $submission_status; ?></div><!-- Display success or error messages -->
<div>&nbsp;</div>
<div>
<input type="hidden" id="submitted" name="submitted" value="1">
<input type="submit" class="vpb_general_button"  value="Submit">
</div>


</form>
</div>
<br clear="all">


<!-- Code Ends Here -->

			   
			   
			    <!-- end edit-->
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