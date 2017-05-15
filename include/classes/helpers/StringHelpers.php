<?php

namespace AchievementSu;

/**
 * Class StringHelpers
 * Вспомогательные функции для работы со строками.
 * @package AchievementSu
 */
class StringHelpers
{
    /**
     * Возврат случайной строки из латинских букв и цифр
     * @param int $length Длина строки
     * @return string Случайная строка
     */
    public static function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
