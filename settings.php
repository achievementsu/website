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
if (!$login->isLoggedIn()) {
    header('Location: index.php');
}

$title = 'Настройки учётной записи';
$current_page = 'profile';
$showSidebar = true;

Markup::pageStart();

/* TODO: class="setting clear" */

?>

<h1>Настройки</h1>
<form class="inputform" method="POST">
    <h2>Учётная запись</h2>
    <div class="section">
        <div class="setting">
            <label class="setting-label" for="setting-account-email">Адрес электронной почты</label>
            <div class="setting-control">
                <input name="email" value="diamond00744@gmail.com">
            </div>
        </div>
        <div class="setting">
            <label class="setting-label" for="setting-account-timezone">Часовой пояс</label>
            <div class="setting-control">
                <select name="timezone" value="diamond00744@gmail.com">
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
                <input name="newpass" type="password" value="">
            </div>
        </div>
        <div class="setting">
            <label class="setting-label" for="setting-password-renewpass">Повторите пароль</label>
            <div class="setting-control">
                <input name="renewpass" type="password" value="">
            </div>
        </div>
        <div class="setting">
            <label class="setting-label" for="setting-password-currentpass">Старый пароль</label>
            <div class="setting-control">
                <input name="currentpass" type="password" value="">
            </div>
        </div>
        <div class="actions">
            <input type="submit" name="save" value="Сохранить">
        </div>
    </div>
    <?php /*
    <h2>Доступ и конфиденциальность</h2>
    <div class="section">
        <div class="note">
            Вы можете выбрать, какой системы Вы хотите придерживаться.
            <ul>
                <li>
                    Система личного дневника предполагает, что Ваши достижения не будут видны никому кроме Вас.
                </li>
                <li>
                    Система друзей предполагает доступ к Вашим достижениям только тем людям, которые добавили Вас и
                    которых вместе с этим добавили Вы.
                </li>
                <li>
                    Система подписчиков предполагает, что любой может просматривать Ваши достижения, а также
                    подписываться на Вас для того, чтобы видеть Ваши достижения в своей ленте обновлений.
                </li>
            </ul>
            Просьба учитывать, что подписка на человека равна отправке заявки в друзья, поэтому если Вы подписываетесь
            на человека, то Вы потенциально открываете ему доступ к своим достижениям.
        </div>
        <fieldset class="setting">
            <legend class="setting-label">Мои достижения могут видеть</legend>
            <div class="setting-control">
                <label>
                    <input type="radio" name="access" value="me">
                    никто, лишь только я (система личного дневника)
                </label>
                <label>
                    <input type="radio" name="access" value="friends">
                    только избранные (система друзей)
                </label>
                <label>
                    <input type="radio" checked name="access" value="all">
                    все (система подписчиков)
                </label>
            </div>
        </fieldset>
        <div class="actions">
            <input type="submit" name="save" value="Сохранить">
        </div>
    </div>
    <h2>Уведомления</h2>
    <div class="section">
        <fieldset class="setting">
            <legend class="setting-label">Присылать письмо, когда</legend>
            <div class="setting-control">
                <label>
                    <input type="checkbox" checked name="notification" value="achievement">
                    мне приходит достижение
                </label>
                <label>
                    <input type="checkbox" checked name="notification" value="friend">
                    меня добавили в друзья
                </label>
            </div>
        </fieldset>
        <div class="actions">
            <input type="submit" name="save" value="Сохранить">
        </div>
    </div>
    */ ?>
</form>

<?php Markup::pageEnd(); ?>
