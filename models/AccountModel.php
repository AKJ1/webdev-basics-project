<?php 

namespace Models;
/**
* 
*/
class AccountModel extends BaseModel
{
	
	function __construct()
	{
		parent::__construct(array(
				'table' => 'users',
				'columns' => array('id, user_name, is_admin')
			));
		
	}

	public function login($user, $password){
		
		$hashed_password = hash_password($password, PASSWORD_BCRYPT);
		$statement = $this->dbconn->prepare('SELECT id, is_admin FROM users WHERE username = ? AND password = ?');
		$statement->bind_param('ss', $username, $hashed_password);

		$statement->execute();
		$result = $statement->get_result();

		if ($row = $result_set->fetch_assoc()) {					
			$_SESSION['user_id'] = $user_id;
			$_SESSION['username'] = $username;
			$_SESSION['is_admin'] = $is_admin;
		}

	}

	public function create_account($username, $password, $repeat, $email){
		

		$username = htmlspecialchars($username);
		$email = htmlspecialchars($email);
		$password = htmlspecialchars($password);
		$repeat = htmlspecialchars($repeat);

		if ($password == $repeat && isset($username) && isset($email)) {
			$valid = true;
			if (strlen($username) < 3) {
				die("Username must be atleast 3 characters long.");
				$valid = false;
			}
			if (strlen($email) < 3) {
				die("Email must be atleast 3 characters long.");
				$valid = false;
			}
			if (strlen($password) < 3) {
				die("password must be atleast 3 characters long.");
				$valid = false;
			}

			if ($valid) {
				$clean_user = mysql_real_escape_string($username);
				$clean_email = mysql_real_escape_string($email);
				$hashed_password = hash_password($password);
				$statement = $this->dbconn->prepare("INSERT INTO ('$table') (user_name, password_hash ,email) 
											   VALUES ('$username', '$hashed_password', '$email') ");
				$statement->execute();
				$result = $statement->get_result();

				var_dump($result);
			}
		}else{
			echo "please fill in all required fields.";
		}
	}
}

 ?>
