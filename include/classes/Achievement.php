<?php

namespace AchievementSu;

/**
 * Class Achievement.
 * Достижение.
 * @package AchievementSu
 */
class Achievement
{
    public $id, $from, $to, $status, $name, $description, $color, $timeSent, $timeSet, $level, $image;

    /**
     * Конструктор Achievement по идентификатору достижения.
     * @param $id int ID достижения.
     */
    function __construct($id) {
        global $db;

        $query = 'SELECT * FROM achi_achievements WHERE `id`=' . $id;
        $data = $db->query($query)->fetch_assoc();
        if (!$data) { return; }

        $this->id = $data['id'];
        $this->from = $data['from'];
        $this->to = $data['to'];
        $this->status = $data['status'];
        $this->name = $data['name'];
        $this->description = $data['description'];
        $this->color = $data['color'];
        $this->timeSent = $data['timeSent'];
        $this->timeSet = $data['timeSet'];
        $this->level = $data['level'];
        $this->image = $data['image'];
    }

    /**
     * Возвращает массив достижений пользователя.
     * @param $userId int ИД пользователя
     * @param $limit int Количество вычитываемых достижений
     * @param $page int Номер страницы (от 0)
     * @return array Массив
     */
    public static function getUserAchievementsList($userId, $limit=10, $page=0) {
        global $db;
        $result = array();
        $query = 'SELECT id FROM achi_achievements WHERE `to`=' . $userId
            . ' ORDER BY `time_sent` DESC LIMIT ' . $limit . ' OFFSET ' . $page * $limit;
        $data = $db->query($query);
        while ($a = $data->fetch_assoc()) {
            array_push($result, new Achievement($a['id']));
        }
        return $result;
    }
}