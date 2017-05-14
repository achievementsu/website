<?php

require_once 'include/functions.php';

global $_POST;
if (isset($_POST['login'])) {
    if (($id = User::isValid($_POST['email'], $_POST['password'])) > 0) {
        $user = new User($id);
        if ($_POST['remember']) {
            $cookieTime = time()+60*60*24*30;
        } else {
            $cookieTime = 0;
        }
        setcookie('id', $user->id, $cookieTime);
        setcookie('password', $user->password, $cookieTime);
        header('Location: feed.php');
    }
}

global $login;
if (isset($login->user)) {
    header('Location: feed.php');
}

$title = 'Добро пожаловать';
$current_page = 'index';
$showSidebar = true;

Markup::pageStart();

?>

<h1>Добро пожаловать!</h1>
<div class="section">
    <p><strong>Achievement.su</strong> &ndash; проект, сочетающий в себе личный дневник и мини-социальную сеть, на котором можно отмечать жизненные достижения, как свои, так и друзей.</p>
</div>
<h2>Основные возможности</h2>
<div class="section">
    <ul>
        <li><b>Особенность.</b><br>У каждого достижения имеется собственная пиктограмма и цвет.</li>
        <li><b>Хронологичность.</b><br>Возможно привязать достижение к определённой дате.</li>
        <li><b>Важность.</b><br>Десятибалльная шкала уровня достижения, зависящая от его жизненной важности и/или временных затрат на его получение.</li>
    </ul>
</div>
<h2>Ранняя стадия</h2>
<div class="section">
    <div class="achievement-full" style="border-color: #E94E09;">
        <div class="icon" style="border-color: #E94E09;">
            <img src="resources/images/icons/alpha.jpg">
        </div>
        <div class="info">
            <div class="name">Альфа-тестирование</div>
            <div class="description">Ничего не трогать! <b>¯\_(ツ)_/¯</b></div>
            <?php /* <div class="meta">
                <div class="level">Уровень: 4</div>
                <div class="sender">Прислал: Diamond00744</div>
                <div class="time">Получено: 10 декабря 2015</div>
            </div> */ ?>
        </div>
    </div>
    <p>В данный момент веб-сайт находится, как это сейчас модно, в статусе "ранний доступ", то есть в тестовом режиме. Альфа-тест, если быть точным &ndash; а это значит, что даже не реализован весь запланированный функционал.</p>
    <p><b>ВАЖНО! Наиболее вероятно, что после завершения тестового периода сайт будет очищен от накопленного контента. Вполне возможно, что и до этого момента будет пара-тройка чисток. Имейте это в виду.</b></p>
    <p>Буду очень рад услышать ваши отзывы! Куда вы можете их направлять &ndash; <a href="contact.php">смотрите здесь</a>. Надеюсь, проект вырастет в нечто более крупное и мощное :)</p>
    <p style="text-align: right;"><i>- Илья Паликов (a.k.a. Diamond00744)</i></p>
</div>

<?php

Markup::pageEnd();

?>
