<div id="content-sidebar">

<?php
global $login;
if (isset($login->$user)) {
?>

	<div class="sideblock sideblock-new">
		<a href="add.php" class="big-button">Новое достижение</a>
	</div>
	<div class="sideblock sideblock-profile">
		<div class="title">
			<?php echo $login->$user->$username ?>
		</div>
		<div class="avatar">
			<div class="level">
				<?php echo $login->$user->$level ?>
			</div>
			<img src="storage/avatars/diamond00744.jpg">
		</div>
		<ul class="menu">
			<li><a href="profile.php">Профиль</a></li>
			<li><a href="settings.php">Настройки</a></li>
			<li><a href="logout.php">Выйти</a></li>
		</ul>
		<div class="clearfix"></div>
		<div class="title">
			Последние достижения
		</div>
		<div class="last">
			<div class="achievement" style="border-color: #0d0;">
				<div class="icon" style="--box-shadow-color: #0d0;"><img src="storage/icons/randomcode.jpg" width="32px" height="32px"></div>
				<div class="title">Делом, наконец, занялся</div>
				<div class="clearfix"></div>
			</div>
			<div class="achievement" style="border-color: #d00;">
				<div class="icon" style="--box-shadow-color: #d00;"><img src="storage/icons/randomcode.jpg" width="32px" height="32px"></div>
				<div class="title">Достижение 2</div>
				<div class="clearfix"></div>
			</div>
			<div class="achievement" style="border-color: #ed0;">
				<div class="icon" style="--box-shadow-color: #ed0;"><img src="storage/icons/randomcode.jpg" width="32px" height="32px"></div>
				<div class="title">Достижение 1</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>

<?php } else { ?>

	<div class="sideblock sideblock-login">
		<form id="login-form" name="login" method="POST">
			<input id="login-email" type="text" tabindex="1" maxlength="50" name="email" placeholder="Адрес электронной почты"><br>
			<input id="login-password" type="password" tabindex="2" minlength="3" maxlength="50" autocomplete="off" name="password" placeholder="Пароль"><br>
			<label for="login-remember">
				<input id="login-remember" type="checkbox" tabindex="3">
				Запомнить меня
			</label><br>
			<input id="login-button" type="submit" tabindex="4" name="login" value="Вход">
		</form><br>
		<a href="restore.php">Восстановление доступа</a><br>
		<a href="register.php">Регистрация</a>
	</div>

<?php } ?>

</div>
