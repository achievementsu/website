<?php

global $_POST;

if (isset($_POST['register'])) {
	User::register($_POST['email'], $_POST['password']);
}

if (isset($_POST['login'])) {
	User::login($_POST['email'], $_POST['password']);
}

?>
