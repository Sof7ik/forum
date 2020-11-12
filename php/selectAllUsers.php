<?php
$user = unserialize($_COOKIE['user']);
$userId = $user['id'];
require_once './../../php/connection.php';
$allUsers = $pdo->query(
    "SELECT 
        `users`.`id`,
        `users`.`name` AS 'user-name', 
        `surname`,
        `roles`.`name` AS 'user-role', 
        `user-status`.`name` AS 'user-status',
        `user-status`.`id` AS `user-status-int`
    FROM 
        `users`, 
        `user-status`, 
        `roles` 
    WHERE 
        `users`.`status` = `user-status`.`id` AND 
        `users`.`id` NOT IN(SELECT `id` FROM `users` WHERE `id` = $userId) AND
        `users`.`role` = `roles`.`id`
    ");

while ($user = $allUsers->fetch()) 
{   
    switch ($user['user-status-int']) {
        case '1':
            $status = 'accepted';
            break;
        case '2':
            $status = 'declined';
            break;
        default:
            break;
    }
    ?>
    <div class="user-admin <?=$status?>">
        <div class="user-select">
            <input type="checkbox" name="usersAccept[]" id="" value="<?=$user['id']?>">
        </div>
        
        <div class="user-info">
            <h3 class="theme-name"><?=$user['user-name'].' '.$user['surname']?></h3>
            <p class="theme-text"><?=$user['user-status']?></p>
        </div>
    </div>
    <?php
}?>

<!-- <div class="theme theme-admin">
    <div class="theme-select">
        <input type="checkbox" name="usersAccept[]" id="">
    </div>

    <div class="theme-info">
        <h3 class="theme-name">Имя автора</h3>
        <p class="theme-text">Заблокирован/Раблокирован</p>
    </div>
</div> -->
