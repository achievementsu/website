<?php

require_once 'include/functions.php';

global $_GET, $listMessages;
if ((isset($_GET['id'])) && ($_GET['id'] > 0) && ($_GET['code'])) {
	if (User::confirmEmail($_GET['id'], $_GET['code'])) {
	    $listMessages->addSuccess('Ваш почтовый ящик подтверждён, спасибо!');
    } else {
        $listMessages->addError('Увы, ошибка подтверждения почтового ящика.');
    }
}

$title = 'Подтверждение регистрации';
$current_page = 'confirm';
$showSidebar = false;

Markup::pageStart();

?>



<?php

Markup::pageEnd();

?>
