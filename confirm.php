<?php

require_once 'include/functions.php';

global $_GET;
if ((isset($_GET['id'])) && ($_GET['id'] > 0) && ($_GET['code'])) {
	if (User::confirmEmail($_GET['id'], $_GET['code'])) {
    $listMessages[] = array(
      'type' => 'success',
      'description' => 'Ваш почтовый ящик подтверждён, спасибо!'
    );
  } else {
    $listMessages[] = array(
      'type' => 'error',
      'description' => 'Увы, ошибка подтверждения почтового ящика.'
    );
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
