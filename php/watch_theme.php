<?php

$themeId = $_GET['id'];

require_once dirname(__DIR__) . '/php/connection.php';

$selectThemeInfo = $pdo->prepare(
    "SELECT
        `themes`.`id`,
        `themes`.`name` AS 'themename',
        `themes`.`description`,
        `themes`.`date`,
        `themes`.`text` AS 'theme-text',
        `themes`.`images` AS 'theme-images',
        `themes`.`image` AS `theme-preview`,
        `themes`.`watches`,
        `users`.`name` AS 'authorname',
        `users`.`surname`
    FROM
        ".dbname.".`themes`,
        ".dbname.".`users`
    WHERE
        `themes`.`author` = `users`.`id` AND
        `themes`.`id` = :themeId
    ");

$updateWatches = $pdo->prepare("UPDATE `themes` SET `watches`= :watches WHERE `id` = :themeId");

$selectThemeInfo->execute(array('themeId' => $themeId));

while($theme = $selectThemeInfo->fetch(PDO::FETCH_LAZY))
{

    $updateWatches->execute( array('watches'=>$theme['watches']+1, 'themeId' => $themeId) );

    $date = new DateTime($theme['date']);
    ?>
        <a href="/index.php?#theme_id-<?=$theme['id']?>" class="back-button">На главную</a>

        <div class="theme-title" style="margin-top: 20px;">
            <h3><?=$theme['themename']?></h3>
        </div>
        
        <div class="theme-info">
            <p class="theme-desc"><?=$theme['description']?></p>

            <div class="date-author">
                <span class="theme-author"><?=$theme['authorname'].' '.$theme['surname']?></span>
                <span class="theme-date" style='margin-left: 0'><?=$date->format('d.m.Y H:i')?></span>
            </div>
            
        </div>

        <article>
            <p><?=$theme['theme-text']?></p>
        </article>

        <div class="images">

        <?
            $images = explode(',', $theme['theme-images']);

            foreach ($images as $key => $image) {
                $image = trim($image);
                ?>
                    <div class="theme-image" style="background-image: url('/theme-thumbnail/<?=$image?>')"></div>
                <?
            }
        ?>

        </div>

    <?php
}

    $selectThemeComments = $pdo->prepare(
        "SELECT
            `users`.`name`,
            `users`.`surname`,
            `comments`.`date`,
            `comments`.`text`
        FROM
            ".dbname.".`users`,
            ".dbname.".`comments`,
            ".dbname.".`themes`
        WHERE
            `comments`.`author` = `users`.`id` AND
            `comments`.`id_theme` = `themes`.`id` AND
            `comments`.`id_theme` = :themeId
        ORDER BY `comments`.`date`
    ");

    $selectThemeComments->execute(array('themeId' => $themeId));

    ?>
        <section class="theme-comments" id="comments">
            <div class="theme-title"><h2>Комментарии</h2></div>
            <?
                $index = 0;
                $comments = $selectThemeComments->fetchAll();

                if (count($comments) === 0)
                {
                    echo "В этой теме ещё нет ни одного ответа. Будьте первым, кто его напишет!)";
                }
                else 
                {
                    foreach($comments as $comment)
                    {
                        $date = new DateTime($comment['date']);
                        ?>
                            <section class="comment">
                                <h3 class="comment-author"><?echo $comment['name'].' '.$comment['surname']?> <span class="theme-date"><?=$date->format('d.m.Y H:i')?></span></h3>
                                <article><?=$comment['text']?></article>
                            </section>
                        <?
                    }
                }
            ?>
        </section>
    <?
?>
<!-- <section class="comment">
    <h3 class="comment-author">Автор ответа <span class="theme-date">дд.мм.гггг чч:мм</span></h3>
    <article>Текст ответа</article>
</section> -->