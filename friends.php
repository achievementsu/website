<?php

require_once 'include/functions.php';

global $login;
if (!isset($login->user)) {
	header('Location: index.php');
}

$title = 'Друзья';
$current_page = 'friends';
$showSidebar = true;

Markup::pageStart();

global $_POST;
if ($_POST['search'] && $_POST['username']) { ?>

<h1>Результаты поиска</h1>
<div id="friends">
	<h2>Найдено: </h2>
	<div class="section">
		<div class="userline">
			<div class="avatar">
				<div class="level">49</div>
				<img src="storage/avatars/tippa44007.jpg">
			</div>
			<div class="actions">
				<a href="add.php">Выдать достижение</a>
				<a href="profile.php">Подробнее</a>
				<a href="profile.php?act=delete">Удалить</a>
			</div>
			<div class="info">
				<div><a href="profile.php?id=1">tippa44007</a></div>
				<div>lalalalalalala</div>
			</div>
		</div>
		<div class="userline">
			<div class="avatar">
				<div class="level">84</div>
				<img src="storage/avatars/lirrick.jpg">
			</div>
			<div class="actions">
				<a href="add.php">Выдать достижение</a>
				<a href="profile.php">Подробнее</a>
				<a href="profile.php?act=delete">Удалить</a>
			</div>
			<div class="info">
				<div><a href="profile.php?id=1">Lirrick</a></div>
				<div>lalalalalalala</div>
			</div>
		</div>
	</div>
</div>

<?php } else { ?>

<h1>Список друзей</h1>
<div id="friends">
	<h2>Добавить друга</h2>
	<div class="section">
		<form id="add-friend" method="POST">
			<input type="text" tabindex="1" maxlength="32" name="username">
			<input type="submit" tabindex="2" value="Поиск" name="search">
		</form>
	</div>
	<h2>Входящие заявки</h2>
	<div class="section">
		<div class="userline">
			<div class="avatar">
				<div class="level">49</div>
				<img src="storage/avatars/tippa44007.jpg">
			</div>
			<div class="actions">
				<a href="profile.php?act=accept">Принять</a>
				<a href="profile.php">Подробнее</a>
				<a href="profile.php?act=delete">Удалить</a>
			</div>
			<div class="info">
				<div><a href="profile.php?id=1">tippa44007</a></div>
				<div>lalalalalalala</div>
			</div>
		</div>
	</div>
	<h2>32 друга</h2>
	<div class="section">
		<div class="userline">
			<div class="avatar">
				<div class="level">49</div>
				<img src="storage/avatars/tippa44007.jpg">
			</div>
			<div class="actions">
				<a href="add.php">Выдать достижение</a>
				<a href="profile.php">Подробнее</a>
				<a href="profile.php?act=delete">Удалить</a>
			</div>
			<div class="info">
				<div><a href="profile.php?id=1">tippa44007</a></div>
				<div>lalalalalalala</div>
			</div>
		</div>
		<div class="userline">
			<div class="avatar">
				<div class="level">84</div>
				<img src="storage/avatars/lirrick.jpg">
			</div>
			<div class="actions">
				<a href="add.php">Выдать достижение</a>
				<a href="profile.php">Подробнее</a>
				<a href="profile.php?act=delete">Удалить</a>
			</div>
			<div class="info">
				<div><a href="profile.php?id=1">Lirrick</a></div>
				<div>lalalalalalala</div>
			</div>
		</div>
	</div>
	<h2>Исходящие заявки</h2>
	<div class="section">
		<div class="userline">
			<div class="avatar">
				<div class="level">49</div>
				<img src="storage/avatars/tippa44007.jpg">
			</div>
			<div class="actions">
				<a href="profile.php?act=delete">Отменить заявку</a>
				<a href="profile.php">Подробнее</a>
			</div>
			<div class="info">
				<div><a href="profile.php?id=1">tippa44007</a></div>
				<div>lalalalalalala</div>
			</div>
		</div>
	</div>
</div>

<?php }
require_once 'include/static/footer.php'; ?>
