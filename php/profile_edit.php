<?php


//session_start();

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
    // $fname = strtolower($row['first_name']);
    // $lname = strtolower($row['last_name']);
    $use = strtolower($row['username']);
    $pass = strtolower($row['password']);
    $type = strtolower($row['type']);

    //echo $row['first_name'];
    


    if(isset($_POST['save']))
    {

      $Nuser = $_POST['username'];
      $Npass = $_POST['password'];

      //echo $Nuser;
      //echo $Npass;


      if(!$Nuser == "") 
      {
        

        if(!$Npass == "") 
        {

          $sql = "update users_1 SET username='$Nuser',password='$Npass'where userid = '$id'";
          if(mysqli_query($conn,$sql))
          {
            //echo "NAGUPDATE";
            header("Location: profile.php");
          }
          else
          {
            echo "HND NAG UPDATE";
          }


        }
        else
        {
          echo "PLS PUT NEW PASSWORD";
        }


      }
      else
      {
        echo "PLS PUT NEW USERNAME";
      }

    }

  }

}





?>