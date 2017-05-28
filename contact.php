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

$title = 'Связаться с администрацией';
$current_page = 'contact';
$showSidebar = false;

Markup::pageStart();

?>

<p>
    Связаться с администрацией можно по этому адресу: <a href="mailto:diamond@00744.ru">diamond@00744.ru</a>
</p>
<p>
    Также можете решить возникшие вопросы в <a href="https://vk.com/achievementsu">группе В Контакте</a>.
</p>

<?php

Markup::pageEnd();

?>
