<?php


include("header.php");
include("php/archive.php");

?>
  <div id="bar1">

    Archive<br><br>
    <form method="post" enctype="multipart/form-data">

      
      <!-- Type File Name<br><br> -->
      <!-- <input  name="text" type="text" id="text1" placeholder="Type here"><br><br> -->
      <input type="file" name="file"/>
      <br><br>
      <button id="button" type="submit" name="upload">Upload</button>
   
    </form>
  </div>

<div id="bar1">
  <h2>Table of Archive</h2>

  <table>
    <tr>
      <!-- <th>File Name</th> -->
      <th>File</th>
      <th>Date</th>
      <th>Operation</th>
    </tr>

  <?php

  include("php/table_archive.php");
  //include("php/delete_archive.php");

  ?>

  </table>
  <br><br>


<?php

include("footer.php");

?>