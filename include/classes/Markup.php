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

/**
 * Class Markup.
 * Класс, отвечающий за общую разметку страниц.
 * @package AchievementSu
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
        require_once 'MarkupHeader.php';

        global $listMessages;
        $listMessages->printMessages();
    }

    public static function getHeaderMenu() {
        global $login;
        if ($login->isLoggedIn()) {
            $currentUser = $login->getUser();
            ?>
            <nav id="header-menu">
                <ul>
                    <li><a href="feed.php"<?php echo self::headerLinkBacklight('feed'); ?>>Лента</a></li>
                    <li><a href="friends.php"<?php echo self::headerLinkBacklight('friends'); ?>>Друзья</a></li>
                    <li><a href="profile.php"<?php echo self::headerLinkBacklight('profile'); ?>><?php echo $currentUser->username; ?></a></li>
                </ul>
            </nav>
        <?php } else { ?>
            <nav id="header-menu">
                <ul>
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
        require_once 'MarkupFooter.php';
    }
}

?>
