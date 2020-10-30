<?php
require_once './php/connection.php';

$selectTheme=$pdo->query(
    "SELECT
        `themes`.`id` AS 'theme-id',
        `themes`.`name` AS 'theme-name',
        `themes`.`description` AS 'theme-desc',
        `themes`.`date` AS 'theme-date',
        `theme-status`.`name` AS 'theme-status',
        `users`.`name` AS 'theme-author-name',
        `users`.`surname` AS 'theme-author-surname'
    FROM
        $dbname.`themes`, 
        $dbname.`theme-status`, 
        $dbname.`users`
    WHERE
        `themes`.`status` = `theme-status`.`id` AND
        `themes`.`status` = 2 AND 
        `themes`.`author` = `users`.`id`
    ORDER BY `themes`.`date` DESC");

?>