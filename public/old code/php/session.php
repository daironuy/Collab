<?php

session_start();

include("php/connect.php");


if(isset($_SESSION['collab_id']))
{

  $id = $_SESSION['collab_id'];

  echo $id;
  echo "<br>";

  $sql = "select * from users_1 where userid = '$id' limit 1";

  $result = mysqli_query($conn,$sql);

  if(!$result)
  {
    echo "ayaw";
  }
  else
  {
    while($row = mysqli_fetch_assoc($result))
    {

      if($id == $row['userid'])
      {
          //print_r($row);
          $Fname = $row['first_name'];
          $Lname = $row['last_name'];
          $Org = strtoupper($row['organization']);
          $Depa = strtoupper($row['department']);
          $Pos = strtoupper($row['position']);
          $type = $row['type'];

      }
      else
      {
        echo "wala";
      }

    }


  }


}



?>