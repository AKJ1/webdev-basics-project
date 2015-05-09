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
		mysqli_report(MYSQLI_REPORT_ALL);
	}

	public function login($username, $password){
		
		$username = mysql_real_escape_string($username);
		
		$statement = $this->dbconn->prepare('SELECT password_hash, id, is_admin FROM users WHERE user_name = ?');
		$statement->bind_param('s', $username );

		

		$statement->execute();
		$result = $statement->get_result();

		
		if ($row = $result->fetch_assoc()) {					
			if (password_verify($password, $row['password_hash'])) {
				session_start();
				$_SESSION['user_id'] = $row['id'];
				$_SESSION['user_name'] = $username;
				$_SESSION['is_admin'] = $row['is_admin'];
			}else{
				echo "UNSUCESSFUL LOGIN! Wrong password.";	
			}			
		}else{
			echo "UNSUCESSFUL LOGIN! The account doesnt exist.";
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
				$hashed_password = password_hash($password, PASSWORD_BCRYPT);
				$statement = $this->dbconn->prepare("INSERT INTO $this->table (user_name, password_hash ,email) 
											   VALUES ('$username', '$hashed_password', '$email') ");
				$statement->execute();
				$result = $statement->get_result();

				if ($result == false) {
					echo "Sucessful registration, please <a href='/Account/Login'>Login</a>"; 
				}
			}
		}else{
			echo "please fill in all required fields.";
		}
	}
}

 ?>
