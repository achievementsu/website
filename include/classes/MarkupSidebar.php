<?php namespace AchievementSu; ?>

<div id="content-sidebar">

<?php
function showSidebarAchievementsList($id) {
    global $db, $currentUser;

    $query = 'SELECT * FROM `achi_achievements` WHERE `to`=' . $id . ' ORDER BY `time_sent` DESC LIMIT 0 , 3';
    $result = $db->query($query);

    while ($data = $result->fetch_assoc()) {
    ?>
    <div class="achievement" style="border-color: #<?php echo $data['color'] ?>;">
        <div class="icon" style="border-color: #<?php echo $data['color'] ?>;"><img src="storage/icons/<?php echo $data['image'] ?>" width="32px" height="32px"></div>
        <div class="title"><?php echo $data['name'] ?></div>
        <div class="clearfix"></div>
    </div>
    <?php
    }
}

global $login;
if ($login->isLoggedIn()) {
    $currentUser = $login->getUser();
?>

    <div class="sideblock sideblock-new">
        <a href="/add.php" class="big-button">Новое достижение</a>
    </div>
    <div class="sideblock sideblock-profile">
        <div class="title">
            <?php echo $currentUser->username ?>
        </div>
        <div class="avatar">
            <div class="level">
                <?php echo $currentUser->level ?>
            </div>
            <img src="<?php echo $currentUser->avatar ?>">
        </div>
        <ul class="menu">
            <li><a href="/profile.php">Профиль</a></li>
            <li><a href="/settings.php">Настройки</a></li>
            <li><a href="/logout.php">Выйти</a></li>
        </ul>
        <div class="clearfix"></div>
        <div class="title">
            Последние достижения
        </div>
        <div class="last">
            <?php showSidebarAchievementsList($currentUser->id); ?>
        </div>
    </div>

<?php } else { ?>

    <div class="sideblock sideblock-login">
        <form id="login-form" name="login" method="POST">
            <input type="text" maxlength="50" name="email" placeholder="Адрес электронной почты"><br>
            <input type="password" maxlength="50" autocomplete="off" name="password" placeholder="Пароль"><br>
            <label for="login-remember">
                <input type="checkbox" name="remember">
                Запомнить меня
            </label><br>
            <input type="submit" name="login" value="Вход">
        </form><br>
        <a href="/restore.php">Восстановление доступа</a><br>
        <a href="/register.php">Регистрация</a>
    </div>

<?php } ?>

</div>
