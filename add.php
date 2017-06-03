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
require_once 'include/ext/ImageResize.php';
use \Eventviva\ImageResize;

global $login;
if (!$login->isLoggedIn()) {
    header('Location: index.php');
}
$currentUser = $login->getUser();

$title = 'Добавить достижение';
$current_page = 'add';
$showSidebar = true;

function sendAchievement() {
    global $db, $currentUser, $listMessages;

    // Валидность получателя
    if (!($_POST['to'] == $currentUser->id || User::isFriends($currentUser->id, $_POST['to']))) {
        $listMessages->addError('Получатель достижения должен являться Вашим другом или Вами.');
        return false;
    }

    // Разбор даты
    if (!$_POST['time']) {
        $_POST['time'] = date('Y-m-d H:i:s', time()+($currentUser->timezone * 3600));
    }
    if ($_POST['time'] && !strtotime($_POST['time'])) {
        $listMessages->addError('Дата указана в неприемлемом формате. Рекомендуемый формат: ГГГГ-ММ-ДД ЧЧ:ММ:СС');
        return false;
    }
    if ($_POST['time'] && strtotime($_POST['time']) && (strtotime($_POST['time'])-($currentUser->timezone * 3600) > time())) {
        $listMessages->addError('Вы не можете отправлять достижения будущего :)<br>Время было возвращено на круги своя.');
        $_POST['time'] = date('Y-m-d H:i:s', time()+($currentUser->timezone * 3600));
        return false;
    }

    if (!$_POST['name']) {
        $listMessages->addError('Необходимо ввести название достижения.');
        return false;
    }
    if (!$_POST['description']) {
        $listMessages->addError('Необходимо описать достижение.');
        return false;
    }

    if (
    !(strlen($_POST['color']) == 3 || strlen($_POST['color']) == 6) ||
    !preg_match("|^[0-9a-f]+$|i", $_POST['color'])
    ) {
        $_POST['color'] = '000000';
    }

    if (!isset($_FILES['icon']['error']) || is_array($_FILES['icon']['error'])) {
        $listMessages->addError('Ошибка загрузки иконки: неподобающие параметры...');
        return false;
    }
    switch ($_FILES['icon']['error']) {
        case UPLOAD_ERR_OK: break;
        case UPLOAD_ERR_NO_FILE:
            $listMessages->addError('Ошибка загрузки иконки: файл не был отправлен...');
            return false;
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            $listMessages->addError('Ошибка загрузки иконки: превышен максимальный размер...');
            return false;
        default:
            $listMessages->addError('Ошибка загрузки иконки: неизвестная ошибка...');
        return false;
    }

    if ($_FILES['icon']['size'] > 10000000) {
        $listMessages->addError('Ошибка загрузки иконки: превышен максимальный размер...');
        return false;
    }

    $size = getimagesize($_FILES['icon']['tmp_name']);
    $mime = $size['mime'];
    switch ($mime) {
        case 'image/jpeg': $ext = 'jpg'; break;
        case 'image/png': $ext = 'png'; break;
        case 'image/gif': $ext = 'gif'; break;
        default:
            $listMessages->addError('Ошибка загрузки иконки: файл не является изображением.');
            return false;
    }

    // http://php.net/manual/ru/features.file-upload.php
    /*$finfo = new finfo(FILEINFO_MIME_TYPE);
    if (false === $ext = array_search(
        $finfo->file($_FILES['icon']['tmp_name']),
        array(
            'jpg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
        ),
        true
    )) {
        $listMessages->addError('Ошибка загрузки файла: формат файла неприемлем...');
        return false;
    }*/

    $fileName = sprintf('%s.%s',
        //sha1_file($_FILES['icon']['tmp_name']),
        StringHelpers::generateRandomString(20),
        $ext
    );
    $filePath = 'storage/icons/' . $fileName;

    if (!move_uploaded_file($_FILES['icon']['tmp_name'], $filePath)) {
        $listMessages->addError('Ошибка загрузки иконки: не удалось переместить загруженный файл...');
        return false;
    }

    $icon = new ImageResize($filePath);
    $icon->crop(64, 64);
    $icon->save($filePath);

    $timeset = date('Y-m-d H:i:s', strtotime($_POST['time'])-($currentUser->timezone * 3600));
    $timesent = date('Y-m-d H:i:s', time());

    $query = 'INSERT INTO achi_achievements (`from`, `to`, `status`, `name`, `description`, `color`, `time_sent`, `time_set`, `level`, `image`) '
           . 'VALUES("' . $currentUser->id . '", "' . $_POST['to'] . '", "1", "' . $_POST['name'] . '", "' . $_POST['description'] . '", '
           . '"' . $_POST['color'] . '", "' . $timesent . '", "' . $timeset . '", "' . $_POST['level'] . '", "' . $fileName . '")';
    $writeSuccess = $db->query($query);
    if (!$writeSuccess) {
        $listMessages->addError('Не удалось записать Ваше достижение в базу данных. Пожалуйста, свяжитесь с администрацией.');
        return false;
    }

    $listMessages->addSuccess('Достижение успешно отправлено!');
    $_POST = array();
    return true;
}

