<?php

namespace AchievementSu;

require_once 'User.php';

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
        $this->timeSent = $data['time_sent'];
        $this->timeSet = $data['time_set'];
        $this->level = $data['level'];
        $this->image = 'storage/icons/' . $data['image'];
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
        unset($a);
        return $result;
    }

    public static function getFriendsUpdatesFeed() {
        global $db, $currentUser;
        $result = array();
        $query = 'SELECT id FROM achi_achievements WHERE `to` = ' . $currentUser->id . ' OR `to` IN '
            . '(SELECT subscribant FROM achi_friends WHERE subscriber = ' . $currentUser->id . ' AND subscribant IN '
            . '(SELECT subscriber FROM achi_friends WHERE subscribant = ' . $currentUser->id . ')) '
            . 'ORDER BY time_sent DESC LIMIT 20';
        $ids = $db->query($query);
        while ($a = $ids->fetch_assoc()) {
            array_push($result, new Achievement($a['id']));
        }
        unset($a);
        return $result;
    }
}