<?php

include("header.php");


include("php/view_send.php");

?>

		<div id="bar1">
			
			<button><a href='http://localhost/collab/send_file.php'>BACK</a></button>
			<br><br>

			Send tp Details<br><br>

		    <table>
		    <tr>
		      <th>To:</th>
		      <th>Subject</th>
		      <th>Message</th>
		      <th>File</th>
		      <th>date</th>
		    </tr>

		    <tr>
		      <td><?php echo $M?></td>
		      <td><?php echo $Dsub?></td>
		      <td><?php echo $Dmes?></td>
		      <td><?php echo "<a href='php/download_send.php?id=" . $id . "'>" . $Dname . "</a>"?></td>
		      <td><?php echo $date?></td>
		    </tr>
				

					

			</table>
		<div/>

<?php

include("footer.php");

?>