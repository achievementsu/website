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

$title = 'Блог обновлений';
$current_page = 'blog';
$showSidebar = false;

Markup::pageStart();

?>

<p style="text-align: center;">
    <img src="resources/images/blog/20151214.png">
</p>
<p>
    Всем привет, у клавиатуры Diamond00744, разработчик этого сайта
    <i>(кодировщик, дизайнер, верстальщик, тестировщик и прочие такие вещи)</i>,
    а также соавтор его идеи. В общем...
</p>
<p>
    Сегодня, 14 декабря 2015 года, я объявляю о первом публичном запуске сервиса социального дневника под названием
    <strong>Achievement.su</strong>, пока ещё в тестовом режиме. Идея родилась под впечатлением сервиса цифровой
    дистрибуции Steam, популяризовавшей игровые достижения, которые выдаются за мелкие детали при прохождении игр.
</p>
<p>
    Впервые я нарисовал "жизненное достижение" 31 августа 2014 года. Это была пробная перерисовка плашки получения
    достижения в Steam (я уже тогда её раскрасил, с того дня и тянется главная идея цветов достижений на этом сайте).
    Первое достижение я тогда связал с закрытием одного из хвостов летней университетской сессии.
</p>
<p>
    А сама идея непосредственно подобного веб-сайта родилась 27 сентября 2014 года в ходе вечерней
    медитативно-диалоговой прогулки с Dr. Tippa, моим комрадом. Поэтому и решено было дебютировать сайт на его юбилей.
    С днюхой, Кибербро!
</p>
<p>
    Сайт пока на альфа-стадии разработки. Ещё много функционала не реализовано и/или не отполировано. Вполне возможно,
    что в это время рано или поздно придётся зачистить базу данных от накопленных достижений и регистраций, поэтому
    заранее прошу пока не заполнять свои профили особо сильно и серьёзно. Я буду рад получить отзывы о сайте.
</p>
<p>
    Желаю всего хорошего, Илья "Diamond00744" Паликов.
</p>

<?php

Markup::pageEnd();

?>
