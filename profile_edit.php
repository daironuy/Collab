<?php

include("header.php");
include("php/profile_edit.php");


?>


<div id="bar1">
  
<button><a href="http://localhost/collab/profile.php">Back</a></button>

  <h2>Account Information</h2>

  <div id="bar">
      
      <form method="post">

        Username<br><br>
        <input value="<?php echo $use;?>" name="username" type="text" id="text" placeholder="<?php echo $use;?>"><br><br>
        
        Password<br><br>
        <input value="<?php echo $pass;?>" name="password" type="text" id="text" placeholder="<?php echo $pass;?>"><br><br>

        <button name="save" type="submit">Save</button>
        <br><br><br>

      </form>
    </div>

</div>


<?php


include("footer.php");


?>

