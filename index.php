<!DOCTYPE html>
<html>
<head>
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
						<li><a href="feed.php" class="here">�����</a></li>
						<li><a href="friends.php">������</a></li>
						<li><a href="profile.php">�������</a></li>
					</ul>
				</nav>
			</div>
		</div>
		<div id="content">
			<div id="content_wrapper">
				<div id="content_sidebar">
					<div class="sideblock sideblock-new"><a href="new.php" class="new_button">����� ����������</a></div>
					<div class="sideblock sideblock-login">
						<form id="login-form" name="logon" method="POST">
							<label for="login-username">��� ������������</label><br>
							<input id="login-username" type="text" tabindex="1" maxlength="50" name="username"></input><br><br>
							<label for="login-password">������</label><br>
							<input id="login-password" type="password" tabindex="2" maxlength="50" autocomplete="off" name="password"></input><br><br>
							<input id="login-button" type="submit" tabindex="3" value="����"></input>
						</form>
						�������������� �������<br>
						�����������
					</div>
					<div class="sideblock sideblock-profile">
						<div class="title">Diamond00744</div>
						<div class="avatar"><img src="storage/avatars/diamond00744.jpg"></div>
						<ul class="menu">
							<li><a href="profile.php">�������</a></li>
							<li><a href="settings.php">���������</a></li>
							<li><a href="logout.php">�����</a></li>
						</ul>
						<div class="clear"></div>
					</div>
					<div class="sideblock sideblock-stats">�� ����������: ������� ����, ����� 3, 32 �������: 5 ����</div>
				</div>
				<div id="content_main">
					<h1 class="title">����� ����������</h1>
					<div id="feed">
						<h2>�������</h2>
						<div class="item"><span class="timestamp">10:42</span> <img src="storage/avatars/diamond00744.jpg" class="avatar" width="32" height="32"> <span class="username">��</span> �������� ���������� 7 ������ <span class="achievement_name">�����������</span> �� <img src="storage/avatars/lirrick.jpg" class="avatar" width="32" height="32"> <span class="username">Lirrick</span></div>
						<div class="item"><span class="timestamp">9:29</span> <img src="storage/avatars/lirrick.jpg" class="avatar" width="32" height="32"> <span class="username">Lirrick</span> ������� ���������� 5 ������ <span class="achievement_name">�����������</span> �� <img src="storage/avatars/diamond00744.jpg" class="avatar" width="32" height="32"> <span class="username">���</span></div>
						<div class="item"><span class="timestamp">9:18</span> <img src="storage/avatars/tippa44007.jpg" class="avatar" width="32" height="32"> <span class="username">tippa44007</span> ������� ���������� 10 ������ <span class="achievement_name">��������</span></div>
						<h2>�����</h2>
						<div class="item"><span class="timestamp">23:19</span> <img src="storage/avatars/diamond00744.jpg" class="avatar" width="32" height="32"> <span class="username">��</span> �������� ���������� 8 ������ <span class="achievement_name">�� ��������</span> �� <img src="storage/avatars/tippa44007.jpg" class="avatar" width="32" height="32"> <span class="username">tippa44007</span></div>
						<div class="item"><span class="timestamp">16:54</span> <img src="storage/avatars/diamond00744.jpg" class="avatar" width="32" height="32"> <span class="username">��</span> ����������� � <img src="storage/avatars/tippa44007.jpg" class="avatar" width="32" height="32"> <span class="username">tippa44007</span></div>
					</div>
				</div>
			</div>
		</div>
		<div id="footer">
			<div id="footer_wrapper">
				<a href="http://00744.ru" target="_blank" class="logo"></a>
				<p>Copyright &copy; 2015 by .00744</p>
				<p>��� ����� �����, � ���� - ����. ���������� ��� ��� �������� ��������� �����.</p>
				<nav id="footer_menu">
					<ul>
						<li><a href="about.php">� �����</a></li>
						<li><a href="terms.php">�������</a></li>
						<li><a href="legal-notice.php">�������� �������</a></li>
						<li><a href="contact.php">�������� �����</a></li>
					</ul>
				</nav>
			</div>
		</div>
	</div>
	<div class="notification" style="border-color: #0d0;">
		<div class="icon" style="--box-shadow-color: #0d0;"><img src="storage/icons/randomcode.jpg"></div>
		<div class="title">�������� ����������</div>
		<div class="text">�����, �������, �������</div>
		<div class="comment">�� tippa44007</div>
	</div>
</body>
</html>