<?php

/* Класс, отвечающий за общую разметку страниц */
class Markup
{
	/* Функция подсветки ссылки активной страницы в шапке */
	private static function headerLinkBacklight($link) {
		global $current_page;
		if ($link == $current_page) {
			return ' class="here"';
		}
		else {
			return NULL;
		}
	}

	/* Функция вставки шапки сайта */
	public static function pageStart() {
		require_once '/../static/header.php';
	}

	/* Функция вставки боковой панели */
	public static function pageEnd() {
		require_once '/../static/footer.php';
	}
}

?>
