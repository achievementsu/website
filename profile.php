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

function showAchievementsList($id) {
    function printAchievementBlock($achievement) {
        global $currentUser;
        ?>
        <div class="achievement-full" style="border-color: #<?php echo $achievement->color ?>;">
            <img src="<?php echo $achievement->image ?>" class="icon"
                 style="border-color: #<?php echo $achievement->color ?>;">
            <div class="info">
                <div class="name"><?php echo $achievement->name ?></div>
                <div class="description"><?php echo $achievement->description ?></div>
                <div class="meta">
                    <?php
                    echo 'Достижение ' . $achievement->level . ' уровня';
                    //echo ', получено ' . date('d F Y H:i:s', strtotime($achievement->time_sent)+($currentUser->timezone * 3600));
                    echo ' за ' . date('d F Y', strtotime($achievement->time_set)+($currentUser->timezone * 3600));
                    $fromUser = new User($achievement->from);
                    global $user;
                    if (!($fromUser->id == $user->id)) {
                        echo ' от <a href="profile.php?id=' . $fromUser->id . '">' . $fromUser->username . '</a>';
                    }
                    echo '.';
                    ?>
                </div>
            </div>
        </div>
        <?php
    }
    $achievements = Achievement::getUserAchievementsList($id, 5);
    foreach ($achievements as $achievement) {
        printAchievementBlock($achievement);
    }
}

if ($_GET['id'] && $_GET['id'] != $currentUser->id) {
    $user = new User($_GET['id']);
    $title = 'Профиль ' . $user->username;
} else {
    $user = $currentUser;
    $title = 'Мой профиль';
    $current_page = 'profile';
}
$showSidebar = true;

if (!isset($user->id)) {
    $title = 'Нет такого профиля';
    global $listMessages;
    $listMessages->addError('Пользователя с данным ID не существует :(', 'Ошибка');
    Markup::pageStart();
} else {
    Markup::pageStart();
?>

<h1>Профиль: <?php echo $user->username; ?></h1>
<h2>Информация</h2>
<div class="section">
    <div class="avatar">
        <div class="level"><?php echo $user->level; ?></div>
        <img src="<?php echo $user->avatar; ?>">
    </div>
    <div class="profile-info">
        <div>
            <?php echo ($user->fullname ? ($user->fullname . ', ') : ''); ?>
            <?php echo ($user->birthday == '0000-00-00') ? '' : $user->birthday; ?>
        </div>
        <div><?php
        if ($user->description) {
            echo $user->description;
        } else {
            echo 'Пользователь пока не оставил информации о себе.';
        } ?></div>
    </div>
</div>
<h2>Общая статистика</h2>
<div class="section profile-stats">
    <div>Достижений: <?php echo $user->achievement_count; ?></div>
    <div>Уровень: <?php echo $user->level; ?></div>
</div>
<h2>Последние достижения</h2>
<div class="section achievements-list">
    <?php showAchievementsList($user->id); ?>
    <div class="center-buttons">
        <a href="achievements.php?id=<?php echo $user->id; ?>" class="center-button">Все достижения</a>
    </div>
</div>

<?php
}
Markup::pageEnd();
?>
