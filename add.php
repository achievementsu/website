<?php
	$title = 'Добавить достижение';
	$current_page = 'add';
	require_once 'include/functions.php';
	require_once 'include/static/header.php';
?>

<h1>Добавить новое достижение</h1>
<form id="add" class="add">
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
		<div class="actions">
			<input type="submit" value="Сохранить">
		</div>
</form>

<?php require_once 'include/static/footer.php'; ?>
