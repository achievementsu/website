<?php
	$title = 'Друзья';
	$current_page = 'friends';
	require 'include/header.php';
?>

<h1>Список друзей / результаты поиска</h1>
<div id="content-main-friends">
	<h2>Добавить друга</h2>
	<form id="add-friend">
		<input type="textarea"></input>
		<input type="submit" value="Поиск"></input>
	</form>
	<h2>Входящие заявки</h2>
	<h2>32 друга</h2>
	<h2>Исходящие заявки</h2>
</div>

<?php
	require 'include/footer.php';
?>
