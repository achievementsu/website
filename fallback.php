<?php

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
