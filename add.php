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
	global $db, $login, $listMessages;

	// Валидность получателя
	if (!($_POST['to'] == $login->user->id || User::isFriends($login->user->id, $_POST['to']))) {
		$listMessages[] = array(
			'type' => 'error',
			'description' => 'Получатель достижения должен являться Вашим другом или Вами.'
		);
		return false;
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
		return false;
	}
	if ($_POST['time'] && strtotime($_POST['time']) && (strtotime($_POST['time'])-($login->user->timezone * 3600) > time())) {
		$listMessages[] = array(
			'type' => 'error',
			'description' => 'Вы не можете отправлять достижения будущего :)<br>Время было возвращено на круги своя.'
		);
		$_POST['time'] = date('Y-m-d H:i:s', time()+($login->user->timezone * 3600));
		return false;
	}

	if (!$_POST['name']) {
		$listMessages[] = array(
			'type' => 'error',
			'description' => 'Необходимо ввести название достижения.'
		);
		return false;
	}
	if (!$_POST['description']) {
		$listMessages[] = array(
			'type' => 'error',
			'description' => 'Необходимо описать достижение.'
		);
		return false;
	}

	if (
	!(strlen($_POST['color']) == 3 || strlen($_POST['color']) == 6) ||
	!preg_match("|^[0-9a-f]+$|i", $_POST['color'])
	) {
		$_POST['color'] = '000000';
	}

	if (
	!isset($_FILES['icon']['error']) ||
	is_array($_FILES['icon']['error'])
	) {
		$listMessages[] = array(
			'type' => 'error',
			'description' => 'Ошибка загрузки иконки: неподобающие параметры...'
		);
		return false;
	}
	switch ($_FILES['icon']['error']) {
		case UPLOAD_ERR_OK: break;
		case UPLOAD_ERR_NO_FILE: $listMessages[] = array(
			'type' => 'error',
			'description' => 'Ошибка загрузки иконки: файл не был отправлен...'
		);
		return false;
		case UPLOAD_ERR_INI_SIZE:
		case UPLOAD_ERR_FORM_SIZE: $listMessages[] = array(
			'type' => 'error',
			'description' => 'Ошибка загрузки иконки: превышен максимальный размер...'
		);
		return false;
		default: $listMessages[] = array(
			'type' => 'error',
			'description' => 'Ошибка загрузки иконки: неизвестная ошибка...'
		);
		return false;
	}

	if ($_FILES['icon']['size'] > 100000) {
		$listMessages[] = array(
			'type' => 'error',
			'description' => 'Ошибка загрузки иконки: превышен максимальный размер...'
		);
		return false;
	}

	$size = getimagesize($_FILES['icon']['tmp_name']);
	$mime = $size['mime'];
	switch ($mime) {
		case 'image/jpeg': $ext = 'jpg'; break;
		case 'image/png': $ext = 'png'; break;
		case 'image/gif': $ext = 'gif'; break;
		default:
		$listMessages[] = array(
			'type' => 'error',
			'description' => 'Ошибка загрузки иконки: файл не является изображением.'
		);
		return false;
	}
	if ($size[0] != 64 || $size[1] != 64) {
		$listMessages[] = array(
			'type' => 'error',
			'description' => 'Ошибка загрузки иконки: размер изображения отличается от 64*64.'
		);
		return false;
	}

	// http://php.net/manual/ru/features.file-upload.php
	/*$finfo = new finfo(FILEINFO_MIME_TYPE);
	if (false === $ext = array_search(
		$finfo->file($_FILES['icon']['tmp_name']),
		array(
			'jpg' => 'image/jpeg',
			'png' => 'image/png',
			'gif' => 'image/gif',
		),
		true
	)) {
		$listMessages[] = array(
			'type' => 'error',
			'description' => 'Ошибка загрузки файла: формат файла неприемлем...'
		);
		return false;
	}*/

	$fileName = sprintf('%s.%s',
		//sha1_file($_FILES['icon']['tmp_name']),
		generateRandomString(20),
		$ext
	);

	if (!move_uploaded_file(
		$_FILES['icon']['tmp_name'], 'storage/icons/' . $fileName
	)) {
		$listMessages[] = array(
			'type' => 'error',
			'description' => 'Ошибка загрузки иконки: не удалось переместить загруженный файл...'
		);
		return false;
	}

	$timeset = date('Y-m-d H:i:s', strtotime($_POST['time'])-($login->user->timezone * 3600));
	$timesent = date('Y-m-d H:i:s', time());

	$query = 'INSERT INTO achi_achievements (`from`, `to`, `status`, `name`, `description`, `color`, `time_sent`, `time_set`, `level`, `image`) ';
	$query .= 'VALUES("' . $login->user->id . '", "' . $_POST['to'] . '", "1", "' . $_POST['name'] . '", "' . $_POST['description'] . '", ';
	$query .= '"' . $_POST['color'] . '", "' . $timesent . '", "' . $timeset . '", "' . $_POST['level'] . '", "' . $fileName . '")';
	if ($db->query($query)) {
		$listMessages[] = array(
			'type' => 'success',
			'description' => 'Достижение успешно отправлено!'
		);
		return true;
	}

	return false;
}

