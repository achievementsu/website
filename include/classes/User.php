<?php

namespace AchievementSu;

/**
 * Class User.
 * Пользователь.
 * @package AchievementSu
 */
class User
{
    public $id;
    public $email;
    public $password;
    public $email_confirmed;
    public $registration_time;
    public $username;
    public $fullname;
    public $level;
    public $timezone;
    public $birthday;
    public $description;

    public $achievement_count;

    public $avatar;

    /**
     * Конструктор класса User по ID пользователя.
     * @param $id int Идентификатор пользователя.
     */
    function __construct($id) {
        global $db;

        $query = 'SELECT * FROM achi_users WHERE id=' . $id;
        $data = $db->query($query)->fetch_assoc();
        if (!$data) { return; }

        $this->id = $data['id'];
        $this->username = $data['username'];
        $this->password = $data['password'];
        $this->email = $data['email'];
        $this->email_confirmed = $data['email_confirmed'];
        $this->registration_time = $data['registration_time'];
        $this->fullname = $data['fullname'];
        $this->level = $data['level'];
        $this->timezone = $data['timezone'];
        $this->birthday = $data['birthday'];
        $this->description = $data['description'];

        $query = 'SELECT * FROM achi_achievements WHERE `to`=' . $id;
        if (($db->query($query)) && ($count = $db->query($query)->num_rows)) {
            $this->achievement_count = $count;
        } else {
            $this->achievement_count = 0;
        }

        if (file_exists('storage/avatars/' . $id . '.jpg')) {
            $this->avatar = 'storage/avatars/' . $id . '.jpg';
        } else if (file_exists('storage/avatars/' . $id . '.png')) {
            $this->avatar = 'storage/avatars/' . $id . '.png';
        } else if (file_exists('storage/avatars/' . $id . '.gif')) {
            $this->avatar = 'storage/avatars/' . $id . '.gif';
        } else {
            $this->avatar = 'storage/avatars/noavatar.png';
        }
    }

    /**
     * Регистрация пользователя на сайте
     * @param string $username Имя пользователя
     * @param string $email Почтовый ящик пользователя
     * @param string $password Пароль пользователя
     * @return bool Регистрация успешна или нет
     */
    public static function registerUser($username, $email, $password) {
        global $db, $listMessages;

        if (strlen($username) > 32) {
            $listMessages->addError('Слишком длинное имя пользователя.');
            return false;
        }
        if (!preg_match("|^[-0-9a-z_\.\s]+$|i", $username)) {
            $listMessages->addError('Имя пользователя содержит недопустимые символы.');
            return false;
        }
        if (strlen($email) > 50 || !preg_match("|^[-0-9a-z_\.]+@[-0-9a-z_^\.]+\.[a-z]{2,6}$|i", $email)) {
            $listMessages->addError('Пожалуйста, введите корректный E-mail.');
            return false;
        }
        if (strlen($password) < 6) {
            $listMessages->addError('Пароль должен содержать как минимум 6 символов.');
            return false;
        }

        $data = $db->query('SELECT * FROM achi_users WHERE email = "' . $email . '"');
        if ($data->num_rows) {
            $listMessages->addError('Данный почтовый ящик уже занят. Возможно, вы уже зарегистрировались - попробуйте войти на сайт, или же восстановить пароль, если Вы его забыли.');
            return false;
        }
        $data = $db->query('SELECT * FROM achi_users WHERE username = "' . $username . '"');
        if ($data->num_rows) {
            $listMessages->addError('Данное имя пользователя уже занято. Возможно, вы уже зарегистрировались - попробуйте войти на сайт, или же восстановить пароль, если Вы его забыли.');
            return false;
        }

        $password = password_hash($password, PASSWORD_DEFAULT);
        $query = 'INSERT INTO achi_users (username, email, password, email_confirmcode, registration_time) '
               . 'VALUES("' . $username . '", "' . $email . '", "' . $password . '", "' . StringHelpers::generateRandomString(10) . '", "' . date('Y.m.d H:i:s') . '")';
        $writeSuccess = $db->query($query);
        if (!$writeSuccess) {
            $listMessages->addError('Не удалось добавить нового пользователя в базу данных. Пожалуйста, свяжитесь с администрацией.');
            return false;
        }

        $listMessages->addSuccess('Поздравляем с успешной регистрацией. Добро пожаловать на Achievement.su!');
        return true;
    }

