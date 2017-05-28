<?php

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
