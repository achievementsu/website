<?php

require_once 'include/functions.php';

global $login;
if (!isset($login->user)) {
	header('Location: index.php');
}

$title = 'Обновления';
$current_page = 'feed';

Markup::pageStart();

?>

<h1>Лента обновлений</h1>
<div id="feed">
	<h2>Сегодня</h2>
	<div class="section">
		<div class="event">
			<span class="note">10:42</span>
			<img src="storage/avatars/diamond00744.jpg" class="user-avatar" width="32px" height="32px"> <span class="user-name">Вы</span> получили достижение 7 уровня <span class="achievement-name">Счастливчик</span> от <img src="storage/avatars/lirrick.jpg" class="user-avatar" width="32px" height="32px"> <span class="user-name">Lirrick</span>
		</div>
		<div class="event">
			<span class="note">9:29</span>
			<img src="storage/avatars/lirrick.jpg" class="user-avatar" width="32px" height="32px"> <span class="user-name">Lirrick</span> получил достижение 5 уровня <span class="achievement-name">Зомбикиллер</span> от <img src="storage/avatars/diamond00744.jpg" class="user-avatar" width="32px" height="32px"> <span class="user-name">Вас</span>
		</div>
		<div class="event">
			<span class="note">9:18</span>
			<img src="storage/avatars/tippa44007.jpg" class="user-avatar" width="32px" height="32px"> <span class="user-name">tippa44007</span> получил достижение 10 уровня <span class="achievement-name">ДуровЛох</span>
		</div>
	</div>
	<h2>Вчера</h2>
	<div class="section">
		<div class="event">
			<span class="note">23:19</span>
			<img src="storage/avatars/diamond00744.jpg" class="user-avatar" width="32px" height="32px"> <span class="user-name">Вы</span> получили достижение 8 уровня <span class="achievement-name">За верность</span> от <img src="storage/avatars/tippa44007.jpg" class="user-avatar" width="32px" height="32px"> <span class="user-name">tippa44007</span>
		</div>
		<div class="event">
			<span class="note">16:54</span>
			<img src="storage/avatars/diamond00744.jpg" class="user-avatar" width="32px" height="32px"> <span class="user-name">Вы</span> подружились с <img src="storage/avatars/tippa44007.jpg" class="user-avatar" width="32px" height="32px"> <span class="user-name">tippa44007</span>
		</div>
	</div>
</div>

<?php

Markup::pageEnd();

?>
