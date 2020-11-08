<?php

$themeId = $_GET['id'];

require_once dirname(__DIR__) . '/php/connection.php';

$selectThemeInfo = $pdo->prepare(
    "SELECT
        `themes`.`id`,
        `themes`.`name` AS 'themename',
        `themes`.`description`,
        `themes`.`date`,
        `themes`.`images` AS 'theme-images',
        `themes`.`image` AS `theme-preview`,
        `users`.`name` AS 'authorname',
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
        <a href="/index.php?#theme-id-<?=$theme['id']?>" class="back-button">На главную</a>

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
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi animi facere tempora, laudantium repellat ratione nihil odit maxime incidunt? Expedita natus incidunt culpa soluta voluptate doloremque voluptas, maiores quisquam voluptates?
            Maiores quis facilis expedita temporibus ut nostrum rerum officiis ab laudantium quidem dignissimos nobis harum blanditiis minus distinctio tempore, dolorem perferendis quas cum. Adipisci cum quisquam reprehenderit? Atque, et perferendis?
            Quas doloremque aspernatur incidunt optio expedita quae, sunt fugiat odio laborum nesciunt. Reiciendis, veniam consequuntur fuga aliquam quasi quaerat ullam, sunt blanditiis voluptatem adipisci, ipsum similique natus velit nemo quidem.
            Alias, nisi! Quasi et rem aspernatur sit harum ducimus! Perferendis minima at architecto totam dolore necessitatibus nostrum ad. Molestias delectus quia earum voluptatem, doloremque beatae soluta ad recusandae eos magnam!
            Voluptatem repellat cum nesciunt iste quae quaerat alias quia temporibus iusto dignissimos optio rerum eaque, aut vero atque recusandae veniam ab fugit perferendis labore odio id maiores dolorum? Quia, error.
            Hic fugiat odio pariatur placeat necessitatibus quisquam et ducimus non iste quae voluptatum magnam perferendis, reiciendis nemo repellendus tempora corporis! Eligendi, tenetur! Odit, suscipit. Inventore, vitae. Eum laborum voluptate illo.
            Nam doloribus nemo impedit dicta dignissimos accusantium. Amet unde quod facilis maiores odio neque, nam aperiam incidunt perferendis velit eligendi eius harum quas iure eaque doloremque, vel cupiditate. Quia, voluptatum?
            Vitae voluptatem dolor optio odio et earum placeat quaerat vero quas quidem impedit quae deserunt debitis suscipit ut delectus, sequi consequatur, obcaecati consequuntur dolore sunt perferendis nemo sit. Quasi, saepe?
            Cumque laudantium totam a voluptatum nobis. Vitae ipsum, necessitatibus cupiditate quasi voluptas rem id ad eligendi deserunt dicta aut error, ipsam non repellat dignissimos. Magni sint delectus officiis numquam consequatur.
            Itaque nobis minima consectetur harum asperiores expedita illum culpa, ad eius sint quis quod voluptatem praesentium</p>

            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi animi facere tempora, laudantium repellat ratione nihil odit maxime incidunt? Expedita natus incidunt culpa soluta voluptate doloremque voluptas, maiores quisquam voluptates?
            Maiores quis facilis expedita temporibus ut nostrum rerum officiis ab laudantium quidem dignissimos nobis harum blanditiis minus distinctio tempore, dolorem perferendis quas cum. Adipisci cum quisquam reprehenderit? Atque, et perferendis?
            Quas doloremque aspernatur incidunt optio expedita quae, sunt fugiat odio laborum nesciunt. Reiciendis, veniam consequuntur fuga aliquam quasi quaerat ullam, sunt blanditiis voluptatem adipisci, ipsum similique natus velit nemo quidem.
            Alias, nisi! Quasi et rem aspernatur sit harum ducimus! Perferendis minima at architecto totam dolore necessitatibus nostrum ad. Molestias delectus quia earum voluptatem, doloremque beatae soluta ad recusandae eos magnam!
            Voluptatem repellat cum nesciunt iste quae quaerat alias quia temporibus iusto dignissimos optio rerum eaque, aut vero atque recusandae veniam ab fugit perferendis labore odio id maiores dolorum? Quia, error.
            Hic fugiat odio pariatur placeat necessitatibus quisquam et ducimus non iste quae voluptatum magnam perferendis, reiciendis nemo repellendus tempora corporis! Eligendi, tenetur! Odit, suscipit. Inventore, vitae. Eum laborum voluptate illo.
            Nam doloribus nemo impedit dicta dignissimos accusantium. Amet unde quod facilis maiores odio neque, nam aperiam incidunt perferendis velit eligendi eius harum quas iure eaque doloremque, vel cupiditate. Quia, voluptatum?
            Vitae voluptatem dolor optio odio et earum placeat quaerat vero quas quidem impedit quae deserunt debitis suscipit ut delectus, sequi consequatur, obcaecati consequuntur dolore sunt perferendis nemo sit. Quasi, saepe?
            Cumque laudantium totam a voluptatum nobis. Vitae ipsum, necessitatibus cupiditate quasi voluptas rem id ad eligendi deserunt</p>
        </article>

        <div class="images">

        <?
            $images = explode(',', $theme['theme-images']);

            foreach ($images as $key => $image) {
                ?>
                    <div class="theme-image" style="background-image: url('/theme-thumbnail/<?=$image?>')"></div>
                <?
            }
        ?>

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

            <div class="theme-title"><h2>Комментарии</h2></div>

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