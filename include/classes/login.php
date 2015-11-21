<?php

/* Необходим класс пользователь */
require_once 'user.php';

class Login
{
	public $user;

	function __construct() {
		$this->user = NULL;

		global $db;
		if (($_COOKIE['id']) && ($_COOKIE['password'])) {
			$query = 'SELECT password FROM achi_users WHERE id=' . $_COOKIE['id'];
			if (($data = $db->query($query)->fetch_assoc()) && ($_COOKIE['password'] == $data['password'])) {
				$this->user = new User($_COOKIE['id']);
			}
		}
	}
}

$login = new Login();

?>
