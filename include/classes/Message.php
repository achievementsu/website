<?php

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
