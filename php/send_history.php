<?php


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
    

    
    if ($type == "admin") 
    {
      $sql = "select * from " . $type . "_send";
      $result = mysqli_query($conn,$sql);

      if ($result->num_rows > 0) 
      {
        while($row = $result->fetch_assoc())
        {
            
           $Dname =decryptthis($row['file_name'],$key);
           $Dsub = decryptthis($row['subject'],$key);

          echo "<tr><td>" . $row['m_to'] . "</td><td>" . $Dsub . "</td><td>" . $row['date'] . "</td><td>" . 
          "<button><a type='submit' name='delete' href='php/delete_send.php?id=" . $row['id'] . "'>" . "Delete</a></button>" . 
          "<button><a type='submit' name='view' href='view_send.php?id=" . $row['id'] . "'>" . "View</a></button></td></tr>";

        }
      
      }


    }
    elseif($type == "user")
    {

      
      if ($org == "ucsc") 
      {
        $sql = "select * from $org"."_"."$pos"."_send";
        $result = mysqli_query($conn,$sql);

        if ($result->num_rows > 0) 
        {
          while($row = $result->fetch_assoc())
          {
              
             $Dname =decryptthis($row['file_name'],$key);
             $Dsub = decryptthis($row['subject'],$key);


             echo "<tr><td>" . $row['m_to'] . "</td><td>" . $Dsub . "</td><td>" . $row['date'] . "</td><td>" . 
            "<button><a type='submit' name='delete' href='php/delete_send.php?id=" . $row['id'] . "'>" . "Delete</a></button>" . 
            "<button><a type='submit' name='view' href='view_send.php?id=" . $row['id'] . "'>" . "View</a></button></td></tr>";
          }
        }
        
      }
      else
      {

        $sql = "select * from $dep"."_"."$pos"."_send";
        $result = mysqli_query($conn,$sql);

        if ($result->num_rows > 0) 
        {
          while($row = $result->fetch_assoc())
          {
                
              $Dname =decryptthis($row['file_name'],$key);
              $Dsub = decryptthis($row['subject'],$key);


              echo "<tr><td>" . $row['m_to'] . "</td><td>" . $Dsub . "</td><td>" . $row['date'] . "</td><td>" . 
              "<button><a type='submit' name='delete' href='php/delete_send.php?id=" . $row['id'] . "'>" . "Delete</a></button>" . 
              "<button><a type='submit' name='view' href='view_send.php?id=" . $row['id'] . "'>" . "View</a></button></td></tr>";
          }
          
        }


      }


      



    }
    else
    {
      echo "YAWA";
    }




    




  }
  else
  {
    echo "AYAW";
  }

}




?>