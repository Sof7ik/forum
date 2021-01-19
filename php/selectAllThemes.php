<?php
require_once './../../php/connection.php';
$allThemes = $pdo->query(
    "SELECT
    `themes`.`id`,
    `themes`.`name` AS 'theme-name',
    `themes`.`description`,
    `themes`.`date`,
    `themes`.`image`,
    `themes`.`author`,
    `theme-status`.`name` AS 'theme-status',
    `users`.`name` AS `theme-author-name`,
    `users`.`surname` AS `theme-author-surname`,
    `theme-status`.`id` AS `theme-status-int`
    FROM
        ".dbname.".`themes`,
        ".dbname.".`theme-status`,
        ".dbname.".`users`
    WHERE
        `themes`.`status` = `theme-status`.`id` AND
        `themes`.`author` = `users`.`id` AND
        `themes`.`status` = `theme-status`.`id`
    ORDER BY 
        `themes`.`status`, 
        `themes`.`date` DESC;");
while ($theme = $allThemes->fetch()) 
{
    $date = new DateTime($theme['date']);
    $image = trim($theme['image']);

    if ($theme['theme-status-int'] == 1)
    {
        $status = 'moderation';
    }
    else if ($theme['theme-status-int'] == 2)
    {
        $status = 'accepted';
    }
    else if ($theme['theme-status-int'] == 3)
    {
        $status = 'declined';
    }
    ?>
    <div class="theme theme-admin <?=$status?>">
        <div class="theme-select">
            <input type="checkbox" name="themeAccept[]" value=<?=$theme['id']?> id="">
        </div>

        <div class="theme-info admin">
            <span class="theme-status" style="margin-bottom: 20px"><?=$theme['theme-status']?></span>

            <div class="theme-preview" style="background-image: url('/theme-thumbnail/<?=$image?>')"></div>
            <h3 class="theme-name"><?=$theme['theme-name']?></h3>
            <span class="theme-date mainpage-date"><?=$date->format('d.m.Y в H:i')?></span>
            <span class="theme-author mainpage-author">Автор - <?echo $theme['theme-author-name'].' '.$theme['theme-author-surname']?></span>
            <p class="theme-text"><?=$theme['theme-desc']?></p>
        </div>
    </div>
    <?php
}?>