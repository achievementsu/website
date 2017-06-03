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

$title = 'Друзья';
$current_page = 'friends';
$showSidebar = true;

if (!$_POST['search'] && $_GET['act'] && $_GET['id'] && $_GET['id'] != $currentUser->id) {
    global $listMessages;
    $user = new User($_GET['id']);
    if (isset($user->id)) {
        global $db;
        if ($_GET['act'] == 'add') {
            $db->query('INSERT INTO achi_friends (subscriber, subscribant) VALUES(' . $currentUser->id . ', ' . $user->id . ')');
            if (User::isFriends($currentUser->id, $user->id)) {
                $listMessages->addNotify('Вы и ' . $user->username . ' теперь друзья!');
            } else {
                $listMessages->addNotify('Вы отправили предложение дружбы ' . $user->username . '.');
            }
        }
        if ($_GET['act'] == 'delete') {
            $wasFriends = User::isFriends($currentUser->id, $user->id);
            $db->query('DELETE FROM achi_friends WHERE subscriber = ' . $currentUser->id . ' AND subscribant = ' . $_GET['id'] . ' LIMIT 1');
            if ($wasFriends) {
                $listMessages->addNotify('Вы больше не дружите с ' . $user->username . '.');
            } else {
                $listMessages->addNotify('Заявка дружбы к ' . $user->username . ' отменена.');
            }
        }
    }
}

function showUserBlock($id) {
    global $currentUser;
    $user = new User($id);
    $subByLoggedIn = User::isSubscribers($currentUser->id, $user->id);
    $subOnLoggedIn = User::isSubscribers($user->id, $currentUser->id);
    ?>
    <div class="userline">
        <div class="avatar">
            <div class="level"><?php echo $user->level; ?></div>
            <img src="<?php echo $user->avatar ?>">
        </div>
        <div class="actions">
            <?php if ($subByLoggedIn && $subOnLoggedIn) { ?>
            <a href="add.php?id=<?php echo $user->id; ?>">Выдать достижение</a>
            <?php } else if (!$subByLoggedIn && $subOnLoggedIn) { ?>
            <a href="friends.php?id=<?php echo $user->id; ?>&amp;act=add">Принять заявку в друзья</a>
            <?php } else if (!$subByLoggedIn && !$subOnLoggedIn) { ?>
            <a href="friends.php?id=<?php echo $user->id; ?>&amp;act=add">Отправить заявку в друзья</a>
            <?php } ?>
            <a href="profile.php?id=<?php echo $user->id; ?>">Подробнее</a>
            <?php if ($subByLoggedIn && $subOnLoggedIn) { ?>
            <a href="friends.php?id=<?php echo $user->id; ?>&amp;act=delete">Удалить из друзей</a>
            <?php } else if ($subByLoggedIn && !$subOnLoggedIn) { ?>
            <a href="friends.php?id=<?php echo $user->id; ?>&amp;act=delete">Отменить заявку в друзья</a>
            <?php } ?>
        </div>
        <div class="info">
            <div><a href="profile.php?id=<?php echo $user->id; ?>"><?php echo $user->username; ?></a></div>
            <div><?php echo $user->fullname; ?></div>
            <div><?php echo $user->description; ?></div>
        </div>
    </div>
    <?php
}

Markup::pageStart();

?>

<h1>Поиск</h1>
<h2>Найти друга</h2>
<div class="section">
    <form id="add-friend" method="POST">
        <input type="text" tabindex="1" maxlength="32" value="<?php echo $_POST['username']; ?>" name="username">
        <input type="submit" tabindex="2" value="Поиск" name="search">
    </form>
</div>

<?php
if ($_POST['search'] && $_POST['username']) {
    $data = $db->query('SELECT * FROM achi_users WHERE username LIKE "%' . $_POST['username'] . '%"');
?>

<h1>Результаты поиска</h1>
<div id="friends">
    <h2>Найдено: <?php echo $data->num_rows; ?></h2>
    <div class="section">
        <?php
        if ($data->num_rows) {
            while ($result = $data->fetch_assoc()) {
                if ($result['id'] != $currentUser->id) {
                    showUserBlock($result['id']);
                }
            }
        }
        ?>
    </div>
</div>

<?php } else { ?>

<h1>Список друзей</h1>
<div id="friends">
    <?php
    $data = $db->query('SELECT * FROM achi_friends WHERE subscribant = ' . $currentUser->id);
    if ($data->num_rows) {
    ?>
    <h2>Входящие заявки</h2>
    <div class="section">
    <?php
        while ($result = $data->fetch_assoc()) {
            if (!User::isSubscribers($currentUser->id, $result['subscriber'])) {
                showUserBlock($result['subscriber']);
            }
        }
    ?>
    </div>
    <?php
    }

    $data = $db->query('SELECT * FROM achi_friends WHERE subscribant = ' . $currentUser->id);
    if ($data->num_rows) {
    ?>
    <h2>Друзья</h2>
    <div class="section">
    <?php
        while ($result = $data->fetch_assoc()) {
            if (User::isSubscribers($currentUser->id, $result['subscriber'])) {
                showUserBlock($result['subscriber']);
            }
        }
    ?>
    </div>
    <?php
    }

    $data = $db->query('SELECT * FROM achi_friends WHERE subscriber = ' . $currentUser->id);
    if ($data->num_rows) {
    ?>
    <h2>Исходящие заявки</h2>
    <div class="section">
    <?php
        while ($result = $data->fetch_assoc()) {
            if (!User::isSubscribers($result['subscribant'], $currentUser->id)) {
                showUserBlock($result['subscribant']);
            }
        }
    ?>
    </div>
</div>
    <?php
    }
}

Markup::pageEnd();

?>
