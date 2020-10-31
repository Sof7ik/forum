<?php

$themeId = $_GET['id'];

require_once dirname(__DIR__) . '/php/connection.php';

$selectThemeInfo = $pdo->prepare(
    "SELECT
        `themes`.`name`,
        `themes`.`description`,
        `themes`.`date`,
        `users`.`name`,
        `users`.`surname`
    FROM
        ".dbname.".`themes`,
        ".dbname.".`users`
    WHERE
        `themes`.`author` = `users`.`id` AND
        `themes`.`id` = :themeId
    ");

$selectThemeInfo->execute(array('themeId' => $themeId));

while($theme = $selectThemeInfo->fetch(PDO::FETCH_LAZY))
{
    $date = new DateTime($theme['date']);
    ?>
        <div class="theme-title">
            <h3><?=$theme['name']?> <span class="theme-date"><?=$date->format('d.m.Y H:i')?></span> </h3>
            <p class="theme-desc"><?=$theme['description']?></p>
        </div>

    <?php
}

$countComments = $pdo->prepare(
    "SELECT COUNT(`comments`.`id`)
    FROM
        ".dbname.".`comments`,
        ".dbname.".`themes`
    WHERE
        `comments`.`id_theme` = `themes`.`id` AND
        `comments`.`id_theme` = :themeId
    ");

    $countComments->execute(array('themeId' => $themeId));
    $countComments = $countComments->fetch();
    if($countComments[0] !== 0)
    {
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
    }
    ?>
        <section class="theme-comments">

            <h2>Ответы в теме</h2>

            <?

                if($countComments[0] === 0)
                {
                    echo "В этой теме ещё нет ни одного ответа. Будьте первым, кто его напишет!)";
                }

                if ($countComments[0] !== 0)
                {
                    while($comment = $selectThemeComments->fetch(PDO::FETCH_LAZY))
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