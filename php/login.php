<?php 

session_start();

$host = "localhost";
$username = "root";
$password = "";
$db = "collab_db";

$conn = mysqli_connect($host,$username,$password,$db);


if(isset($_POST['login']))
{

	$username = $_POST['username'];
	$password = $_POST['password'];


	$sql = "select * from users_1 where username = '$username' limit 1";

	$result = mysqli_query($conn,$sql);

	if(!$result)
	{
		echo "ayaw";
	}
	else
	{
		while($row = mysqli_fetch_assoc($result))
		{

			if($username == $row['username'])
			{
				
				
				if($row['type'] == "admin")
				{
					//echo "TAMA ADMIN";
					//echo $row['userid'];
					if ($password == $row['password']) 
					{
						$_SESSION['collab_id'] = $row['userid'];
						//header("Location: dashboard.php");
						include("php/tfuc.php");
						header("Location: code.php");
					}
					else
					{
						echo "Username or Password are Wrong";
					}

					
				}
				elseif ($row['type'] == "user") 
				{
					//echo "TAMA USER";
					if ($password == $row['password']) 
					{
						$_SESSION['collab_id'] = $row['userid'];
						//header("Location: dashboard.php");
						include("php/tfuc.php");
						header("Location: code.php");
						
					}
					else
					{
						echo "Username or Password are Wrong";
					}
				}
				else
				{
					echo "WALA";
				}

			}
			else
			{
				echo "wala";
			}

		}


	}








	// if($result)
	// {

	// 	$row = $result[0];

	// 	echo $row;
		// if($username == $row['password'])
		// {
		// 	echo "meron";
		// }
		// else
		// {
			
		// 	echo "wala";


		// }

	


		// $sql = "SELECT * FROM `users_1` WHERE username = '$username' and password = 'password'";

		// mysqli_query($conn,$sql);

		// header("Location: dashboard_1.php");
		// die;

	// }


}



?>