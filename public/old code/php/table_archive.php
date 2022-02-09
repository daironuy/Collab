<?php

//include("php/encrypt_func.php");

$sql = "select * from users_1 where userid = '$id' limit 1";
$result = mysqli_query($conn,$sql);

while($row = mysqli_fetch_assoc($result))
{

  if($id == $row['userid'])
  {
    $org = strtolower($row['organization']);
    $dep = strtolower($row['department']);
    $type = strtolower($row['type']);

    if ($type == "admin") 
    {
      $sql = "select * from " . $type . "_archive";
      $result = mysqli_query($conn,$sql);

      if ($result->num_rows > 0) 
      {
        while($row = $result->fetch_assoc())
        {

          $Dname =decryptthis($row['name'],$key);


          echo "<tr><td><a href='php/download_archive.php?id=" . $row['id'] . "'>" . $Dname . "</a></td><td>" . $row['date'] . "</td><td>" . "<button><a type='submit' name='delete' href='php/delete_archive.php?delete=" . $row['id'] . "'>" . "Delete</a></button></td></tr>";

        }
      
      }
    }
    elseif($type == "user")
    {
      
      if ($org == "ucsc") 
      {
        $sql = "select * from " . $org . "_archive";
        $result = mysqli_query($conn,$sql);

        if ($result->num_rows > 0) 
        {
          while($row = $result->fetch_assoc())
          {

            $Dname =decryptthis($row['name'],$key);

            echo "<tr><td><a href='php/download_archive.php?id=" . $row['id'] . "'>" . $Dname . "</a></td><td>" . $row['date'] . "</td><td>" . "<button><a type='submit' name='delete' href='php/delete_archive.php?delete=" . $row['id'] . "'>" . "Delete</a></button></td></tr>";

          }
        
        }
      }
      else
      {
        $sql = "select * from " . $dep . "_archive";
        $result = mysqli_query($conn,$sql);

        if ($result->num_rows > 0) 
        {
          while($row = $result->fetch_assoc())
          {

            $Dname =decryptthis($row['name'],$key);

            echo "<tr><td><a href='php/download_archive.php?id=" . $row['id'] . "'>" . $Dname . "</a></td><td>" . $row['date'] . "</td><td>" . "<button><a type='submit' name='delete' href='php/delete_archive.php?delete=" . $row['id'] . "'>" . "Delete</a></button></td></tr>";

          }
        }

      
      }



    }
    else
    {
      echo "WALA TALAGA";
    }

    


// OLD VIEW TABLE




    // $sql = "select * from $dep"."_files";
    // $result = mysqli_query($conn,$sql);

    // if ($result->num_rows > 0) 
    // {
    //   while($row = $result->fetch_assoc())
    //   {
          
        //echo "<tr><td>"?><!-- <a href=" --><?php //$dep . "_files"?><!-- / --><?php //echo $row["file"]?><!-- " download> --><?php //echo $row["file"] . "</td><td>" . $row["date"]."</td></tr>" ?>
        <?php

      // }
    
    //}


  }
  else
  {
    echo "AYAW";
  }

}




?>