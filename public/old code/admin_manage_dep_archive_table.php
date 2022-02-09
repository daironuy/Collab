<?php

include("header.php");
include("php/admin_manage_dep_archive.php");


?>


<div id="bar1">
  <h2><?php echo $dep?> User Table</h2>

  <button><a href='http://localhost/collab/admin_manage_dep_archive.php'>Back</a></button>
      <br><br>

  <table>
    <tr>
      <th>File</th>
      <th>Date</th>
      <th></th>
    </tr>

    
    <?php include("php/admin_manage_dep_archive_table.php");?>



  </table>
  <br><br>

</div>


<?php

include("footer.php");

?>