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

require_once 'include/init.php';

global $login;
if (!$login->isLoggedIn()) {
    header('Location: index.php');
}
$currentUser = $login->getUser();
$feed = Achievement::getFriendsUpdatesFeed();

$title = 'Обновления';
$current_page = 'feed';
$showSidebar = true;

Markup::pageStart();
echo '<h1>Лента обновлений</h1><div id="feed">';

// Даты для сравнений
$date_today = new \DateTime('today');
$date_today = $date_today->format('d.m.Y');
$date_yesterday = new \DateTime('yesterday');
$date_yesterday = $date_yesterday->format('d.m.Y');

// Переменная для даты текущего достижения
$feedCurrentDate = null;
$feedSectionOpened = false;

foreach ($feed as $achi) {
    $achiDate = new \DateTime($achi->timeSent);
    $achiFrom = $achi->from == $currentUser->id ? $currentUser : new User($achi->from);
    $achiFromMe = $achiFrom == $currentUser;
    $achiTo = $achi->to == $currentUser->id ? $currentUser : new User($achi->to);
    $achiToMe = $achiTo == $currentUser;
    $achiSelf = $achiTo->id == $achiFrom->id;

    if ($feedCurrentDate != $achiDate->format('d.m.Y')) {
        $feedCurrentDate = $achiDate->format('d.m.Y');
        $feedCurrentDateText = $feedCurrentDate;
        if ($feedCurrentDate == $date_today) {
            $feedCurrentDateText = 'Сегодня';
        } elseif ($feedCurrentDate == $date_yesterday) {
            $feedCurrentDateText = 'Вчера';
        }

        if ($feedSectionOpened) { echo '</div>'; }
        echo '<h2>' . $feedCurrentDateText . '</h2><div class="section">';
        $feedSectionOpened = true;
    }

    echo '<div class="event">'
        . '<span class="note">' . $achiDate->format('H:i') . '</span>'
        . '<img src="' . $achiTo->avatar . '" class="user-avatar user-avatar-mini"> '
        . '<span class="user-name">' . ($achiToMe ? 'Вы' : $achiTo->username) . '</span> '
        . ($achiToMe ? 'получили' : 'получил(а)') . ' достижение ' . $achi->level . ' уровня '
        . '<img src="' . $achi->image . '" class="achievement-image" style="border-color: #' . $achi->color . '"> '
        . '<span class="achievement-name">' . $achi->name . '</span>';
        if (!$achiSelf) {
            echo ' от <img src="' . $achiFrom->avatar . '" class="user-avatar user-avatar-mini"> '
                . '<span class="user-name">' . ($achiFromMe ? 'Вас' : $achiFrom->username) . '</span>';
        }
    echo '</div>'; //.event
}

echo '</div>'; //.section

echo '</div>'; //#feed
Markup::pageEnd();
