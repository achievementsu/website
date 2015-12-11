<?php

require_once 'include/functions.php';

global $_POST;
if (isset($_POST['login'])) {
	if (($id = User::isValid($_POST['email'], $_POST['password'])) > 0) {
		$user = new User($id);
		if ($_POST['remember']) {
			$cookieTime = time()+60*60*24*30;
		} else {
			$cookieTime = 0;
		}
		setcookie('id', $user->id, $cookieTime);
		setcookie('password', $user->password, $cookieTime);
		header('Location: feed.php');
	}
}

global $login;
if (isset($login->user)) {
	header('Location: feed.php');
}

$title = 'Добро пожаловать';
$current_page = 'index';
$showSidebar = true;

Markup::pageStart();

?>

<h1>Добро пожаловать!</h1>
<div class="section">
	<p><strong>Achievement.su</strong> - это сайт, где вы можете хранить свои достижения, а также вручать достижения друзьям.</p>
</div>

<?php

Markup::pageEnd();

?>
