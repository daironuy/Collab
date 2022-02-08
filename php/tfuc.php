<?php 


$host = "localhost";
$username = "root";
$password = "";
$db = "collab_db";


$id = $_SESSION['collab_id'];

$sql = "select * from users_1 where userid = '$id' limit 1";
$result = mysqli_query($conn,$sql);

$number = "";
for ($i=0; $i < 6; $i++) 
{ 
	$new_rand = mt_rand(0,9);

	$number = $number .$new_rand;

	
}

//echo $number;
while($row = mysqli_fetch_assoc($result))
{

  if($id == $row['userid'])
  {
	
	// echo $row['first_name'];
	// echo "<br>";
	// echo $row['code'];
	// echo "<br>";

	$sqln = "update users_1 SET code='$number'where userid = '$id'";
	$rresult = mysqli_query($conn,$sqln);

	// if (!$rresult) 
	// {
	// 	echo "AYAW";
	// }
	// else
	// {
	// 	echo "GUMANA";
	// }

  }

}

?>