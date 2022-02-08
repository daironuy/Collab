<?php

include("encrypt_fun.php");

$host = "localhost";
$username = "root";
$password = "";
$db = "collab_db";

$conn = mysqli_connect($host,$username,$password,$db);
    
    // if(isset($_GET['name'])) 
    // {
  		$id = isset($_GET['id'])? $_GET['id'] : "";
  		$sql = "SELECT * FROM arc WHERE id = $id";
		// $N = isset($_GET['name'])? $_GET['name'] : "";
  // 		$sql = "SELECT * FROM arc WHERE name = $N";
		
		// IVIVIEW SA BROWSER
		// $result = mysqli_query($conn, $sql);
		// //echo $sql;
		// $row = mysqli_fetch_array($result);
		// //echo $row['name']
		// header("Content-type: " . $row["type"]);
  		//echo $row["file"];


  		$result = mysqli_query($conn,$sql);
		list($id, $name, $size, $type,$file,$date) = mysqli_fetch_array($result);

		$Dname =decryptthis($name,$key);
		$Dsize = decryptthis($size,$key);
		$Dtype = decryptthis($type,$key);
		$Dfile = decryptthis($file,$key);

		//echo $Ename;

		header("Content-length: $Dsize");
		header("Content-type: $Dtype");
		header("Content-Disposition: attachment; filename= $Dname");
		ob_clean();
		flush();
		$Nfile = stripslashes($Dfile);
		echo $Nfile;


  // 		$Enid = encryptthis($id,$key);
  // 		$N = decryptthis($Enid,$key);


		// echo $Enid;
		// echo "<br><br>";
		// echo $N;


?>