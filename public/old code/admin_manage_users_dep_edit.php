<?php

include("header.php");
include("php/admin_manage_users.php");
include("php/admin_manage_users_dep_edit.php");


?>

 <!-- <div id="bar1">

    Archive<br><br>
    <form method="post" enctype="multipart/form-data">

      <input type="file" name="file"/>
      <br><br>
      <button id="button" type="submit" name="upload">Upload</button>
   
    </form>
  </div> -->

<div id="bar1">

  <h2><?php if ($Org == "UCSC") 
  {
    echo $Org . "/" . $Pos;
  }
  else
  {
    echo $Dep . "/" . $Pos;
  }
  ?> Info</h2>

  <button><a href='http://localhost/collab/admin_manage_users_dep.php?dep=<?php if($Org == "UCSC")
    {
      echo strtolower($Org);
    }
    else
    {
      echo strtolower($Dep);
    } 
    ?>'>Back</a></button>
      <br><br>

  <table>
    <tr>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Organization</th>
      <th>Department</th>
      <th>Position</th>
      <th>Email</th>
      <th>Username</th>
      <th>Password</th>
    </tr>

    <tr>
      <td><?php echo $Fname; ?></td>
      <td><?php echo $Lname; ?></td>
      <td><?php echo $Org; ?></td>
      <td><?php echo $Dep; ?></td>
      <td><?php echo $Pos; ?></td>
      <td><?php echo $Email; ?></td>
      <td><?php echo $Uname; ?></td>
      <td><?php echo $Pass; ?></td>
    </tr>

    
    



  </table>
  <br><br>

  <div id="bar">
      
      <form method="post">

        First Name<br><br>
        <input value="<?php echo $Fname;?>" name="firstname" type="text" id="text" placeholder="<?php echo $Fname;?>"><br><br>

        Last Name<br><br>
        <input value="<?php echo $Lname;?>" name="lastname" type="text" id="text" placeholder="<?php echo $Lname;?>"><br><br>

        Email<br><br>
        <input value="<?php echo $Email;?>" name="email" type="text" id="text" placeholder="<?php echo $Email;?>"><br><br>

        Username<br><br>
        <input value="<?php echo $Uname;?>" name="username" type="text" id="text" placeholder="<?php echo $Uname;?>"><br><br>
        
        Password<br><br>
        <input value="<?php echo $Pass;?>" name="password" type="text" id="text" placeholder="<?php echo $Pass;?>"><br><br>

        <button name="save" type="submit">Save</button>
        <br><br><br>

      </form>
    </div>

</div>


<?php

include("footer.php");

?>