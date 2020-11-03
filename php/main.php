<?php
require_once './php/connection.php';

$selectTheme=$pdo->query(
    "SELECT
        `themes`.`id` AS 'theme-id',
        `themes`.`name` AS 'theme-name',
        `themes`.`description` AS 'theme-desc',
        `themes`.`image`,
        `themes`.`date` AS 'theme-date',
        `theme-status`.`name` AS 'theme-status',
        `users`.`name` AS 'theme-author-name',
        `users`.`surname` AS 'theme-author-surname'
    FROM
        ".dbname.".`themes`, 
        ".dbname.".`theme-status`, 
        ".dbname.".`users`
    WHERE
        `themes`.`status` = `theme-status`.`id` AND
        `themes`.`status` = 2 AND 
        `themes`.`author` = `users`.`id`
    ORDER BY `themes`.`date` DESC");

    $tmp_date = "01.01.2000";
    while($theme = $selectTheme->fetch())
    {
        $countComments = $pdo->prepare("SELECT COUNT(`comments`.`id`)
        FROM
            ".dbname.".`comments`,
            ".dbname.".`users`,
            ".dbname.".`themes`
        WHERE
            `comments`.`id_theme` = `themes`.`id` AND 
            `comments`.`id_theme` = :themeID AND
            `comments`.`author` = `users`.`id`");

        $countComments -> execute(array('themeID' => $theme['theme-id']));

        $date = new DateTime($theme['theme-date']);
        $date1 = $date->format('d.m.Y');

        if(!($tmp_date == $date1))
        {
            $tmp_date = $date1;
            echo "<p class='date-title'>".$tmp_date."</p>";
        }?>

        <a href="/pages/theme.php?id=<?=$theme['theme-id']?>" class="theme-url" id="theme_id-1">
            <div class="theme">

                <h3 class="theme-name">
                    <?=$theme['theme-name']?>
                    <span class="theme-date">
                        <? 
                            echo $date->format('d.m.Y в H:i');
                        ?>
                    </span>
                </h3>

                <span class="theme-author">Автор - <?echo $theme['theme-author-name'].' '.$theme['theme-author-surname']?></span>

                <div class="img-wrapper">
                    <img src="<?='\theme-thumbnail\\'.$theme['image']?>" alt="theme-thumbnail" class="theme-sumbnail">
                    <img src="<?='\theme-thumbnail\\'.$theme['image']?>" alt="theme-thumbnail" class="theme-sumbnail">
                    <img src="<?='\theme-thumbnail\\'.$theme['image']?>" alt="theme-thumbnail" class="theme-sumbnail">
                </div>

                <p class="theme-text"><?=$theme['theme-desc']?></p>

                <span class="theme-comments">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="25px" height="25px">
                        <path d="M0 0h24v24H0z" fill="none"/>
                        <path d="M21.99 4c0-1.1-.89-2-1.99-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14l4 4-.01-18z"/>
                    </svg>
                    <?while ($comments = $countComments->fetch(PDO::FETCH_LAZY))
                    {
                        if ($comments[0] % 2 == 0)
                        {
                            echo $comments[0].' ответа в теме';
                        }

                        elseif (($comments[0] % $comments[0] == 0) && ($comments[0] !== 0))
                        {
                            echo $comments[0].' ответ в теме';
                        }

                        else if ($comments[0] === 0)
                        {
                            echo $comments[0].' ответов в теме';
                        }
                        
                    }?>
                </span>
            </div>
        </a> 
        <?php
    }

?>

<!-- <a href="/pages/theme.php" class="theme-url" id="theme_id-2">
            <div class="theme">

                <h3 class="theme-name">Название темы</h3>
                <p class="theme-text">Краткий текст о теме - Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus accusantium fugit, beatae, fuga cumque nesciunt dicta mollitia voluptatem temporibus illo laudantium? Dignissimos corrupti enim, cum deserunt at harum maiores assumenda!</p>
                <span class="theme-comments">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="25px" height="25px">
                        <path d="M0 0h24v24H0z" fill="none"/>
                        <path d="M21.99 4c0-1.1-.89-2-1.99-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14l4 4-.01-18z"/>
                    </svg>
                    12 ответов
                </span>

            </div>
        </a>-->