function showSendList() {
    global $db, $currentUser;
    echo '<select name="to" required>';
    echo '<option value="' . $currentUser->id . '"';
    if (!$_GET['id'] && !$_POST['to']) {
        echo ' selected';
    }
    echo '>' . $currentUser->username . "</option>\n";

    $query = 'SELECT id, username FROM achi_users WHERE'
           . '(achi_users.id IN (SELECT subscriber FROM achi_friends WHERE subscribant = ' . $currentUser->id . ')) AND'
           . '(achi_users.id IN (SELECT subscribant FROM achi_friends WHERE subscriber = ' . $currentUser->id . '))';

    $result = $db->query($query);
    while ($data = $result->fetch_assoc()) {
        echo '<option value="' . $data['id'] . '"';
        if (!$_POST['to'] && $_GET['id'] == $data['id'] || $_POST['to'] == $data['id']) {
            echo ' selected';
        }
        echo '>' . $data['username'] . "</option>";
    }

    echo '</select>';
}

if (!$_POST['to']) {
    if (!($_POST['to'] = $_GET['id'])) {
        $_POST['to'] = $currentUser->id;
    }
}
if ($_POST['level'] > 10) {
    $_POST['level'] = 10;
} elseif ($_POST['level'] < 1 || (!preg_match("|^[0-9]+$|i", $_POST['level']))) {
    $_POST['level'] = 1;
}

if ($_POST['send']) {
    sendAchievement();
}

Markup::pageStart();

?>

<h1>Добавить новое достижение</h1>
<form class="inputform" enctype="multipart/form-data" method="POST">
    <h2>Адресант достижения</h2>
    <div class="section">
            <div class="setting">
                <label class="setting-label" for="to">Достижение для</label>
                <div class="setting-control">
                    <?php showSendList(); ?>
                </div>
            </div>
            <div class="setting">
                <label class="setting-label" for="time">Дата и время получения</label>
                <div class="setting-control">
                    <input name="time" type="datetime" value="<?php echo $_POST['time']; ?>">
                </div>
            </div>
    </div>
    <h2>Подробности достижения</h2>
    <div class="section">
        <div class="setting">
            <label class="setting-label" for="name">Название достижения</label>
            <div class="setting-control">
                <input name="name" required value="<?php echo $_POST['name']; ?>">
            </div>
        </div>
        <div class="setting">
            <label class="setting-label" for="description">Описание</label>
            <div class="setting-control">
                <input name="description" required value="<?php echo $_POST['description']; ?>">
            </div>
        </div>
        <div class="setting">
            <label class="setting-label" for="level">Выберите уровень достижения</label>
            <div class="setting-control">
                <select name="level" required>
                    <option value="1"<?php if ($_POST['level'] == 1) { echo ' selected'; }?>>1: Незначительное достижение-однодневка</option>
                    <option value="2"<?php if ($_POST['level'] == 2) { echo ' selected'; }?>>2: Труд нескольких дней</option>
                    <option value="3"<?php if ($_POST['level'] == 3) { echo ' selected'; }?>>3: Уже месяц...</option>
                    <option value="4"<?php if ($_POST['level'] == 4) { echo ' selected'; }?>>4: Уже несколько месяцев...</option>
                    <option value="5"<?php if ($_POST['level'] == 5) { echo ' selected'; }?>>5: Уже полгода...</option>
                    <option value="6"<?php if ($_POST['level'] == 6) { echo ' selected'; }?>>6: Поднялся на ступеньку по лестнице жизни</option>
                    <option value="7"<?php if ($_POST['level'] == 7) { echo ' selected'; }?>>7: Крупное жизненное достижение</option>
                    <option value="8"<?php if ($_POST['level'] == 8) { echo ' selected'; }?>>8: Очень крупное жизненное достижение</option>
                    <option value="9"<?php if ($_POST['level'] == 9) { echo ' selected'; }?>>9: Огромный жизненный результат</option>
                    <option value="10"<?php if ($_POST['level'] == 10) { echo ' selected'; }?>>10: Предельно глобальное достижение</option>
                </select>
            </div>
        </div>
        <div class="setting">
            <label class="setting-label" for="color">Выберите цвет достижения<br>(в HEX формате без #)</label>
            <div class="setting-control">
                <input name="color" value="<?php echo $_POST['color']; ?>">
            </div>
        </div>
        <div class="setting">
            <label class="setting-label" for="icon">Загрузите иконку достижения</label>
            <div class="setting-control">
                <input type="hidden" name="MAX_FILE_SIZE" value="10000000">
                <input name="icon" type="file" required>
            </div>
        </div>
        <div class="actions">
            <input type="submit" name="send" value="Отправить">
        </div>
    </div>
</form>

<?php Markup::pageEnd(); ?>
