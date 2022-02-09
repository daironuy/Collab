<?php

include("header.php");
include("php/profile.php");


?>


<div id="bar1">
  <h2>Account Information</h2>

  <table>
    <tr>
      <th>Username</th>
      <td><?php echo $use; ?></td>
    </tr>
    <tr>
      <th>Password</th>
      <td><?php echo $pass; ?></td>
    </tr>
    <tr>
      <th>Pin</th>
      <td>WALA PA</td>
    </tr>



  </table>
  <br><br>

  <button><a href='profile_edit.php'>Edit</a></button>
      <br><br>


</div>


<?php


include("footer.php");


?>

