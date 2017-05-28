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
 * Class Message.
 * Структура единичного сообщения для MessageList.
 * @package AchievementSu
 */
class Message {
    private $title;
    private $type;
    private $description;

    /**
     * Конструктор сообщения.
     * @param string $description Текст сообщения.
     * @param string $title Необязательный жирный заголовок.
     * @param string $type Тип: error, success, notify, white.
     */
    function __construct($description = '', $title = '', $type = 'notify') {
        $this->title = $title;
        $this->description = $description;
        $this->type = $type;
    }

    public function printMessage() {
        if ($this->description && $this->type) {
            echo '<div class="section info-box info-' . $this->type . '-box">';
            if ($this->title) {
                echo '<b>' . $this->title . '.</b> ';
            }
            echo $this->description . '</div>';
        }
    }
}
