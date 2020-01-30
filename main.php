<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="shortcut icon" href="icon.png" />
	<title>Ali Diagnostics</title>
	<link rel="stylesheet" href="home.css">
	<script type="text/javascript">
		var images =["1.jpg","2.jpg","3.jpg","4.jpg"];
		var i = 0; 
		function slides() 
		{
			document.getElementById("images").src=images[i];
			if(i<3)
				i++;
			else
				i=0;
		}

		function validateForm()
		{
			var name = document.forms["myForm"]["username"].value;
			var pass = document.forms["myForm"]["pass"].value;
			if(name.length == 0 || pass.length == 0)
			{
				document.getElementById("check").innerHTML="Field must be Filled";
				return false;
			}
			else
			{
				return true;
			}
			
		}
		setInterval(slides,2000);
</script>
</head>
<body>
	   <div class=" container">
	   		<h1 id = "sizer" style="text-align: center;">
    		<img src="icon.png" width="50px" height="50px" alt="logo" >
    		<b>Ali Diagnostic Center</b></h1>
	   </div>
        

	<nav class="navbar navbar-default">
	  	<div class="container-fluid">
    		<ul class="nav navbar-nav">
      			<li class="active"><a href="main.php">Home</a></li>
      			
    		</ul>
  		</div>
	</nav>
	<div class="container">
    	<div class="row">
  			<div class="col-sm-8">
  				<img id="images" src="1.jpg" alt="blood" height="300px" width="600px"><br>
  				<h2><b>Mission</b></h2>
				<p>We will provide consistently excellent and accessible health services to all in need of care regardless of status or ability to pay – exceptional care, without exception.</p>
				<p>Our values guide our behaviors, decision-making, goals and performance at BMC. These are the beliefs and behaviors practiced that reinforce our culture.</p>
  			</div>

  	<div class="col-sm-4">
  		<h3><b> login </b></h3><br>
  			<form name="myForm" action="login.php" onsubmit="return validateForm()" method="post">
  				UserName<br><input type="text" name="username"><br><br>
  				Password<br><input type="password" name="pass"><br><br>
  				<p id="check"><b></b></p>
  				<input type="submit" value="login">
  				
			</form>
  	</div>
	</div>
    </div>
 	<footer class="page-footer font-small blue">
  		<div class="footer-copyright text-center py-3"><b>© Programmed By</b>
    		<a href="https://www.facebook.com/profile.php?id=100005454153203"> Ahsan Ali</a>
  		</div>
	</footer>
</body>
</html>