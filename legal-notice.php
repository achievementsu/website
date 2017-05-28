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

$title = 'Правовые заметки';
$current_page = 'legal-notice';
$showSidebar = false;

Markup::pageStart();

?>

<p>
    <b>Возрастные ограничения</b>.
    Сайт не рекомендуется посещать лицам до четырнадцати лет. При доступе к сайту лиц до указанного возраста
    рекомендуется фильтрация текстового и графического контента родителем, или заменяющим его лицом. При отсутствии
    оных, любым другим совершеннолетним лицом, не имеющем юридических ограничений.
</p>
<p>
    <b>Файлы «Cookies»</b>.
    Веб-сайт использует в своей работе технологию Cookies, в частности для работы системы регистрации и авторизации
    пользователей. Это значит, что на компьютере посетителя могут сохраняться данные, однозначно идентифицирующие его среди прочих. Каждый посетитель в любой момент может удалить эти данные в настройках своего браузера.
</p>
<p>
    <b>Политика конфиденциальности</b>.
    Веб-сайт может собирать IP-адреса посетителей, и, возможно, другую личную информацию. Администрация ни в коем
    случае не будет использовать её без особой необходимости, такой, как, например, бан по IP за грубые нарушения
    правил сайта или внеморальные поступки.
</p>
<p>
    <b>О СМИ</b>.
    Данный Интернет-ресурс не является средством массовой информации. Администрация сайта не заявляет о правдивости
    каждого текстового материала на сайте.
</p>

<?php

Markup::pageEnd();

?>
