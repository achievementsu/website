<?php

require_once 'include/functions.php';

$title = 'Добро пожаловать';
$current_page = 'index';

global $login;
if (isset($login->user))
	header('Location: feed.php');

Markup::pageStart();

?>

<h1>Добро пожаловать!</h1>
<div class="section">
	<p><strong>Achievement.su</strong> - это сайт, где вы можете хранить свои достижения, а также вручать достижения друзьям.</p>
</div>

<?php

Markup::pageEnd();

?>
