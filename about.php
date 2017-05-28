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

$title = 'Подробнее о сервисе';
$current_page = 'about';
$showSidebar = false;

Markup::pageStart();

?>

<div class="about-page">
    <div style="text-align: center;">
        <img src="resources/images/logo_full.png">
    </div>
    <p>
        <strong>Achievement.su</strong> &ndash; веб-сервис, который сочетает в себе идеи и традиции личного дневника и
        социальной сети. На этом сайте каждый может отмечать жизненные достижения, как свои, так и друзей.
    </p>
    <hr>
    <p>
        Для начала использования сайта необходима регистрация, перед которой желательно ознакомиться с
        <a href="terms.php">правилами</a>. После регистрации вы сразу можете приступить к добавлению своих жизненных
        достижений &ndash; просто нажмите большую зелёную кнопку справа. Только вы решаете, начнётся ли ваш achi-дневник
        со дня регистрации или же вы наполните его достижениями прошлого. Кроме этого, вы можете добавить друга
        (или пригласить его, если он ещё не с нами) и отметить его достижение, которое, по вашему мнению, оказалось
        важным на его жизненном пути.
    </p>
</div>

<?php

Markup::pageEnd();

?>
