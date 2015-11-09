<?php

/* Необходим класс пользователь */
require_once 'user.php';

class Login
{
	public $user;

	public function __construct() {
		$user = NULL;

		global $db;
		if (($_COOKIE['id']) && ($_COOKIE['password'])) {
			$query = "SELECT password FROM achi_users WHERE id=" . $_COOKIE['id'];
			$data = $db->query($query)->fetch_assoc();

			if (($data) && ($_COOKIE['password'] == $data['password']))
				$user = new User($_COOKIE['id']);
		}
	}
}

$login = new Login();

?>
