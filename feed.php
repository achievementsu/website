<?php

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
    }

    echo '<div class="event"><span class="note">' . $achiDate->format('H:i') . '</span>'
        . '<img src="' . $achiTo->avatar . '" class="user-avatar user-avatar-mini"> '
        . '<span class="user-name">' . ($achiToMe ? 'Вы' : $achiTo->username) . '</span> '
        . ($achiToMe ? 'получили' : 'получил(а)') . ' достижение ' . $achi->level . ' уровня '
        . '<img src="' . $achi->image . '" class="achievement-image" style="border-color: #' . $achi->color . '"> '
        . '<span class="achievement-name">' . $achi->name . '</span> от '
        . '<img src="' . $achiFrom->avatar . '" class="user-avatar user-avatar-mini"> '
        . '<span class="user-name">' . ($achiFromMe ? 'Вас' : $achiFrom->username) . '</span> '
        . '</div>'; //.event
}

$feedSectionOpened = false;
echo '</div>'; //.section

echo '</div>'; //#feed
Markup::pageEnd();
