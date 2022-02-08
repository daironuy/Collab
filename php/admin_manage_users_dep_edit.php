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
    if(isset($_GET['use']))
    {

      $id = $_GET['use'];

      //echo $id;
      $sql = "select * from users_1 where id = '$id'";
      $result = mysqli_query($conn,$sql);

      while($row = $result->fetch_assoc())
      {

        //echo  $id;
        // $id = $row['id'];
        $Fname = $row['first_name'];
        $Lname = $row['last_name'];
        $Org = $row['organization'];
        $Dep = $row['department'];
        $Pos = $row['position'];
        $Email = $row['email'];
        $Uname = $row['username'];
        $Pass = $row['password'];


        if(isset($_POST['save']))
        {

          $Nfirst = $_POST['firstname'];
          $Nlast = $_POST['lastname'];
          $Nemail = $_POST['email'];
          $Nuser = $_POST['username'];
          $Npass = $_POST['password'];

          

          if ($Nfirst == "" || $Nlast == "" || $Nemail == "" || $Nuser == "" || $Npass == "") 
          {
            echo "PLS Fill the Requ";
          }
          else
          {
            $sqln = "update users_1 SET first_name='$Nfirst', last_name='$Nlast', email='$Nemail', username='$Nuser', password='$Npass'  where id = '$id'";
            $rresult = mysqli_query($conn,$sqln);
            
            if(!$rresult)
            {
              echo "HND NAG UPDATE";
            }
            else
            {
              if ($Org == "UCSC") 
              {
                header("Location: admin_manage_users_dep.php?dep=" . strtolower($Org));
              }
              else
              {
                header("Location: admin_manage_users_dep.php?dep=" . strtolower($Dep));
              }
              
            }
          }


        }

        


      }




    }

  }

}





?>