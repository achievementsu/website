<?php
header('Content-Type: text/html; charset=utf-8');

// Работает относительно Гринвича
date_default_timezone_set("UTC");

// Работа с паролями на старых версиях PHP
require_once 'ext/password.php';

// Импортируем конфигурацию
require_once './config/config.php';

// Подключаемся к БД
$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if ($db->connect_errno) { // проверка соединения
    printf('Соединение не удалось: %s\n', $db->connect_error);
    exit();
}

include 'classes/MessageList.php';
use AchievementSu\MessageList;
/**
 * Список массивов с всплывающими сообщениями
 * title - необязательная часть, которая будет выделена жирным в начале сообщения
 * type - тип сообщения (error, success, notify, white)
 * description - основной текст
 */
$listMessages = new MessageList();

/* А теперь непосредственно функционал */

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

require_once 'classes/User.php';
require_once 'classes/Login.php';

require_once 'classes/Markup.php';
