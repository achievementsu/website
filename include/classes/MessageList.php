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
require 'Message.php';

/**
 * Class MessageList.
 * Отвечает за формирование списка.
 * @package AchievementSu
 */
class MessageList {
    private $msgList;

    function __construct() {
        $this->msgList = array();
    }

    /**
     * Добавляет сообщение к списку.
     * @param string $description Основной текст сообщения.
     * @param string $title Жирный заголовок в начале сообщения (необязательный).
     * @param string $type Вид сообщения. Варианты: error, success, notify, white.
     */
    public function addMessage($description = '', $title = '', $type = 'notify') {
        if (!$description) {
            return;
            //throw new Exception('Empty message description.');
        }
        $this->msgList[] = new Message($description, $title, $type);
    }

    public function addError($description='', $title='') { $this->addMessage($description, $title, 'error'); }
    public function addSuccess($description='', $title='') { $this->addMessage($description, $title, 'success'); }
    public function addNotify($description='', $title='') { $this->addMessage($description, $title, 'notify'); }
    public function addWhite($description='', $title='') { $this->addMessage($description, $title, 'white'); }

    /**
     * Вывод списка сообщений на экран.
     */
    public function printMessages() {
        foreach ($this->msgList as $msg) {
            $msg->printMessage();
        }
    }
}

