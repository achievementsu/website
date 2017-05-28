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
