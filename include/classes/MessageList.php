<?php

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

