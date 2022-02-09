<?php

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
    $dep = strtolower($row['department']);
    $pos = strtolower($row['position']);
    $type = strtolower($row['type']);

    //echo $type;
    if(isset($_GET['dep']))
    {

      $dep = strtoupper($_GET['dep']);

      //echo $dep;
      if ($dep == "UCSC") 
      {
        $sql = "select * from users_1 where organization = '$dep'";
        $result = mysqli_query($conn,$sql);

        while($row = $result->fetch_assoc())
        {

          $id = $row['id'];
          $Fname = $row['first_name'];
          $Lname = $row['last_name'];
          $Org = $row['organization'];
          $Dep = $row['department'];
          $Pos = $row['position'];
          $Email = $row['email'];
          $Uname = $row['username'];
          $Pass = $row['password'];

          echo  "<tr><td>" . $Fname ."</td><td>" . $Lname . "</td><td>" . $Org . "</td><td>" . $Dep . "</td><td>" . $Pos . "</td><td>" . $Email . "</td><td>" . $Uname . "</td><td>" . $Pass . "</td><td>" . "<button><a href='admin_manage_users_dep_edit.php?use=" . $id . "'>Edit</button></a></td></tr>" ;


        }

      }
      else
      {

        $sql = "select * from users_1 where department = '$dep'";
        $result = mysqli_query($conn,$sql);

        while($row = $result->fetch_assoc())
        {

          $id = $row['id'];
          $Fname = $row['first_name'];
          $Lname = $row['last_name'];
          $Org = $row['organization'];
          $Dep = $row['department'];
          $Pos = $row['position'];
          $Email = $row['email'];
          $Uname = $row['username'];
          $Pass = $row['password'];

          echo  "<tr><td>" . $Fname ."</td><td>" . $Lname . "</td><td>" . $Org . "</td><td>" . $Dep . "</td><td>" . $Pos . "</td><td>" . $Email . "</td><td>" . $Uname . "</td><td>" . $Pass . "</td><td>" . "<button><a href='admin_manage_users_dep_edit.php?use=" . $id . "'>Edit</button></a></td></tr>" ;
        }
      


      }




    }

  }

}





?>