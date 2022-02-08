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

    //echo $type;
    if(isset($_GET['dep']))
    {

      $dep = strtoupper($_GET['dep']);

      //echo strtolower($dep);
      $sql = "select * from " . strtolower($dep) . "_archive";
      $result = mysqli_query($conn,$sql);

      while($row = $result->fetch_assoc())
      {

        $Dname = decryptthis($row['name'],$key);

        echo "<tr><td><a href='php/admin_manage_dep_archive_table_download.php?id=" . $row['id'] . "&" . "dep=" . $dep . "'>" . $Dname . "</a></td><td>" . $row['date'] . "</td><td>" . "<button><a type='submit' name='delete' href='php/admin_manage_dep_archive_table_delete.php?id=" . $row['id'] . "&" . "dep=" . $dep . "'>" . "Delete</a></button></td></tr>";
        


      }




    }

  }

}





?>