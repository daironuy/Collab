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
    $dep = strtolower($row['department']);
    $pos = strtolower($row['position']);
    $type = strtolower($row['type']);

    //echo $type;
    if(isset($_GET['dep']))
    {

      $dep = strtoupper($_GET['dep']);


    }

  }

}





?>