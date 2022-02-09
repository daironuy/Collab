<?php 

session_start();

$host = "localhost";
$username = "root";
$password = "";
$db = "collab_db";
$conn = mysqli_connect($host,$username,$password,$db);


$id = $_SESSION['collab_id'];

$sql = "select * from users_1 where userid = '$id' limit 1";
$result = mysqli_query($conn,$sql);

//echo $number;
while($row = mysqli_fetch_assoc($result))
{

  if($id == $row['userid'])
  {
	
		//echo $row['first_name'];
		echo $row['code'];
		// echo "<br>";
		// echo $id;
		$C = $row['code'];
	
		if(isset($_POST['submit']))
		{

			$code = $_POST['code'];
			
			if ($code == "") 
			{
				echo "WALANG MALAN";
			}
			elseif($code !== $C)
			{
				echo "MALI";
			}
			else
			{
				$sqln = "update users_1 SET code='0'where userid = '$id'";
				$rresult = mysqli_query($conn,$sqln);

				header("Location: dashboard.php");
			}

		}

  }

}

?>