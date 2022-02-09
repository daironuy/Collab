<?php

include("encrypt_fun.php");

$host = "localhost";
$username = "root";
$password = "";
$db = "collab_db";

$conn = mysqli_connect($host,$username,$password,$db);


echo "WALAAAA";


if(isset($_POST["upload"])) 
{
  
	$fileName = $_FILES['file']['name'];
	$fileSize = $_FILES['file']['size'];
	$fileError = $_FILES['file']['error'];
	$fileType = $_FILES['file']['type'];
	$data = addslashes(file_get_contents($_FILES['file']['tmp_name']));

	$fileExt = explode('.', $fileName);
	$fileActualExt = strtolower(end($fileExt));
	
	$allowed = array('csv','doc','docx','jpg','pdf','png');
	
	$host = "localhost";
	$username = "root";
	$password = "";
	$db = "collab_db";

	$conn = mysqli_connect($host,$username,$password,$db);

	

		if ($fileError == 0)
		{
				
				// $Enid = encryptthis($id,$key);
  		// 	$N = decryptthis($Enid,$key);

				$Ename = encryptthis($fileName,$key);
				$Esize = encryptthis($fileSize,$key);
				$Etype = encryptthis($fileType,$key);
				$Edata = encryptthis($data,$key);

				// echo $Dname;
				// echo "<br>";
				// echo $Dsize;
				// echo "<br>";
				// echo $Dtype;
				// echo "<br>";
				// echo $Ddata;

				$sql = "insert into arc (name,size,type,file) values('$Ename','$Esize','$Etype', '$Edata')";
				// mysqli_query($conn,$sql);

				if(mysqli_query($conn,$sql))
				{
					echo "File uploaded successfully.";
					echo "<br>";
				}
				else
				{
					echo "AYAW";
				}

			}
			
	else 
	{
		echo "File format not supported.";
		
	}
	
}


$sql = "select * from arc";
$result = mysqli_query($conn,$sql);

    if ($result->num_rows > 0) 
    {
      while($row = $result->fetch_assoc())
      {
          
      	$Dname =decryptthis($row['name'],$key);
				// $Dsize = decryptthis($size,$key);
				// $Dtype = decryptthis($type,$key);
				// $Dfile = decryptthis($file,$key);

        //echo "<a href='download.php?id=" . $row['id'] . "'>" . $Dname . "</a>";
        echo "<br>";
      }
    
    }

?>
<html>
<body>

<h3>BLOB</h3>
<form method="post" enctype="multipart/form-data">
  <label>Select a file:</label>
  <input type="file" name="file"/><br><br>
  <input type="submit" name="upload">
</form>

</body>
</html>