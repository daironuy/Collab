<?php


$key = 'dairon';


//ENCRYPT FUNCTION
function encryptthis($data, $key) 
{
	$encryption_key = base64_decode($key);
	$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
	$encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
	return base64_encode($encrypted . '::' . $iv);
}
 
//DECRYPT FUNCTION
function decryptthis($data, $key) 
{
	$encryption_key = base64_decode($key);
	list($encrypted_data, $iv) = array_pad(explode('::', base64_decode($data), 2),2,null);
	return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
}


session_start();
//include("php/encrypt_func.php");

$id = $_SESSION['collab_id'];

$host = "localhost";
$username = "root";
$password = "";
$db = "collab_db";
$conn = mysqli_connect($host,$username,$password,$db);

$sql = "select * from users_1 where userid = '$id' limit 1";
$result = mysqli_query($conn,$sql);

while($row = mysqli_fetch_assoc($result))
{

  if($id == $row['userid'])
  {	
  	
  	$id = isset($_GET['id'])? $_GET['id'] : "";
  	$dep = isset($_GET['dep'])? $_GET['dep'] : "";

		$D = strtolower($dep);
		//echo $D;

		// $sql = "select * from " . $D . "_archive where id = '$id' limit 1";
		// $result = mysqli_query($conn,$sql);

		// while($row = mysqli_fetch_assoc($result))
		// {
		// 	$name =  $row['name'];
		// 	$Dname = decryptthis($name,$key);
		// 	echo $Dname;
		// }

		$sql = "DELETE FROM `$D" . "_archive` WHERE id = $id";
		$r = mysqli_query($conn,$sql);
      
    if (!$r) 
    {
      echo "AYAW MAG DELETE";
    }
    else
    {
      //echo "NAG DELETE";
      header("Location: http://localhost/collab/admin_manage_dep_archive_table.php?dep=" . $D );

    }




  }
    
}
?>