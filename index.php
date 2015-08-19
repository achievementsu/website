<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Achi Test Service</title>
	<link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
	<div id="wrapper">
		<div id="header">
			<div id="header_wrapper">
				<div id="header_logo"></div>
				<nav id="header_menu">
					<ul>
						<li><a href="feed.php" class="here">Лента</a></li>
						<li><a href="friends.php">Друзья</a></li>
						<li><a href="profile.php">Профиль</a></li>
					</ul>
				</nav>
			</div>
		</div>
		<div id="content">
			<div id="content_wrapper">
				<div id="content_sidebar">
					<div class="sideblock sideblock-new">
						<a href="new.php" class="new_button">Новое достижение</a>
					</div>
					<div class="sideblock sideblock-login">
						<form id="login-form" name="logon" method="POST">
							<label for="login-username">Имя пользователя</label><br>
							<input id="login-username" type="text" tabindex="1" maxlength="50" name="username"></input><br><br>
							<label for="login-password">Пароль</label><br>
							<input id="login-password" type="password" tabindex="2" maxlength="50" autocomplete="off" name="password"></input><br><br>
							<input id="login-button" type="submit" tabindex="3" value="Вход"></input>
						</form>
						Восстановление доступа<br>
						Регистрация
					</div>
					<div class="sideblock sideblock-profile">
						<div class="title">
							Diamond00744
						</div>
						<div class="avatar">
							<img src="storage/avatars/diamond00744.jpg">
						</div>
						<ul class="menu">
							<li><a href="profile.php">Профиль</a></li>
							<li><a href="settings.php">Настройки</a></li>
							<li><a href="logout.php">Выйти</a></li>
						</ul>
						<div class="clear"></div>
						<div class="title">
							Последние достижения
						</div>
						<div class="last">
							<div class="achievement" style="border-color: #0d0;">
								<div class="icon" style="--box-shadow-color: #0d0;"><img src="storage/icons/randomcode.jpg" width="32px" height="32px"></div>
								<div class="date">сегодня</div>
								<div class="title">Делом, наконец, занялся</div>
								<div class="clear"></div>
							</div>
							<div class="achievement" style="border-color: #d00;">
								<div class="icon" style="--box-shadow-color: #d00;"><img src="storage/icons/randomcode.jpg" width="32px" height="32px"></div>
								<div class="date">вчера</div>
								<div class="title">Достижение 2</div>
								<div class="clear"></div>
							</div>
							<div class="achievement" style="border-color: #ed0;">
								<div class="icon" style="--box-shadow-color: #ed0;"><img src="storage/icons/randomcode.jpg" width="32px" height="32px"></div>
								<div class="date">15 сентября</div>
								<div class="title">Достижение 1</div>
								<div class="clear"></div>
							</div>
						</div>
					</div>
				</div>
				<div id="content_main">
					<h1 class="title">Лента обновлений</h1>
					<div id="feed">
						<h2>Сегодня</h2>
						<div class="item"><span class="timestamp">10:42</span> <img src="storage/avatars/diamond00744.jpg" class="avatar" width="32px" height="32px"> <span class="username">Вы</span> получили достижение 7 уровня <span class="achievement_name">Счастливчик</span> от <img src="storage/avatars/lirrick.jpg" class="avatar" width="32px" height="32px"> <span class="username">Lirrick</span></div>
						<div class="item"><span class="timestamp">9:29</span> <img src="storage/avatars/lirrick.jpg" class="avatar" width="32px" height="32px"> <span class="username">Lirrick</span> получил достижение 5 уровня <span class="achievement_name">Зомбикиллер</span> от <img src="storage/avatars/diamond00744.jpg" class="avatar" width="32px" height="32px"> <span class="username">Вас</span></div>
						<div class="item"><span class="timestamp">9:18</span> <img src="storage/avatars/tippa44007.jpg" class="avatar" width="32px" height="32px"> <span class="username">tippa44007</span> получил достижение 10 уровня <span class="achievement_name">ДуровЛох</span></div>
						<h2>Вчера</h2>
						<div class="item"><span class="timestamp">23:19</span> <img src="storage/avatars/diamond00744.jpg" class="avatar" width="32px" height="32px"> <span class="username">Вы</span> получили достижение 8 уровня <span class="achievement_name">За верность</span> от <img src="storage/avatars/tippa44007.jpg" class="avatar" width="32px" height="32px"> <span class="username">tippa44007</span></div>
						<div class="item"><span class="timestamp">16:54</span> <img src="storage/avatars/diamond00744.jpg" class="avatar" width="32px" height="32px"> <span class="username">Вы</span> подружились с <img src="storage/avatars/tippa44007.jpg" class="avatar" width="32px" height="32px"> <span class="username">tippa44007</span></div>
					</div>
				</div>
			</div>
		</div>
		<div id="footer">
			<div id="footer_wrapper">
				<a href="http://00744.ru" target="_blank" class="logo"></a>
				<p>Copyright &copy; 2015 by .00744</p>
				<p>Все права правы, а лева - левы. Учитывайте это при переходе оживлённых трасс.</p>
				<nav id="footer_menu">
					<ul>
						<li><a href="about.php">О сайте</a></li>
						<li><a href="terms.php">Правила</a></li>
						<li><a href="legal-notice.php">Правовые заметки</a></li>
						<li><a href="contact.php">Обратная связь</a></li>
					</ul>
				</nav>
			</div>
		</div>
	</div>
	<div class="notification" style="border-color: #0d0;">
		<div class="icon" style="--box-shadow-color: #0d0;"><img src="storage/icons/randomcode.jpg"></div>
		<div class="title">Получено достижение</div>
		<div class="text">Делом, наконец, занялся</div>
		<div class="comment">от tippa44007</div>
	</div>
</body>
</html>
