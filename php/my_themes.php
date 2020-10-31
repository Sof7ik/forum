<?php
$user = unserialize($_COOKIE['user']);
$userId = $user['id'];

if(empty($_COOKIE['user']))
{
    header('Location: ./../index.php');
}

require_once './../php/connection.php';

$selectMyThemes = $pdo->prepare(
    "SELECT
        `themes`.`name` AS 'theme-name',
        `themes`.`date`,
        `themes`.`description`,
        `theme-status`.`name` AS 'status-name'
    FROM
        ".dbname.".`themes`,
        ".dbname."$dbname.`theme-status`,
        ".dbname."$dbname.`users`
    WHERE
        `themes`.`status` = `theme-status`.`id` AND
        `themes`.`author` = `users`.`id` AND
        `themes`.`author` = :userId
    ORDER BY `themes`.`status`");

$selectMyThemes->execute(array('userId' => $userId));

$counter = 1;
$index = 1;
while ($myTheme = $selectMyThemes->fetch()) {
    $date = new DateTime($myTheme['date']);
    $counter =  $counter === 1 ? 2 : 1;
    ?>
        <div class="theme-title my-theme-wrapper-<?=$counter?>">
            <h3><?=$myTheme['theme-name']?> <span>от</span> <span class="theme-date"><?=$date->format('d-m-Y h:i:s')?></span> </h3>
            <span class="theme-status"><?=$myTheme['status-name']?></span>
            <p class="theme-desc"><?=$myTheme['description']?></p>
        </div>
    <?php
    $index++;
}
?>

<!-- 

    User's themes order by moderation:
    
    1. Темы, которые ожидают модерацию
    2. Темы, которые прошли модерацию
    3. Темы, которые были отклонены

    Каждая тема должна включать в себя: название, текст, статус, дату создания в формате дд-мм-гггг чч:мм:сс


 -->
