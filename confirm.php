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

global $_GET, $listMessages;
if ((isset($_GET['id'])) && ($_GET['id'] > 0) && ($_GET['code'])) {
    if (User::confirmEmail($_GET['id'], $_GET['code'])) {
        $listMessages->addSuccess('Ваш почтовый ящик подтверждён, спасибо!');
    } else {
        $listMessages->addError('Увы, ошибка подтверждения почтового ящика.');
    }
}

$title = 'Подтверждение регистрации';
$current_page = 'confirm';
$showSidebar = false;

Markup::pageStart();

?>



<?php

Markup::pageEnd();

?>
