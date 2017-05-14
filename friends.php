<?php

require_once 'include/functions.php';

global $login;
if (!isset($login->user)) {
	header('Location: index.php');
}

$title = 'Друзья';
$current_page = 'friends';
$showSidebar = true;

if (!$_POST['search'] && $_GET['act'] && $_GET['id'] && $_GET['id'] != $login->user->id) {
	global $listMessages;
	$user = new User($_GET['id']);
	if (isset($user->id)) {
		global $db;
		if ($_GET['act'] == 'add') {
			$db->query('INSERT INTO achi_friends (subscriber, subscribant) VALUES(' . $login->user->id . ', ' . $user->id . ')');
			if (User::isFriends($login->user->id, $user->id)) {
				$listMessages->addNotify('Вы и ' . $user->username . ' теперь друзья!');
			} else {
				$listMessages->addNotify('Вы отправили предложение дружбы ' . $user->username . '.');
			}
		}
		if ($_GET['act'] == 'delete') {
			$wasFriends = User::isFriends($login->user->id, $user->id);
			$db->query('DELETE FROM achi_friends WHERE subscriber = ' . $login->user->id . ' AND subscribant = ' . $_GET['id'] . ' LIMIT 1');
			if ($wasFriends) {
				$listMessages->addNotify('Вы больше не дружите с ' . $user->username . '.');
			} else {
				$listMessages->addNotify('Заявка дружбы к ' . $user->username . ' отменена.');
			}
		}
	}
}

function showUserBlock($id) {
	global $login;
	$user = new User($id);
	$subByLoggedIn = User::isSubscribers($login->user->id, $user->id);
	$subOnLoggedIn = User::isSubscribers($user->id, $login->user->id);
	?>
	<div class="userline">
		<div class="avatar">
			<div class="level"><?php echo $user->level; ?></div>
			<img src="<?php echo $user->avatar ?>">
		</div>
		<div class="actions">
			<?php if ($subByLoggedIn && $subOnLoggedIn) { ?>
			<a href="add.php?id=<?php echo $user->id; ?>">Выдать достижение</a>
			<?php } else if (!$subByLoggedIn && $subOnLoggedIn) { ?>
			<a href="friends.php?id=<?php echo $user->id; ?>&amp;act=add">Принять заявку в друзья</a>
			<?php } else if (!$subByLoggedIn && !$subOnLoggedIn) { ?>
			<a href="friends.php?id=<?php echo $user->id; ?>&amp;act=add">Отправить заявку в друзья</a>
			<?php } ?>
			<a href="profile.php?id=<?php echo $user->id; ?>">Подробнее</a>
			<?php if ($subByLoggedIn && $subOnLoggedIn) { ?>
			<a href="friends.php?id=<?php echo $user->id; ?>&amp;act=delete">Удалить из друзей</a>
			<?php } else if ($subByLoggedIn && !$subOnLoggedIn) { ?>
			<a href="friends.php?id=<?php echo $user->id; ?>&amp;act=delete">Отменить заявку в друзья</a>
			<?php } ?>
		</div>
		<div class="info">
			<div><a href="profile.php?id=<?php echo $user->id; ?>"><?php echo $user->username; ?></a></div>
			<div><?php echo $user->fullname; ?></div>
			<div><?php echo $user->description; ?></div>
		</div>
	</div>
	<?php
}

Markup::pageStart();

?>

<h1>Поиск</h1>
<h2>Найти друга</h2>
<div class="section">
	<form id="add-friend" method="POST">
		<input type="text" tabindex="1" maxlength="32" value="<?php echo $_POST['username']; ?>" name="username">
		<input type="submit" tabindex="2" value="Поиск" name="search">
	</form>
</div>

<?php
if ($_POST['search'] && $_POST['username']) {
	$data = $db->query('SELECT * FROM achi_users WHERE username LIKE "%' . $_POST['username'] . '%"');
?>

<h1>Результаты поиска</h1>
<div id="friends">
	<h2>Найдено: <?php echo $data->num_rows; ?></h2>
	<div class="section">
		<?php
		if ($data->num_rows) {
			while ($result = $data->fetch_assoc()) {
				if ($result['id'] != $login->user->id) {
					showUserBlock($result['id']);
				}
			}
		}
		?>
	</div>
</div>

<?php } else { ?>

<h1>Список друзей</h1>
<div id="friends">
	<?php
	$data = $db->query('SELECT * FROM achi_friends WHERE subscribant = ' . $login->user->id);
	if ($data->num_rows) {
	?>
	<h2>Входящие заявки</h2>
	<div class="section">
	<?php
		while ($result = $data->fetch_assoc()) {
			if (!User::isSubscribers($login->user->id, $result['subscriber'])) {
				showUserBlock($result['subscriber']);
			}
		}
	?>
	</div>
	<?php
	}

	$data = $db->query('SELECT * FROM achi_friends WHERE subscribant = ' . $login->user->id);
	if ($data->num_rows) {
	?>
	<h2>Друзья</h2>
	<div class="section">
	<?php
		while ($result = $data->fetch_assoc()) {
			if (User::isSubscribers($login->user->id, $result['subscriber'])) {
				showUserBlock($result['subscriber']);
			}
		}
	?>
	</div>
	<?php
	}

	$data = $db->query('SELECT * FROM achi_friends WHERE subscriber = ' . $login->user->id);
	if ($data->num_rows) {
	?>
	<h2>Исходящие заявки</h2>
	<div class="section">
	<?php
		while ($result = $data->fetch_assoc()) {
			if (!User::isSubscribers($result['subscribant'], $login->user->id)) {
				showUserBlock($result['subscribant']);
			}
		}
	?>
	</div>
	<?php
	}
}
require_once 'include/static/footer.php';
?>
