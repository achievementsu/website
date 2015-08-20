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
	<h2>32 друга</h2>
	<h2>Исходящие заявки</h2>
</div>

<?php require_once 'include/static/footer.php'; ?>
