<?php
	session_start();
	
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
	//commented by Yousef ALharbi 20/08/2013 sit203 web programming assignment 3
?>
<html>
	<head>
		<title>Captcha test page</title>
	</head>
	<body>
		<h1>Captcha test page</h1>
		<form action="captchaz-example-form.php" method="post" id="test">
			<p>
				<img src="captchaz-example-image-generator.php" alt="Captcha" /><br/>
				<label for="captcha">The text above:</label>
				<input type="text" class="text" id="captcha" name="captcha" value=""/>
			</p>
			<p>
				<input type="submit" class="submit" name="submit" value="OK" />
			</p>
		</form>
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
	</body>
</html>
