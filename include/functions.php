<?php
header('Content-Type: text/html; charset=utf-8');

/* Импортируем конфигурацию */
require_once './config/config.php';

/* Подключаемся к БД */
$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if ($db->connect_errno) { // проверка соединения
	printf("Соединение не удалось: %s\n", $db->connect_error);
	exit();
}

/* А теперь непосредственно функционал */
require_once 'classes/user.php';
require_once 'classes/login.php';
require_once 'classes/markup.php';

?>
