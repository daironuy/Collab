<?php

include("header.php");


?>

  <div id="bar1">
    <h2>Inbox</h2>

    <table>
      <tr>
        <!-- <th>File Name</th> -->
        <th>From:</th>
        <th>Subject</th>
        <th>Date</th>
        <th>Operation</th>
      </tr>
      <?php

      include("php/inbox.php");

      ?>



    </table>
    <br><br>

    <!-- <form method="post" enctype="multipart/form-data">
    <input  name="file_1" type="text" id="text1" placeholder="Type here"><br><br>
    <button id="button" type="submit" name="delete">Delete</button>
    </form> -->

  </div>


  </body>
</html>