    /**
     * Функция, проверяющая валидность пользователя при входе
     * @param string $email Электронная почта пользователя
     * @param string $password Пароль пользователя
     * @return int ID пользователя при правильных данных, иначе -1
     */
    public static function isValid($email, $password) {
        global $db, $listMessages;

        $query = 'SELECT id, password FROM achi_users WHERE email = "' . $email . '"';
        if (($data = $db->query($query)->fetch_assoc()) && (password_verify($password, $data['password']))) {
            return $data['id'];
        } else {
            $listMessages->addError('Введены некорректные данные входа. Повторите попытку.');
            return -1;
        }
    }

    /**
     * Проверка, добавил ли один другого в друзья
     * @param int $subscriber Отправитель заявки
     * @param int $subscribant Получатель заявки
     * @return bool Добавил ли сабскрайбер сабскрибанта
     */
    public static function isSubscribers($subscriber, $subscribant) {
        global $db;
        $query = 'SELECT * FROM achi_friends WHERE subscriber = ' . $subscriber . ' AND subscribant = ' . $subscribant;
        return $db->query($query)->num_rows;
    }

    /**
     * Являются ли друзьми двое пользователей.
     * @param $user1 int Идентификатор первого.
     * @param $user2 int Идентификатор второго.
     * @return bool Результат проверки.
     */
    public static function isFriends($user1, $user2) {
        return User::isSubscribers($user1, $user2) && User::isSubscribers($user2, $user1);
    }

    /**
     * Отправка подтверждения почтового ящика пользователю с указанным идентификатором
     * @param int $id Идентификатор пользователя
     * @return bool Успешность отправки
     */
    public static function sendConfirmMail($id) {
        global $db;

        $query = 'SELECT email, email_confirmed, email_confirmcode FROM achi_users WHERE id = ' . $id;
        if (($data = $db->query($query)->fetch_assoc()) && (!$data['email_confirmed'])) {
            return mail($data['email'], 'Подтверждение регистрации на Achievement.su',
            '<p>Приветствую! Ваш почтовый ящик был использован для регистрации на '
            .'сайте Achievement.su. Если Вы не регистрировались на сайте, от Вас '
            .'ничего не требуется - неподтверждённый аккаунт будет удалён через три '
            .'дня. Иначе пройдите по <a href="http://achievement.su/confirm.php?id='
            . $id . '&code=' . $data['email_confirmcode'] . '">этой ссылке</a>'
            .' для завершения регистрации на сайте.</p>');
        }
        return false;
    }

    /**
     * Подтверждение почтового ящика
     * @param int $id Идентификатор пользователя
     * @param int $code Код подтверждения
     * @return bool Статус подтверждения ящика после выполнения функции
     */
    public static function confirmEmail($id, $code) {
        global $db;

        $query = 'SELECT email, email_confirmed, email_confirmcode FROM achi_users WHERE id = ' . $id;
        if ($data = $db->query($query)->fetch_assoc()) {
            if ($data['email_confirmed'] == 1) {
                return true;
            }
            if ($code == $data['email_confirmcode']) {
                $query = 'UPDATE achi_users SET email_confirmed = 1, email_confirmcode = "" WHERE id = ' . $id;
                if ($db->query($query)) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Возвращает массив друзей пользователя.
     * @param $id int Идентификатор пользователя
     * @return array Массив идентификаторов друзей.
     */
    public static function getFriendsList($id) {
        global $db;
        $query = 'SELECT subscribant FROM achi_friends WHERE subscriber = ' . $id
            . ' AND subscribant IN (SELECT subscriber FROM achi_friends WHERE subscribant = ' . $id . ')';
        $data = $db->query($query)->fetch_all(MYSQLI_NUM);
        return $data;
    }
}

?>
