<?php

include("header.php");
include("php/admin_manage_users.php");


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
  <h2><?php echo $dep?> User Table</h2>

  <button><a href='http://localhost/collab/admin_manage_users.php'>Back</a></button>
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
      <th></th>
    </tr>

    
    <?php include("php/admin_manage_users_dep_table.php");?>



  </table>
  <br><br>

</div>


<?php

include("footer.php");

?>