<?php

include("header.php");

//include("php/send_file.php");

?>

		<!-- <div id="bar1">
			
			Send File<br><br>

			<form method="post" enctype="multipart/form-data">

				<span style="font-weight: normal;">Organization:</span><br>
				<select id="text" name="organization">
					
					<option></option>
					<option>DSC</option>
					<option>UCSC</option>

				</select>
				<br><br>
				
				<span style="font-weight: normal;">Department:</span><br>
				<select id="text" name="department">
					
					<option></option>
					<option>CCMS</option>
					<option>CENG</option>
					<option>CBA</option>
					<option>CAFA</option>
					<option>CAS</option>
					<option>CCJC</option>
					<option>CE</option>
					<option>CIHTM</option>
					<option>CME</option>
					<option>CNAHS</option>

				</select>
				<br><br>
				
				<span style="font-weight: normal;">Position:</span><br>
				
				<select id="text" name="position">
					
					<option></option>
					<option>President</option>
					<option>Vice-Precident</option>
					<option>Secretary</option>
					<option>Treasurer</option>
					<option>Auditor</option>

				</select>
				<br><br>
				Subjet:<br><br>
				<input  name="subject" type="text" id="text" placeholder="Type here"><br><br>
				
				Message:<br><br>
				<input  name="message" type="text" id="text1" placeholder="Type here"><br><br>

				<div>
				<input type="file" name="file"/>
			      <br><br>
			      <input type="submit" id="button" value="Send" name="send">
				<br><br><br>
				</div>
					

			</form>

		</div> -->

		<div id="bar1">
		  <h2>Send History</h2>

		  <button><a href='http://localhost/collab/compose.php'>Compose</a></button>
			<br><br>

		  <table>
		    <tr>
		      <th>To:</th>
		      <th>Subject</th>
		      <th>Date</th>
		      <th>Operation</th>
		    </tr>

		  <?php

		  include("php/send_history.php");

		  ?>

		  </table>
		  <br><br>
		</div>

<?php

include("footer.php");

?>