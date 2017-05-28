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

$path = ltrim($_SERVER['REQUEST_URI'], '/'); //Обрезка начального слеша(-ей)
$elements = explode('/', $path); //Делим путь по слешам

if(count($elements) == 0)
    header('Location: index.php');
else switch(array_shift($elements)) //Выдираем первый элемент из массива и переключаем его
{
    case 'profile':
        if ($elements[0]) {
            header('Location: /profile.php?id=' . $elements[0]);
        } else {
            header('Location: /profile.php');
        }
        break;
    default:
        //header('Location: index.php?error404');
        //header('HTTP/1.1 404 Not Found');
}

?>
