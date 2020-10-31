<?php

require_once './connection.php';

$usersToUpdate = $_POST['usersAccept'];

if ($_POST['userDecision'] === 'Разблокировать')
{
    $acceptUsers = $pdo -> prepare("UPDATE ".dbname.".`users` SET `status`= 1 WHERE `id` = :userId");

    foreach ($usersToUpdate as $key => $user) {
        $acceptUsers->execute(array('userId' => $usersToUpdate[$key]));
    }
}
else if ($_POST['userDecision'] === 'Заблокировать')
{
    $acceptUsers = $pdo -> prepare("UPDATE ".dbname.".`users` SET `status`= 2 WHERE `id` = :userId");
    
    foreach ($usersToUpdate as $key => $user) {
        $acceptUsers->execute(array('userId' => $usersToUpdate[$key]));
    }
}

header('Location: ./../pages/admin/all_users.php');

?>