<?xml version = "1.0"?>


<!--    
        commented by Yousef ALharbi 20/08/2013
		references:
		sit203  Exercise 03.01 Solution  ,lecture note www.deakin.edu.au
		http://www.w3schools.com/xml/
		http://csscreme.com/freecsstemplates/
		

		 -->
<xsl:stylesheet version = "1.0"
   xmlns:xsl = "http://www.w3.org/1999/XSL/Transform">

   <xsl:output method = "html" omit-xml-declaration = "no" 
      doctype-system = 
         "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd" 
      doctype-public = "-//W3C//DTD XHTML 1.0 Strict//EN" />

   <xsl:template match = "/">
      <html xmlns = "http://www.w3.org/1999/xhtml">
	  <head>

<link rel="stylesheet" type="text/css" href="style.css" />
</head>
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
			<li><a href="order.php">order</a></li>
			<li class="selected"><a href="catalogue.xml">catalogue</a></li>
            <li><a href="contact.html">contact us</a></li>
            </ul>
        </div>     
            
            
       </div> 
       
       
       <div class="xml_content">
       	<div class="left_content">
            <div class="title"><span class="title_icon"><img src="images/bullet1.gif" alt="" title="" /></span>flowers </div>
        
        	<div class="feat_prod_box_details">
    <!-- xsl start-->    
            
    
    <table class="table">
      <tr>
        <th>TYPE</th>
        <th>NAME</th>
		<th>DESCRIPTION</th>
        <th>PHOTO</th>
		<th>OCCASION</th>
        <th>PRICE-STANDARD</th>
		<th>PRICE-PREMIUM</th>
      </tr>
      <xsl:for-each select="CATALOG/FLOWERS">
      <tr>
        <td><xsl:value-of select="TYPE" /></td>
		<td><xsl:value-of select="NAME" /></td>
        <td><xsl:value-of select="DESCRIPTION" /></td>
		<td><img> <xsl:attribute name="src">
            <xsl:value-of select="PHOTO"/>
            </xsl:attribute>
            </img></td>
        <td><xsl:value-of select="OCCASION" /></td>
		<td><xsl:value-of select="PRICE/STANDARD" /></td>
        <td><xsl:value-of select="PRICE/PREMIUM" /></td>
		
      </tr>
      </xsl:for-each>
    </table>
	
	  <!-- xsl end--> 
	</div>	
	  <div class="clear"></div>
        </div>
      <!--end of left content-->
        
       
        
       
       
       <div class="clear"></div>
       </div><!--end of center content-->
       
              
       <div class="footer">
       	<div class="left_footer"><img src="images/footer_logo.gif" alt="" title="" /><br /> <a href="http://csscreme.com/freecsstemplates/" title="free templates"><img src="images/csscreme.gif" alt="free templates" title="free templates" border="0" /></a></div>
         <p class="details">Deakin University, School of Information Technology. 
		 This web page has been developed as a student assignment for the unit SIT203:
		 Web Programming. Therefore it is not part of the University's authorised web 
		 site. DO NOT USE THE INFORMATION CONTAINED ON THIS WEB PAGE IN ANY WAY.</p>
		<div class="right_footer">
        <a href="#">home</a>
        <a href="#">about us</a>
        <a href="#">flowers</a>
        <a href="#">privacy policy</a>
        <a href="#">contact us</a>
		 
        </div>
        
       
       </div>
    

</div>

	
  </body>
  </html>
</xsl:template>
</xsl:stylesheet>

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
