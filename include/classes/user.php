<?php

/* Пользователь */
class User
{
	public $id;
	public $username;
	public $password;
	public $email;
	public $email_confirmed;
	public $registration_time;
	public $level;
	public $timezone;
	public $birthday;
	public $description;

	/* Конструктор класса по ID пользователя */
	public function __construct($id) {
		global $db;

		$query = "SELECT * FROM achi_users WHERE id=$id";
		if ($data = $db->query($query)->fetch_assoc()) {
			$id                = $data['id'];
			$username          = $data['username'];
			$password          = $data['password'];
			$email             = $data['email'];
			$email_confirmed   = $data['email_confirmed'];
			$registration_time = $data['registration_time'];
			$level             = $data['level'];
			$timezone          = $data['timezone'];
			$birthday          = $data['birthday'];
			$description       = $data['description'];
			$data->free();
		}
	}

	/* Регистрация пользователя */
	public static function register($username, $password, $email) {
		global $db;

		if (strlen($username) < 4) {
			return false;
		}
		if (strlen($password) < 6) {
			return false;
		}
		if (strlen($email) > 60 || !preg_match("|^[-0-9a-z_\.]+@[-0-9a-z_^\.]+\.[a-z]{2,6}$|i", $email)) {
			return false;
			//$err[] = "E-mail введён некорректно!";
		}
		$query = "SELECT username, email FROM achi_users WHERE username = $username";
		if ($db->query($query)->fetch_assoc()) {
			return false; //Это имя пользователя уже было
		}
		$query = "SELECT username, email FROM achi_users WHERE email = $email";
		if ($db->query($query)->fetch_assoc()) {
			return false; //Email уже занят
		}

		$password = password_hash($password, PASSWORD_DEFAULT);
		$query = "INSERT INTO achi_users (username, password, email, registration_time) VALUES('$username', '$password', '$email', '" . date('Y.m.d H:i:s') . "')";
		if ($db->query($query)) {
			return true;
		}
		return false;
	}
}

?>
