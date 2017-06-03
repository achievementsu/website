<?php
/*
 * This file is part of Achievement.su website
 * LICENSE: GNU Affero General Public License, version 3 (AGPLv3)
 * Copyright (C) 2015 - 2017  Achievement.su
 *
 * Achievement.su is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published
 * by the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * Contact me: diamond@00744.ru
 */

namespace AchievementSu;
?>

<div id="content-sidebar">

<?php
function showSidebarAchievementsList($id) {
    function printSidebarAchievementBlock($achievement) {
        ?>
        <div class="achievement" style="border-color: #<?php echo $achievement->color ?>;">
            <img src="<?php echo $achievement->image ?>" class="icon"
                 style="border-color: #<?php echo $achievement->color ?>; width: 32px; height: 32px;">
            <div class="title"><?php echo $achievement->name ?></div>
            <div class="clearfix"></div>
        </div>
        <?php
    }
    $achievements = Achievement::getUserAchievementsList($id, 3);
    foreach ($achievements as $achievement) {
        printSidebarAchievementBlock($achievement);
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
