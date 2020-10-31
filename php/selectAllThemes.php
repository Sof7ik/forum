<?php
require_once './../../php/connection.php';
$allThemes = $pdo->query(
    "SELECT
    `themes`.`id`,
    `themes`.`name` AS 'theme-name',
    `themes`.`description`,
    `themes`.`date`,
    `themes`.`author`,
    `theme-status`.`name` AS 'theme-status'
    FROM
        ".dbname.".`themes`,
        ".dbname.".`theme-status`
    WHERE
        `themes`.`status` = `theme-status`.`id`
    ORDER BY 
        `themes`.`status`;");
while ($theme = $allThemes->fetch()) 
{   
    ?>
    <div class="theme theme-admin">
        <div class="theme-select">
            <input type="checkbox" name="themeAccept[]" value=<?=$theme['id']?> id="">
        </div>
        
        <div class="theme-info">
            <h3 class="theme-name"><?=$theme['theme-name']?></h3>
            <span class="theme-status"><?=$theme['theme-status']?></span>
            <p class="theme-text"><?=$theme['description']?></p>
        </div>
    
    </div>
    <?php
}?>

<!-- <div class="theme theme-admin">
    <div class="theme-select">
        <input type="checkbox" name="themeAccept[]" id="">
    </div>
    
    <div class="theme-info">
        <h3 class="theme-name">Название темы</h3>
        <p class="theme-text">Краткий текст о теме - Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus accusantium fugit, beatae, fuga cumque nesciunt dicta mollitia voluptatem temporibus illo laudantium? Dignissimos corrupti enim, cum deserunt at harum maiores assumenda!</p>
    </div>
    
</div> -->