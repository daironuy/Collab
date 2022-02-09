<?php

class Database
{

	private $host = "localhost";
	private $username = "root";
	private $password = "";
	private $db = "collab_db";
 
	function connect()
	{

		$connection = mysqli_connect($this->host,$this->username,$this->password,$this->db);
		return $connection;
	}

	function read($query)
	{
		$conn = $this->connect();
		$result = mysqli_query($conn,$query);

		if(!$result)
		{
			echo "ayaw";
			return false;
		}
		else
		{
			$data = false;
			while($row = mysqli_fetch_assoc($result))
			{

				$data[] = $row;

			}

			return $data;
		}
	}

	function save($query)
	{
		$conn = $this->connect();
		$result = mysqli_query($conn,$query);

		if(!$result)
		{
			echo "ayaw";
			return false;
		}else
		{
			return true;
		}
	}

}


//$host = "localhost";
//$username = "root";
//$password = "";
//$db = "collab_db";


//$connection = mysqli_connect($host,$username,$password,$db);

//$userid = "123456";
//$first_name = "she";
//$last_name = "ako";
//$organization = "DSC";
//$department = "CCMS";
//$position = "President";
//$email = "lo@gmail.com";
//$password = "123";
////$url_address = "she.ako";


//$query = "insert into 
//		users
//		(userid,first_name,last_name,organization,department,position,email,password) 
//		values 
//		('$userid','$first_name','$last_name','$organization','$department','$position','$email','$password')";
//$query = "insert into users (first_name,last_name) values ('$first_name','$last_name')";

//mysqli_query($connection,$query);


//$DB = new Database();
//$data = $DB->save($query);

//echo "we";