<?php

require_once 'include/functions.php';

global $login;
if (!isset($login->user)) {
	header('Location: index.php');
}

$title = 'Добавить достижение';
$current_page = 'add';
$showSidebar = true;

if (!$_POST['to']) {
	if (!($_POST['to'] = $_GET['id'])) {
		$_POST['to'] = $login->user->id;
	}
}
if (!$_POST['level']) {
	$_POST['level'] = 1;
}
if (!$_POST['color']) {
	$_POST['color'] = '000000';
}
if (!$_POST['time']) {
	$_POST['time'] = date('Y.m.d H:i:s', time()+($login->user->timezone * 3600));
}

if ($_POST['send'] && ($_POST['to'] == $login->user->id || User::isFriends($login->user->id, $_POST['to']))) {
	$listMessages[] = array(
		'type' => 'success',
		'description' => 'Достижение отправлено!'
	);
} elseif ($_POST['send']) {
	$_POST['to'] = $login->user->id;
	$listMessages[] = array(
		'type' => 'error',
		'description' => 'Невозможно отправить достижение для этого человека.'
	);
}

Markup::pageStart();

?>

<h1>Добавить новое достижение</h1>
<form class="inputform" enctype="multipart/form-data" method="POST">
	<h2>Адресант достижения</h2>
	<div class="section">
			<div class="setting">
				<label class="setting-label" for="to">Достижение для</label>
				<div class="setting-control">
					<input name="to" value="<?php echo $_POST['to']; ?>">
				</div>
			</div>
			<div class="setting">
				<label class="setting-label" for="time">Достижение получил</label>
				<div class="setting-control">
					<input name="time" value="<?php echo $_POST['time']; ?>">
				</div>
			</div>
	</div>
	<h2>Подробности достижения</h2>
	<div class="section">
		<div class="setting">
			<label class="setting-label" for="name">Название достижения</label>
			<div class="setting-control">
				<input name="name" value="<?php echo $_POST['name']; ?>">
			</div>
		</div>
		<div class="setting">
			<label class="setting-label" for="description">Описание</label>
			<div class="setting-control">
				<input name="description" value="<?php echo $_POST['description']; ?>">
			</div>
		</div>
		<div class="setting">
			<label class="setting-label" for="level">Выберите уровень достижения</label>
			<div class="setting-control">
				<input name="level" value="<?php echo $_POST['level']; ?>">
			</div>
		</div>
		<div class="setting">
			<label class="setting-label" for="color">Выберите цвет достижения</label>
			<div class="setting-control">
				<input name="color" value="<?php echo $_POST['color']; ?>">
			</div>
		</div>
		<div class="setting">
			<label class="setting-label" for="iconfile">Загрузите иконку достижения (64*64)</label>
			<div class="setting-control">
				<input type="hidden" name="MAX_FILE_SIZE" value="30000" />
				<input name="iconfile" type="file" />
			</div>
		</div>
		<div class="actions">
			<input type="submit" name="send" value="Отправить">
		</div>
</form>

<?php require_once 'include/static/footer.php'; ?>
