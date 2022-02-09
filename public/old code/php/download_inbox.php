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
  	
  	$org = strtolower($row['organization']);
  	$dep = strtolower($row['department']);
  	$pos = strtolower($row['position']);
  	$type = strtolower($row['type']);

  	if ($org == "ucsc") 
  	{
	    
	  	$id = isset($_GET['id'])? $_GET['id'] : "";
	  	$sql = "select * from " . $org . "_" . $pos ."_inbox where id = " . $id;

	  	$result = mysqli_query($conn,$sql);
			list($id, $M, $sub, $mes, $name, $size, $type,$file,$date) = mysqli_fetch_array($result);

			$Dname = decryptthis($name,$key);
			$Dsize = decryptthis($size,$key);
			$Dtype = decryptthis($type,$key);
			$Dfile = decryptthis($file,$key);

			header("Content-length: $Dsize");
			header("Content-type: $Dtype");
			header("Content-Disposition: attachment; filename= $Dname");
			ob_clean();
			flush();
			$Nfile = stripslashes($Dfile);
			echo $Nfile;
  	}
  	else
  	{
	  	$id = isset($_GET['id'])? $_GET['id'] : "";
	  	$sql = "select * from " . $dep . "_" . $pos ."_inbox where id = " . $id;

	  	$result = mysqli_query($conn,$sql);
			list($id, $M, $sub, $mes, $name, $size, $type,$file,$date) = mysqli_fetch_array($result);

			$Dname = decryptthis($name,$key);
			$Dsize = decryptthis($size,$key);
			$Dtype = decryptthis($type,$key);
			$Dfile = decryptthis($file,$key);

			header("Content-length: $Dsize");
			header("Content-type: $Dtype");
			header("Content-Disposition: attachment; filename= $Dname");
			ob_clean();
			flush();
			$Nfile = stripslashes($Dfile);
			echo $Nfile;
  	}

  	
  }
    
}
?>