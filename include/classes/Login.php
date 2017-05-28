<?php

namespace AchievementSu;

require_once 'User.php';

/**
 * Class Login.
 * Определяет текущего залогиненного пользователя.
 * @package AchievementSu
 */
class Login
{
    /**
     * @var User int|null Идентификатор текущего пользователя или NULL.
     */
    private $user;

    function __construct() {
        $this->user = NULL;

        global $db;
        if (($_COOKIE['id']) && ($_COOKIE['password'])) {
            $query = 'SELECT password FROM achi_users WHERE id=' . $_COOKIE['id'];
            if (($data = $db->query($query)->fetch_assoc()) && ($_COOKIE['password'] == $data['password'])) {
                $this->user = new User($_COOKIE['id']);
            }
        }
    }

    /**
     * @return bool Залогинен ли текущий пользователь.
     */
    public function isLoggedIn() {
        return isset($this->user);
    }

    /**
     * @return User Возвращает текущего пользователя.
     */
    public function getUser() {
        return $this->user;
    }
}
