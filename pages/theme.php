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
        $dbname.`themes`,
        $dbname.`users`
    WHERE
        `themes`.`author` = `users`.`id` AND
        `themes`.`id` = :themeId
    ");
$selectThemeComments = $pdo->prepare(
    "SELECT
        `users`.`name`,
        `users`.`surname`,
        `comments`.`date`,
        `comments`.`text`
    FROM
        $dbname.`users`,
        $dbname.`comments`,
        $dbname.`themes`
    WHERE
        `comments`.`author` = `users`.`id` AND
        `comments`.`id_theme` = `themes`.`id` AND
        `comments`.`id_theme` = :themeId
    ");


$selectThemeInfo->execute(array('themeId' => $themeId));
$selectThemeComments->execute(array('themeId' => $themeId));
?>

<!DOCTYPE html>
<html lang='ru'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta name='keywords' content=' '/>
    <meta name='description' content=' '/>
    <meta name='owner' content='bychkov.l47@mail.ru'/>
    <meta name='author' lang='ru' content='ItWebteam <bychkov.l47@mail.ru>'/>
    <meta http-equiv='content-type' content='text/html'; />
    <meta name='resource-type' content='Document'/>
    <meta name='robots' content='noindex,nofollow'/>
    <meta http-equiv='content-language' content='ru'/>
    <meta http-equiv='pragma' content='no-cache'/>

    <title>
        <?php
            // while($row = $selectThemeInfo->fetch(PDO::FETCH_LAZY))
            echo 'Тема - Пульс Ивантеевки';
        ?>
    </title>

    <link rel='stylesheet' href='/styles/style.css'>
</head>
<body>
    <?php require './header.php'; ?>

    <main class="theme-main">

        <div class="container">

            <?
                while($theme = $selectThemeInfo->fetch(PDO::FETCH_LAZY))
                {
                    $date = new DateTime($theme['date']);
                    ?>
                        <div class="theme-title">
                            <h3><?=$theme['name']?><span> от</span> <span class="theme-date"><?=$date->format('d.m.Y h:i')?></span> </h3>
                            <p class="theme-desc"><?=$theme['description']?></p>
                        </div>

                    <?
                }
            ?>

            <section class="theme-comments">

                <h2>Ответы в теме</h2>

                <?

                    while($comment = $selectThemeComments->fetch(PDO::FETCH_LAZY))
                    {
                        $date = new DateTime($comment['date']);
                        ?>
                            <section class="comment">
                                <h3 class="comment-author"><?echo $comment['name'].' '.$comment['surname']?> <span class="theme-date"><?=$date->format('d.m.Y h:i')?></span></h3>
                                <article><?=$comment['text']?></article>
                            </section>
                        <?
                    }
                
                ?>

                <!-- <section class="comment">
                    <h3 class="comment-author">Автор ответа <span class="theme-date">дд.мм.гггг чч:мм</span></h3>
                    <article>Текст ответа</article>
                </section>

                <section class="comment">
                    <h3 class="comment-author">Автор ответа <span class="theme-date">дд.мм.гггг чч:мм</span></h3>
                    <article>Текст ответа</article>
                </section>

                <section class="comment">
                    <h3 class="comment-author">Автор ответа <span class="theme-date">дд.мм.гггг чч:мм</span></h3>
                    <article>Текст ответа</article>
                </section>

                <section class="comment">
                    <h3 class="comment-author">Автор ответа <span class="theme-date">дд.мм.гггг чч:мм</span></h3>
                    <article>Текст ответа</article>
                </section>

                <section class="comment">
                    <h3 class="comment-author">Автор ответа <span class="theme-date">дд.мм.гггг чч:мм</span></h3>
                    <article>Текст ответа</article>
                </section> -->

            </section>

        </div>

    </main>
</body>
</html>