function showSendList() {
	global $db, $login;
	echo '<select name="to" required>';
	echo '<option value="' . $login->user->id . '"';
	if (!$_GET['id']) {
		echo ' selected';
	}
	echo '>' . $login->user->username . "</option>\n";

	$query = 'SELECT id, username FROM achi_users WHERE';
	$query .= '(achi_users.id IN (SELECT subscriber FROM achi_friends WHERE subscribant = ' . $login->user->id . ')) AND';
	$query .= '(achi_users.id IN (SELECT subscribant FROM achi_friends WHERE subscriber = ' . $login->user->id . '))';

	$result = $db->query($query);
	while ($data = $result->fetch_assoc()) {
		echo '<option value="' . $data['id'] . '"';
		if ($_GET['id'] == $data['id']) {
			echo ' selected';
		}
		echo '>' . $data['username'] . "</option>";
	}

	echo '</select>';
}

if (!$_POST['to']) {
	if (!($_POST['to'] = $_GET['id'])) {
		$_POST['to'] = $login->user->id;
	}
}
if ($_POST['level'] > 10) {
	$_POST['level'] = 10;
} elseif ($_POST['level'] < 1 || (!preg_match("|^[0-9]+$|i", $_POST['level']))) {
	$_POST['level'] = 1;
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
					<?php showSendList(); ?>
				</div>
			</div>
			<div class="setting">
				<label class="setting-label" for="time">Достижение получил</label>
				<div class="setting-control">
					<input name="time" type="datetime" value="<?php echo $_POST['time']; ?>">
				</div>
			</div>
	</div>
	<h2>Подробности достижения</h2>
	<div class="section">
		<div class="setting">
			<label class="setting-label" for="name">Название достижения</label>
			<div class="setting-control">
				<input name="name" required value="<?php echo $_POST['name']; ?>">
			</div>
		</div>
		<div class="setting">
			<label class="setting-label" for="description">Описание</label>
			<div class="setting-control">
				<input name="description" required value="<?php echo $_POST['description']; ?>">
			</div>
		</div>
		<div class="setting">
			<label class="setting-label" for="level">Выберите уровень достижения</label>
			<div class="setting-control">
				<select name="level" required>
					<option value="1"<?php if ($_POST['level'] == 1) { echo ' selected'; }?>>1: Незначительное достижение-однодневка</option>
					<option value="2"<?php if ($_POST['level'] == 2) { echo ' selected'; }?>>2: Труд нескольких дней</option>
					<option value="3"<?php if ($_POST['level'] == 3) { echo ' selected'; }?>>3: Уже месяц...</option>
					<option value="4"<?php if ($_POST['level'] == 4) { echo ' selected'; }?>>4: Уже несколько месяцев...</option>
					<option value="5"<?php if ($_POST['level'] == 5) { echo ' selected'; }?>>5: Уже полгода...</option>
					<option value="6"<?php if ($_POST['level'] == 6) { echo ' selected'; }?>>6: Поднялся на ступеньку по лестнице жизни</option>
					<option value="7"<?php if ($_POST['level'] == 7) { echo ' selected'; }?>>7: Крупное жизненное достижение</option>
					<option value="8"<?php if ($_POST['level'] == 8) { echo ' selected'; }?>>8: Очень крупное жизненное достижение</option>
					<option value="9"<?php if ($_POST['level'] == 9) { echo ' selected'; }?>>9: Огромный жизненный результат</option>
					<option value="10"<?php if ($_POST['level'] == 10) { echo ' selected'; }?>>10: Предельно глобальное достижение</option>
				</select>
			</div>
		</div>
		<div class="setting">
			<label class="setting-label" for="color">Выберите цвет достижения<br>(в HEX формате без #)</label>
			<div class="setting-control">
				<input name="color" value="<?php echo $_POST['color']; ?>">
			</div>
		</div>
		<div class="setting">
			<label class="setting-label" for="icon">Загрузите иконку достижения<br>(размер изображения: 64*64)</label>
			<div class="setting-control">
				<input type="hidden" name="MAX_FILE_SIZE" value="100000">
				<input name="icon" type="file" required>
			</div>
		</div>
		<div class="actions">
			<input type="submit" name="send" value="Отправить">
		</div>
</form>

<?php require_once 'include/static/footer.php'; ?>
