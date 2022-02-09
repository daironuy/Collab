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

while($row = mysqli_fetch_assoc($result))
{

  if($id == $row['userid'])
  {
    $org = strtolower($row['organization']);
    $dep = strtolower($row['department']);
    $pos = strtolower($row['position']);
    $type = strtolower($row['type']);

    if(isset($_GET['id']))
    {

      $del = $_GET['id'];

      
      if ($type == "admin") 
      {
        $sql = "DELETE FROM `$type" . "_send` WHERE id = $del";
      
        if (mysqli_query($conn,$sql)) 
        {
          //echo "NAG DELETE";
          header("Location: http://localhost/collab/send_file.php");
        }
        else
        {
          echo "AYAW MAG DELETE";
        }
      }
      elseif($type == "user")
      {
        
        if ($org == "ucsc") 
        {
          $sql = "DELETE FROM `$org" . "_" . "$pos" . "_send` WHERE id = $del";
      
          if (mysqli_query($conn,$sql)) 
          {
            //echo "NAG DELETE";
            header("Location: http://localhost/collab/send_file.php");
          }
          else
          {
            echo "AYAW MAG DELETE";
          }

        }
        else
        {
          $sql = "DELETE FROM `$dep" . "_" . "$pos" . "_send` WHERE id = $del";
      
          if (mysqli_query($conn,$sql)) 
          {
            //echo "NAG DELETE";
            header("Location: http://localhost/collab/send_file.php");
          }
          else
          {
            echo "AYAW MAG DELETE";
          }
        }

      }


    }

  }

}





?>