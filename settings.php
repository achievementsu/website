<?php
	$title = 'Настройки учётной записи';
	$current_page = 'profile';
	require_once 'include/functions.php';
	require_once 'include/static/header.php';

	/* TODO: class="setting clear" */
?>

<div class="section info-box info-error-box">
	Ошибка 451. Данная страница запрещена к просмотру по законам РФ.
</div>
<div class="section info-box info-success-box">
	Настройки успешно сохранены!
</div>
<div class="section info-box info-notify-box">
	Пришли 2 новых достижения!
</div>
<div class="section info-box info-white-box">
	Внимание! 25 сентября вечерком сайт будет закрыт на внеплановую техобслужку. Не поймите нас неправильно.
</div>
<form id="settings" class="settings">
	<h1>Настройки</h1>
	<h2>Учётная запись</h2>
	<div class="section">
		<div class="setting">
			<label class="setting-label" for="setting-account-email">Адрес электронной почты</label>
			<div class="setting-control">
				<input id="setting-account-email" name="user[email]" value="diamond00744@gmail.com">
			</div>
		</div>
		<div class="setting">
			<label class="setting-label" for="setting-account-timezone">Часовой пояс</label>
			<div class="setting-control">
				<select id="setting-account-email" name="user[timezone]" value="diamond00744@gmail.com">
					<option selected value="Moscow" data-offset="10800">GMT+3 Moscow</option>
				</select>
			</div>
		</div>
		<div class="actions">
			<input type="submit" value="Сохранить">
		</div>
	</div>
	<h2>Пароль</h2>
	<div class="section">
		<div class="setting">
			<label class="setting-label" for="setting-password-newpass">Новый пароль</label>
			<div class="setting-control">
				<input id="setting-password-newpass" name="user[newpass]" type="password" value="">
			</div>
		</div>
		<div class="setting">
			<label class="setting-label" for="setting-password-renewpass">Повторите пароль</label>
			<div class="setting-control">
				<input id="setting-password-renewpass" name="user[renewpass]" type="password" value="">
			</div>
		</div>
		<div class="setting">
			<label class="setting-label" for="setting-password-currentpass">Старый пароль</label>
			<div class="setting-control">
				<input id="setting-password-currentpass" name="user[currentpass]" type="password" value="">
			</div>
		</div>
		<div class="actions">
			<input type="submit" value="Сохранить">
		</div>
	</div>
	<h2>Доступ и конфиденциальность</h2>
	<div class="section">
		<fieldset class="setting">
			<legend class="setting-label">Мои достижения могут видеть</legend>
			<div class="setting-control">
				<label>
					<input id="setting-access-all" type="radio" checked name="user[access]" value="all">
					все
				</label>
				<label>
					<input id="setting-access-friends" type="radio" name="user[access]" value="friends">
					только друзья
				</label>
				<label>
					<input id="setting-access-me" type="radio" name="user[access]" value="me">
					никто (только я)
				</label>
			</div>
		</fieldset>
		<div class="actions">
			<input type="submit" value="Сохранить">
		</div>
	</div>
	<h2>Уведомления</h2>
	<div class="section">
		<fieldset class="setting">
			<legend class="setting-label">Присылать письмо, когда</legend>
			<div class="setting-control">
				<label>
					<input id="setting-notification-achievement" type="checkbox" checked name="user[notification]" value="achievement">
					мне приходит достижение
				</label>
				<label>
					<input id="setting-notification-friend" type="checkbox" checked name="user[notification]" value="friend">
					меня добавили в друзья
				</label>
			</div>
		</fieldset>
		<div class="actions">
			<input type="submit" value="Сохранить">
		</div>
	</div>
</form>

<?php require_once 'include/static/footer.php'; ?>
