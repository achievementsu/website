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

require_once 'include/init.php';

global $login;
if ($login->isLoggedIn()) {
    header('Location: feed.php');
}

global $_POST;
if ($_POST['register']) {
    if ($_POST['password'] == $_POST['password-repeat']) {
        User::registerUser($_POST['username'], $_POST['email'], $_POST['password']);
    } else {
        global $listMessages;
        $listMessages->addError('Пароли не совпадают.');
    }
}

$title = 'Регистрация';
$current_page = 'register';
$showSidebar = false;

Markup::pageStart();

?>

<h1>Регистрация на сервисе</h1>
<form class="inputform" method="POST">
    <h2>Основные данные</h2>
    <div class="section">
        <div class="setting">
            <label class="setting-label" for="username">Имя пользователя</label>
            <div class="setting-control">
                <input type="text" tabindex="1" maxlength="50" name="username">
            </div>
        </div>
        <div class="setting">
            <label class="setting-label" for="email">Адрес электронной почты</label>
            <div class="setting-control">
                <input type="text" tabindex="1" maxlength="50" name="email">
            </div>
        </div>
        <div class="setting">
            <label class="setting-label" for="password">Пароль</label>
            <div class="setting-control">
                <input type="password" tabindex="2" minlength="3" maxlength="50" autocomplete="off" name="password">
            </div>
        </div>
        <div class="setting">
            <label class="setting-label" for="password-repeat">Повтор пароля</label>
            <div class="setting-control">
                <input type="password" tabindex="3" minlength="3" maxlength="50" autocomplete="off" name="password-repeat">
            </div>
        </div>
    </div>
    <h2>Прочие данные</h2>
    <div class="section">
        <div class="actions">
            <input type="submit" tabindex="4" name="register" value="Регистрация">
        </div>
    </div>

</form>

<?php

Markup::pageEnd();

?>
