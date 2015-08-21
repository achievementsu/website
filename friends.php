<?php
	$title = 'Друзья';
	$current_page = 'friends';
	require_once 'include/functions.php';
	require_once 'include/static/header.php';
?>

<h1>Список друзей / результаты поиска</h1>
<div id="content-main-friends">
	<h2>Добавить друга</h2>
	<div>
		<form id="add-friend">
			<input type="textarea">
			<input type="submit" value="Поиск">
		</form>
	</div>
	<h2>Входящие заявки</h2>
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
	<h2>32 друга</h2>
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
	<h2>Исходящие заявки</h2>
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

<?php require_once 'include/static/footer.php'; ?>
