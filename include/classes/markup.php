<?php

class Markup
{
	/* Функция подсветки ссылки активной страницы в шапке */
	private function header_link_backlight($link) {
		global $current_page;
		if ($link == $current_page) {
			return ' class="here"';
		}
		else {
			return NULL;
		}
	}

	/* Функция вставки шапки сайта */
	public function pagestart() {
		require_once '/../static/header.php';
	}

	/* Функция вставки боковой панели */
	public function pageend() {
		require_once '/../static/footer.php';
	}
}

?>
