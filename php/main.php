<?
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
        $date = new DateTime($theme['theme-date']);
        $date1 = $date->format('d.m.Y');

        if($tmp_date != $date1)
        {
            $tmp_date = $date1;
            ?>
                <div class="themes-date">
                    <p class='date-title'><?=$tmp_date?></p>
                    <div class="themes-date-wrapper">
            <?
        }?>

                        <a href="/pages/theme.php?id=<?=$theme['theme-id']?>" class="theme-url" id="theme_id-<?=$theme['theme-id']?>">
                            <div class="theme">

                                <div class="theme-preview" style="background-image: url('/theme-thumbnail/<?=$theme['image']?>')"></div>

                                <h3 class="theme-name"><?=$theme['theme-name']?></h3>

                                <span class="theme-date mainpage-date"><?=$date->format('d.m.Y в H:i')?></span>

                                <span class="theme-author mainpage-author">Автор - <?echo $theme['theme-author-name'].' '.$theme['theme-author-surname']?></span>

                                <p class="theme-text"><?=$theme['theme-desc']?></p>

                                <span class="theme-comments">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="25px" height="25px">
                                        <path d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M21.99 4c0-1.1-.89-2-1.99-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14l4 4-.01-18z"/>
                                    </svg>
                                    <?
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

                                    while ($comments = $countComments->fetch(PDO::FETCH_LAZY))
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
                    </div>
                </div>        
    <?}?>
