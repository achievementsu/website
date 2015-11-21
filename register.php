<?php

require_once 'include/functions.php';

global $_POST;
if (isset($_POST['register'])) {
	if ($_POST['password'] == $_POST['password-repeat']) {
		User::register($_POST['email'], $_POST['password']);
	} else {
		global $listMessages;
		$listMessages[] = array(
			'type' => 'error',
			'description' => 'Пароли не совпадают'
		);
	}
}

global $login;
if (isset($login->user)) {
	header('Location: feed.php');
}

$title = 'Регистрация';
$current_page = 'register';
$showSidebar = false;

Markup::pageStart();

?>

<h1>Регистрация на сервисе</h1>
<form class="inputform" method="POST">
	<h2>Основные данные</h2>
	<div class="section">
		<div class="setting">
			<label class="setting-label" for="email">Адрес электронной почты</label>
			<div class="setting-control">
				<input type="text" tabindex="1" maxlength="50" name="email">
			</div>
		</div>
		<div class="setting">
			<label class="setting-label" for="password">Пароль</label>
			<div class="setting-control">
				<input type="password" tabindex="2" minlength="3" maxlength="50" autocomplete="off" name="password">
			</div>
		</div>
		<div class="setting">
			<label class="setting-label" for="password-repeat">Повтор пароля</label>
			<div class="setting-control">
				<input type="password" tabindex="3" minlength="3" maxlength="50" autocomplete="off" name="password-repeat">
			</div>
		</div>
	</div>
	<h2>Прочие данные</h2>
	<div class="section">
		<div class="actions">
			<input type="submit" tabindex="4" name="register" value="Регистрация">
		</div>
	</div>

</form>

<?php

Markup::pageEnd();

?>
