<?php

require_once 'include/functions.php';

global $login;
if (!isset($login->user)) {
	header('Location: index.php');
}

if ((isset($_GET['id'])) && ($_GET['id']) != $login->user->id) {
	$user = new User($_GET['id']);
	$title = 'Профиль ' . $user->username;
} else {
	$user = $login->user;
	$title = 'Мой профиль';
	$current_page = 'profile';
}
$showSidebar = true;

if(!isset($user->id)) {
	$title = 'Нет такого профиля';
	global $listMessages;
	$listMessages[] = array(
		'type' => 'error',
		'title' => 'Ошибка',
		'description' => 'Пользователя с данным ID не существует :('
	);
	Markup::pageStart();
} else {
	Markup::pageStart();
?>

<h1>Профиль: <?php echo $user->username; ?></h1>
<h2>Информация</h2>
<div class="section">
	<div class="avatar">
		<div class="level"><?php echo $user->level; ?></div>
		<img src="storage/avatars/<?php echo $user->id; ?>.jpg">
	</div>
	<div class="profile-info">
		<div><?php echo $user->fullname; ?>, <?php echo $user->birthday; ?></div>
		<div><?php
		if ($user->description) {
			echo $user->description;
		} else {
			echo 'Я ещё не оставил информации о себе.';
		} ?></div>
	</div>
</div>
<h2>Общая статистика</h2>
<div class="section profile-stats">
	<div>Достижений: <?php echo $user->achievement_count; ?></div>
	<div>Уровень: <?php echo $user->level; ?></div>
</div>
<h2>Последние достижения</h2>
<div class="section achievements-list">
	<div class="achievement-full">
		<div class="icon">
			<img src="storage/icons/randomcode.jpg">
		</div>
		<div class="info">
			<div class="name">Яки Иезус</div>
			<div class="description">С днём рождения!</div>
			<div class="meta">
				<div class="level">Уровень: 1</div>
				<div class="sender">Прислал: The God</div>
				<div class="time">25 декабря 0 года (получено 7 января 1 года)</div>
			</div>
		</div>
	</div>
	<div class="achievement-full">
		<div class="info">
			<div class="name">И таких всего на этой странице пять</div>
		</div>
	</div>
	<div class="center-buttons">
		<a href="achievements.php?id=<?php echo $user->id; ?>" class="center-button">Все достижения</a>
	</div>
</div>

<?php
}
require_once 'include/static/footer.php';
?>
