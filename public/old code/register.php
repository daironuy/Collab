<?php 

	include("classes/connect.php");
	include("classes/register.php");


	$first_name = "";
	$last_name = "";
	$organization = "";
	$department = "";
	$position = "";
	$email = "";

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{


		$register = new Register();
		$result = $register->evaluate($_POST);

		
		if($result != "")
		{

			echo "<div style='text-align:center;font-size:12px;color:white;background-color:#f44c4c;'>";
			echo "<br>The following errors occured:<br><br>";
			echo $result;
			echo "</div>";
		}	
		

		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$organization = $_POST['organization'];
		$department = $_POST['department'];
		$position = $_POST['position'];
		$email = $_POST['email'];
	}

	

?>
<html> 

	<head>
		
		<title>Collab | Register</title>
	</head>

	<style>
		

		#signup_button
		{

			background-color: #42b72a;
			width: 70px;
			text-align: center;
			padding:4px;
			border-radius: 4px;
			float:right;
		}

		#bar
		{

			background-color: #4097c8;
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
			
			Register to Collab<br><br>

			<form method="post">

				<input value="<?php echo $first_name?>" name="first_name" type="text" id="text" placeholder="First name"><br><br>
				<input value="<?php echo $last_name?>" name="last_name" type="text" id="text" placeholder="Last name"><br><br>

				<span value="<?php echo $organization?>"style="font-weight: normal;">Organization:</span><br>
				<select id="text" name="organization">
					
					<option>DSC</option>
					<option>UCSC</option>

				</select>
				<br><br>
				
				<span value="<?php echo $department?>"style="font-weight: normal;">Department:</span><br>
				<select id="text" name="department">
					
					<option>CCMS</option>
					<option>CENG</option>
					<option>CBA</option>
					<option>CAFA</option>
					<option>CAS</option>
					<option>CCJC</option>
					<option>CE</option>
					<option>CIHTM</option>
					<option>CME</option>
					<option>CNAHS</option>

				</select>
				<br><br>
				
				<span value="<?php echo $position?>"style="font-weight: normal;">Position:</span><br>
				
				<select id="text" name="position">
					
					<option>President</option>
					<option>Vice-Precident</option>
					<option>Secretary</option>
					<option>Treasurer</option>
					<option>Auditor</option>

				</select>
				<br><br>
				<input  name="email" type="text" id="text" placeholder="Email"><br><br>
				
				<input name="password" type="password" id="text" placeholder="Password"><br><br>
				<input name="password2" type="password" id="text" placeholder="Retype Password"><br><br>

				<input type="submit" id="button" value="Register">
				<br><br><br>

			</form>

		</div>

	</body>


</html>