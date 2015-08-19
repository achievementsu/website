<?php
header('Content-Type: text/html; charset=utf-8');

/* Функция подсветки ссылка активной страницы в шапке */
function header_link_backlight($link) {
	global $current_page;
	if ($link == $current_page) {
		echo ' class="here"';
	}
}

?>
