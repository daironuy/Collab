<?php 

class Login
{

	private $error = "";

	public function evaluate($data)
	{


		$email = $data['email'];
		$password = $data['password'];
		

		$query = "select * from users where email = '$email' limit 1 ";


		$DB = new Database();
		$result = $DB->read($query);


		if($result)
		{

			$row = $result[0];

			if($password == $row['password'])
			{
				
				$_SESSION['collab_userid'] = $row['userid'];

			}
			else
			{
				$this->error .= "no sush password was found";
			}

		}
		else
		{
			$this->error .= "no sush email was found";
		}
		

		return $this->error;


	}

	public function check_login($id)
	{


		$query = "select userid from users where userid = '$id' limit 1 ";


		$DB = new Database();
		$result = $DB->read($query);

		if($result)
		{

			return true;


		}

		return false;


	}

 
}