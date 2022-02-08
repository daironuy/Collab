<?php 

class Register
{

	private $error = "";

	public function evaluate($data)
	{

		foreach ($data as $key => $value) 
		{
			
			if(empty($value))
			{
				$this->error = $this->error . $key . " is empty!<br><br>";
			}

		}

		if($this->error == "")
		{
			$this->create_user($data);
		}
		else
		{
			return $this->error;
		}
			

	}

	public function create_user($data)
	{

		$first_name = $data['first_name'];
		$last_name = $data['last_name'];
		$organization = $data['organization'];
		$department = $data['department'];
		$position = $data['position'];
		$email = $data['email'];
		$password = $data['password'];
		
		//create these
		//$url_address = strtolower($first_name) . "_" . strtolower($last_name);
		$userid = $this->create_userid();

		$query = "insert into users (userid,first_name,last_name,organization,department,position,email,password) values ('$userid','$first_name','$last_name','$organization','$department','$position','$email','$password')";


		echo $query;
		$DB = new Database();
		$data = $DB->save($query);
	}
 
	private function create_userid()
	{

		$length = rand(4,19);
		$number = "";
		for ($i=0; $i < $length; $i++) 
		{ 
			# code...
			$new_rand = rand(0,9);

			$number = $number . $new_rand;
		}

		return $number;
	}
}