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

    <title>Главная - Пульс Ивантеевки</title>

    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
    <link rel='stylesheet' href='./styles/style.css'>

</head>
<body>

<?php require './pages/header.php'; ?>

<div class="container">

    <main class="themes">

        <div class="themes-title">
            <h2 class="section-title">Темы форума</h2>
            <div class="useful-links">
                <a href="/pages/rules.php">Правила форума</a>
            </div>
        </div>

        <div class="themes-wrapper">

        <?php
        
            require_once './php/main.php';
            $tmp_date = "01.01.2000";
            while($theme = $selectTheme->fetch())
            {
                $countComments = $pdo->prepare("SELECT COUNT(`comments`.`id`)
                FROM
                    $dbname.`comments`,
                    $dbname.`users`,
                    $dbname.`themes`
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

        </div>

    </main>
    
</div>

</body>
</html>