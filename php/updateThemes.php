<?php

require_once './connection.php';

$themesToUpdate = $_POST['themeAccept'];

if ($_POST['themeDecision'] === 'Одобрить')
{
    $acceptThemes = $pdo -> prepare("UPDATE ".dbname.".`themes` SET `status`= 2 WHERE `id` = :themeId");

    foreach ($themesToUpdate as $key => $theme) {
        $acceptThemes->execute(array('themeId' => $themesToUpdate[$key]));
    }
}
else if ($_POST['themeDecision'] === 'Отклонить')
{
    $acceptThemes = $pdo -> prepare("UPDATE ".dbname.".`themes` SET `status`= 3 WHERE `id` = :themeId");
    
    foreach ($themesToUpdate as $key => $theme) {
        $acceptThemes->execute(array('themeId' => $themesToUpdate[$key]));
    }
}

header('Location: ./../pages/admin/all_themes.php');

?>

<!-- Функционал администратора

Просмотр списка тем
    На данной странице должны выводиться все темы, которые присутствуют в системе. 

    Список тем должен быть отсортирован в следующем порядке:
        1. Новые темы, которые ожидают модерацию
        2. Одобренные темы
        3. Отклоненные темы

    Администратор может одобрить тему, тогда тема появляется на главной странице.

    Администратор может отклонить тему, тогда тема не появляется на главной странице.

Просмотр списка пользователей
    На данной странице должны выводиться все пользователи.

    Администратор должен иметь возможность заблокировать или разблокировать пользователя. Заблокированные пользователи не должны иметь возможности создавать тему и оставлять ответы. -->