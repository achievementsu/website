<?php

require_once 'include/functions.php';

global $login;
if (!isset($login->user)) {
	header('Location: index.php');
}

$title = 'Профиль';
$current_page = 'profile';

Markup::pageStart();

?>

<h1>Профиль Diamond00744</h1>
<h2>Информация</h2>
<div class="section">
	<div class="avatar">
		<div class="level">99</div>
		<img src="storage/avatars/diamond00744.jpg">
	</div>
	<div class="profile-info">
		<div>Геродот Кузьмич Подкова, 25 лет</div>
		<div>Я не указал никакой информации о себе</div>
	</div>
</div>
<h2>Общая статистика</h2>
<div class="section profile-stats">
	<div>Достижений: 17</div>
	<div>Уровень: 99</div>
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
		<a href="achievements.php?id=diamond00744" class="center-button">Все достижения</a>
	</div>
</div>

<?php require_once 'include/static/footer.php'; ?>
