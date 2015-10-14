<?php
	$title = 'Добавить достижение';
	$current_page = 'add';
	require_once 'include/functions.php';
	require_once 'include/static/header.php';
?>

<h1>Добавить новое достижение</h1>
<form id="add" class="add">
	<h2>Адресант достижения</h2>
	<div class="section">
			<div class="setting">
				<label class="setting-label" for="setting-to">Достижение для</label>
				<div class="setting-control">
					<input id="setting-to" name="achievement[to]" value="">
				</div>
			</div>
					<div class="setting">
						<label class="setting-label" for="setting-time">Достижение получил</label>
						<div class="setting-control">
							<input id="setting-time" name="achievement[time]" value="">
						</div>
					</div>
	</div>
	<h2>Подробности достижения</h2>
	<div class="section">
		<div class="setting">
			<label class="setting-label" for="setting-name">Название достижения</label>
			<div class="setting-control">
				<input id="setting-name" name="achievement[name]" value="">
			</div>
		</div>
		<div class="setting">
			<label class="setting-label" for="setting-description">Описание</label>
			<div class="setting-control">
				<input id="setting-description" name="achievement[description]" value="">
			</div>
		</div>
		<div class="setting">
			<label class="setting-label" for="setting-level">Выберите уровень достижения</label>
			<div class="setting-control">
				<input id="setting-level" name="achievement[level]" value="">
			</div>
		</div>
		<div class="setting">
			<label class="setting-label" for="setting-color">Выберите цвет достижения</label>
			<div class="setting-control">
				<input id="setting-color" name="achievement[color]" value="">
			</div>
		</div>
		<div class="actions">
			<input type="submit" value="Отправить">
		</div>
</form>

<?php require_once 'include/static/footer.php'; ?>
