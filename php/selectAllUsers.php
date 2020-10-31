<?php
require_once './../../php/connection.php';
$allUsers = $pdo->query(
    "SELECT 
        `users`.`id`,
        `users`.`name` AS 'user-name', 
        `surname`,
        `roles`.`name` AS 'user-role', 
        `user-status`.`name` AS 'user-status' 
    FROM 
        `users`, 
        `user-status`, 
        `roles` 
    WHERE 
        `users`.`status` = `user-status`.`id` AND 
        `users`.`role` = `roles`.`id`
    ");

while ($user = $allUsers->fetch()) 
{   
    ?>
    <div class="theme theme-admin">
        <div class="theme-select">
            <input type="checkbox" name="usersAccept[]" id="" value="<?=$user['id']?>">
        </div>
        
        <div class="theme-info">
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
