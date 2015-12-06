<?php

require_once 'include/functions.php';

global $login;
if (!isset($login->user)) {
	header('Location: index.php');
}

$title = 'Добавить достижение';
$current_page = 'add';
$showSidebar = true;

function sendAchievement() {
	global $login, $listMessages;

	// Валидность получателя
	if (!($_POST['to'] == $login->user->id || User::isFriends($login->user->id, $_POST['to']))) {
		$listMessages[] = array(
			'type' => 'error',
			'description' => 'Получатель достижения должен являться Вашим другом или Вами.'
		);
		return;
	}

	// Разбор даты
	if (!$_POST['time']) {
		$_POST['time'] = date('Y-m-d H:i:s', time()+($login->user->timezone * 3600));
	}
	if ($_POST['time'] && !strtotime($_POST['time'])) {
		$listMessages[] = array(
			'type' => 'error',
			'description' => 'Дата указана в неприемлемом формате. Рекомендуемый формат: ГГГГ-ММ-ДД ЧЧ:ММ:СС'
		);
		return;
	}
	if ($_POST['time'] && strtotime($_POST['time']) && (strtotime($_POST['time'])-($login->user->timezone * 3600) > time())) {
		$listMessages[] = array(
			'type' => 'error',
			'description' => 'Вы не можете отправлять достижения будущего :)<br>Время было возвращено на круги своя.'
		);
		$_POST['time'] = date('Y-m-d H:i:s', time()+($login->user->timezone * 3600));
		//$_POST['time'] = date('Y.m.d H:i:s', time()+($login->user->timezone * 3600));
		return;
	}

	if (!$_POST['name']) {
		$listMessages[] = array(
			'type' => 'error',
			'description' => 'Необходимо ввести название достижения.'
		);
		return;
	}
	if (!$_POST['description']) {
		$listMessages[] = array(
			'type' => 'error',
			'description' => 'Необходимо описать достижение.'
		);
		return;
	}

	if (
	!(strlen($_POST['color']) == 3 || strlen($_POST['color']) == 6) ||
	!preg_match("|^[0-9a-f]+$|i", $_POST['color'])
	) {
		$_POST['color'] = '000000';
	}
}

if (!$_POST['to']) {
	if (!($_POST['to'] = $_GET['id'])) {
		$_POST['to'] = $login->user->id;
	}
}
if ($_POST['level'] < 1) {
	$_POST['level'] = 1;
} elseif ($_POST['level'] > 10) {
	$_POST['level'] = 10;
}

if ($_POST['send']) {
	sendAchievement();
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
			<label class="setting-label" for="icon">Загрузите иконку достижения (64*64)</label>
			<div class="setting-control">
				<input type="hidden" name="MAX_FILE_SIZE" value="30000" />
				<input name="icon" type="file" />
			</div>
		</div>
		<div class="actions">
			<input type="submit" name="send" value="Отправить">
		</div>
</form>

<?php require_once 'include/static/footer.php'; ?>
