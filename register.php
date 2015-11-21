<?php

require_once 'include/functions.php';

global $login;
if (isset($login->user)) {
	header('Location: feed.php');
}

$title = 'Регистрация';
$current_page = 'register';

Markup::pageStart();

?>

<h1>Регистрация на сервисе</h1>
<form id="register-form" name="register" method="POST">
	<input id="email" type="text" tabindex="1" maxlength="50" name="email" placeholder="Адрес электронной почты"><br>
	<input id="password" type="password" tabindex="2" minlength="3" maxlength="50" autocomplete="off" name="password" placeholder="Пароль"><br>
	<input id="submit-button" type="submit" tabindex="4" name="register" value="Регистрация">
</form>

<?php

Markup::pageEnd();

?>
