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

$title = 'Правила пребывания';
$current_page = 'terms';
$showSidebar = false;

Markup::pageStart();

?>

<p>
    При регистрации на сайте Вы должны согласиться с правилами. Правила существуют для создания комфортной атмосферы
    общения, защиты интересов пользователей и поддержания порядка. Участвуя в дискуссиях, вы автоматически принимаете
    эти правила. Если у вас есть вопросы, обратитесь к администрации ресурса любым доступным способом.
</p>
<p>
    На сайте действуют следующие запреты:
</p>
<ul>
    <li>Ненормативная лексика</li>
    <li>Оскорбления и угрозы в адрес других пользователей</li>
    <li>Пропаганда расовой, национальной и религиозной вражды</li>
    <li>Реклама и самореклама</li>
    <li>Размещение непристойных медиа-материалов</li>
    <li>Все остальное, что выходит за рамки морали и нравственности</li>
</ul>
<p>
    Материалы пользователей не проходят предварительную проверку и сразу публикуются на сайте. Администрация сайта не
    отвечает за все публикуемые пользователями сообщения. Ответственность за содержание сообщения несет только его
    автор.
</p>
<p>
    Нарушителям правил будет закрыт доступ на сайт.
</p>

<?php

Markup::pageEnd();

?>
