<?php 

include("php/login.php");

?>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Collab</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="collabbb/images.css">
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

<style type="text/css">
body
{
    background:url('BG-9.jpg');
    background-size: 100%;
    background-repeat: no-repeat;
    min-height: 1000%;
}
.wrapper 
{
    margin: 100px; 
}
.form-signin 
{
    max-width: 380px;
    margin: 0 auto;
    background-color: rgb(233, 238, 247);
    padding: 50px 50px 50px;
    border: 1px solid #0c0c0c;
    border-radius: 10px;
}
.form-signin input[type="text"], .form-signin input[type="password"] 
{
    margin-bottom: 30px;
}

</style>

</head>

<body>

<div class="wrapper">

<form class="form-signin" method="post">
  
  <h3 class="form-signin-heading text-center">Login To Collab</h3><br>

  <input class="form-control" type="text" name="username" placeholder="Username" />

  <input type="password" class="form-control" name="password" placeholder="Password"/>
  
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="RememberMe">
    <label class="form-check-label" for="RememberMe">Remember Me</label>
  </div>
  
  <div class="d-grid gap-2 col-6 mx-auto">
    <button class="btn btn-primary" name="login" type="submit">Login</button>
  </div>

</form>
    
</div>

</body>
</html>









<!-- Old Login -->





<!-- <html> 

	<head>
		
		<title>Collab | Log in</title>
	</head>

	<style>
		


		#bar
		{

			background-color:#4097c8;
			width:800px;
			margin:auto;
			margin-top: 50px;
			padding:10px;
			padding-top: 50px;
			text-align: center;
			font-weight: bold;

		}

		#text
		{

			height: 40px;
			width: 300px;
			border-radius: 4px;
			border:solid 1px #ccc;
			padding: 4px;
			font-size: 14px;
		}

		#button
		{

			width: 300px;
			height: 40px;
			border-radius: 4px;
			font-weight: bold;
			border:none;
			background-color: #e5ba27;
			color: black;
		}

	</style>

	<body style="font-family: tahoma;background-color: #e9ebee;">
		

		<div id="bar">
			
			<form method="post">
				Log in to Collab<br><br>

				<input name="username" type="text" id="text" placeholder="Username"><br><br>
				
				<input name="password" type="password" id="text" placeholder="Password"><br><br>

				<input name="login" type="submit" id="button" value="Log in">
				<br><br><br>

			</form>
		</div>

	</body>


</html> -->