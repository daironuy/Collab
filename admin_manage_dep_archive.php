<?php

include("header.php");


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
  <h2>Department Archive Table</h2>

  <button><a href='admin_manage_dep_archive_table.php?dep=ccms'>CCMS</a></button>
      <br><br>
  <button><a href='admin_manage_dep_archive_table.php?dep=ceng'>CENG</a></button>
  <br><br>
  <button><a href='admin_manage_dep_archive_table.php?dep=ucsc'>UCSC</a></button>
  <br><br>

  <!-- <table>
    <tr>
      <th>File</th>
      <th>Date</th>
      <th></th>
    </tr>

  </table>
  <br><br> -->

</div>


<?php

include("footer.php");

?>