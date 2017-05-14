<?php

/**
 * Class Markup.
 * Класс, отвечающий за общую разметку страниц.
 */
class Markup
{
    /**
     * Функция подсветки ссылки активной страницы в шапке.
     * @param $link int Идентификатор проверяемой ссылки.
     * @return null|string Атрибут class, если требуется.
     */
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

        global $listMessages;
        $listMessages->printMessages();
    }

    public static function getHeaderMenu() {
        global $login;
        if (isset($login->user)) { ?>
            <nav id="header-menu"><ul>
                    <li><a href="feed.php"<?php echo self::headerLinkBacklight('feed'); ?>>Лента</a></li>
                    <li><a href="friends.php"<?php echo self::headerLinkBacklight('friends'); ?>>Друзья</a></li>
                    <li><a href="profile.php"<?php echo self::headerLinkBacklight('profile'); ?>><?php echo $login->user->username; ?></a></li>
                </ul>
            </nav>
        <?php } else { ?>
            <nav id="header-menu"><ul>
                    <li><a href="index.php"<?php echo self::headerLinkBacklight('index'); ?>>Главная</a></li>
                    <li><a href="about.php"<?php echo self::headerLinkBacklight('about'); ?>>О сайте</a></li>
                    <li><a href="blog.php"<?php echo self::headerLinkBacklight('blog'); ?>>Блог</a></li>
                </ul>
            </nav>
        <?php
        }
    }

    /* Функция вставки подвала сайта */
    public static function pageEnd() {
        require_once '/../static/footer.php';
    }
}

?>
