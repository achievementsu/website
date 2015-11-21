<?php

require_once 'include/functions.php';

global $login;
if (!isset($login->user)) {
	header('Location: index.php');
}

$title = 'Добавить достижение';
$current_page = 'add';
$showSidebar = true;

Markup::pageStart();

?>

<h1>Добавить новое достижение</h1>
<form class="inputform">
	<h2>Адресант достижения</h2>
	<div class="section">
			<div class="setting">
				<label class="setting-label" for="setting-to">Достижение для</label>
				<div class="setting-control">
					<input name="to" value="">
				</div>
			</div>
			<div class="setting">
				<label class="setting-label" for="setting-time">Достижение получил</label>
				<div class="setting-control">
					<input name="time" value="">
				</div>
			</div>
	</div>
	<h2>Подробности достижения</h2>
	<div class="section">
		<div class="setting">
			<label class="setting-label" for="setting-name">Название достижения</label>
			<div class="setting-control">
				<input name="name" value="">
			</div>
		</div>
		<div class="setting">
			<label class="setting-label" for="setting-description">Описание</label>
			<div class="setting-control">
				<input name="description" value="">
			</div>
		</div>
		<div class="setting">
			<label class="setting-label" for="setting-level">Выберите уровень достижения</label>
			<div class="setting-control">
				<input name="level" value="">
			</div>
		</div>
		<div class="setting">
			<label class="setting-label" for="setting-color">Выберите цвет достижения</label>
			<div class="setting-control">
				<input name="color" value="">
			</div>
		</div>
		<div class="actions">
			<input type="submit" name="send" value="Отправить">
		</div>
</form>

<?php require_once 'include/static/footer.php'; ?>
