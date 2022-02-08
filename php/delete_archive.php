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
    $type = strtolower($row['type']);

    if(isset($_GET['delete']))
    {

      $del = $_GET['delete'];

      
      if ($type == "admin") 
      {
        $sql = "DELETE FROM `$type" . "_archive` WHERE id = $del";
      
        if (mysqli_query($conn,$sql)) 
        {
          //echo "NAG DELETE";
          header("Location: http://localhost/collab/archive.php");
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
          $sql = "DELETE FROM `$org" . "_archive` WHERE id = $del";
      
          if (mysqli_query($conn,$sql)) 
          {
            //echo "NAG DELETE";
            header("Location: http://localhost/collab/archive.php");
          }
          else
          {
            echo "AYAW MAG DELETE";
          }
        }
        else
        {

          $sql = "DELETE FROM `$dep" . "_archive` WHERE id = $del";
      
          if (mysqli_query($conn,$sql)) 
          {
            //echo "NAG DELETE";
            header("Location: http://localhost/collab/archive.php");
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






// OLD DELETE









// $sql = "select * from users_1 where userid = '$id' limit 1";
// $result = mysqli_query($conn,$sql);


// while($row = mysqli_fetch_assoc($result))
// {

//   if($id == $row['userid'])
//   {
//     $dep = strtolower($row['department']);
    
//     if(isset($_POST['delete']))
//     {

//       $delete_file = $_POST['file_1'];

//       $delete_path = "$dep"."_files/$delete_file";


//       if(unlink($delete_path))
//       {

//         $sql = "DELETE FROM `$dep"."_files` WHERE file = '$delete_file'";
//         mysqli_query($conn,$sql);

//         echo "NAG DELETEEEE";

//       }

//     }


    
//     }
//     else
//     {
//       echo "AYAW";
//     }

// }


?>