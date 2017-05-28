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

require_once './config/config.php'; // Импортируем конфигурацию

require_once 'classes/User.php';
require_once 'classes/Login.php';
require_once 'ext/password.php'; // Работа с паролями на старых версиях PHP
require_once 'classes/Achievement.php';
require_once 'classes/MessageList.php';
require_once 'classes/Markup.php';

require_once 'classes/helpers/StringHelpers.php';

header('Content-Type: text/html; charset=utf-8');

// Работает относительно Гринвича
date_default_timezone_set("UTC");

// Подключаемся к БД
$db = new \mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if ($db->connect_errno) {
    printf('Соединение с БД не удалось: %s\n', $db->connect_error);
    exit();
}

$login = new Login();
$listMessages = new MessageList();
