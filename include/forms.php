<?php

global $_POST;

if (isset($_POST['register'])) {
	User::register($_POST['email'], $_POST['password']);
}

if (isset($_POST['login'])) {
	if (($id = User::isValid($_POST['email'], $_POST['password'])) > 0) {
		$user = new User($id);
		setcookie('id', $user->id, 0);
		setcookie('password', $user->password, 0);
	} else {
		setcookie('id', '', time()-3600);
		setcookie('password', '', time()-3600);
	}
}

?>
