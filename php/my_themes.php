<?php
$user = unserialize($_COOKIE['user']);
$userId = $user['id'];

if(empty($_COOKIE['user']))
{
    header('Location: ./../index.php');
}

require_once './../php/connection.php';

$selectMyThemes = $pdo->prepare(
    "SELECT
        `themes`.`name` AS 'theme-name',
        `themes`.`date`,
        `themes`.`image` AS 'theme-preview',
        `themes`.`description`,
        `theme-status`.`name` AS 'status-name'
    FROM
        ".dbname.".`themes`,
        ".dbname."$dbname.`theme-status`,
        ".dbname."$dbname.`users`
    WHERE
        `themes`.`status` = `theme-status`.`id` AND
        `themes`.`author` = `users`.`id` AND
        `themes`.`author` = :userId
    ORDER BY `themes`.`status`");

$selectMyThemes->execute(array('userId' => $userId));

$counter = 1;
$index = 1;
while ($myTheme = $selectMyThemes->fetch()) {
    $date = new DateTime($myTheme['date']);
    $counter =  $counter === 1 ? 2 : 1;
    ?>

    <div class="theme">

        <?
            $url = $myTheme['theme-preview'] === '' ? 'https://via.placeholder.com/300x200.png' : '/theme-thumbnail//'.$myTheme['theme-preview'];

            $url = file_exists('/theme-thumbnail//'.$myTheme['theme-preview']) ? '/theme-thumbnail//'.$theme['theme-preview'] : 'https://via.placeholder.com/300x200.png' ;
        ?>
        <div class="theme-preview" style="background-image: url('<?=$url?>')"></div>

            <h3 class="theme-name"><?=$myTheme['theme-name']?></h3>

            <span class="theme-date mainpage-date"><?=$date->format('d.m.Y в H:i')?></span>

            <span class="theme-status"><?=$myTheme['status-name']?></span>

            <p class="theme-text"><?=$myTheme['desctiption']?></p>

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
    <?php
    $index++;
}
?>

<!-- 

    User's themes order by moderation:
    
    1. Темы, которые ожидают модерацию
    2. Темы, которые прошли модерацию
    3. Темы, которые были отклонены

    Каждая тема должна включать в себя: название, текст, статус, дату создания в формате дд-мм-гггг чч:мм:сс


 -->
