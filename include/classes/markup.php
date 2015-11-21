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

		self::showMessages();
	}

	private static function showMessages() {
		global $listMessages;

		foreach ($listMessages as $msg) {
			if ($msg['description'] && $msg['type']) {
				echo '<div class="section info-box info-' . $msg['type'] . '-box">';
				if ($msg['title']) {
					echo '<b>' . $msg['title'] . '.</b> ';
				}
				echo $msg['description'] . '</div>';
			}
		}
	}

	/* Функция вставки подвала сайта */
	public static function pageEnd() {
		require_once '/../static/footer.php';
	}
}

?>
