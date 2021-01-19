<?

$query = $_POST['searchQuery'];

if ($query !== '')
{
    require_once './connection.php';

    $selectSearchedThemes = $pdo->prepare(
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
            `themes`.`name` LIKE :string AND
            `themes`.`status` = `theme-status`.`id` AND
            `themes`.`status` = 2 AND 
            `themes`.`author` = `users`.`id`
        ORDER BY `themes`.`date` DESC
    ");

    $selectSearchedThemes->execute(array('string' => "%$query%"));
}
?>

<!DOCTYPE html>
<html lang='ru'>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta name='keywords' content=' '/>
    <meta name='description' content=' '/>
    <meta name='owner' content='bychkov.l47@mail.ru'/>
    <meta name='author' lang='ru' content='ItWebteam <bychkov.l47@mail.ru>'/>
    <meta http-equiv='content-type' content='text/html; charset=utf-8' />
    <meta name='resource-type' content='Document'/>
    <meta name='robots' content='noindex,nofollow'/>

    <title><?=$query?> - Пульс Ивантеевки</title>

    <link rel='stylesheet' href='/styles/style.css'>

    <script src='' defer></script>
</head>
<body>

    <?php require './../pages/header.php'; ?>

    <div class='container'>

        <main class="themes" style="padding-top: 25px">

            <?php require './../pages/aside.php'; ?>

            <div class="themes-main">
                <div class="themes-wrapper mainpage">
                    <?
                        $tmp_date = "01.01.2000";
                        $index = 0;
                        while($theme = $selectSearchedThemes->fetch())
                        {
                            $date = new DateTime($theme['theme-date']);
                            $date1 = $date->format('d.m.Y');

                            if($tmp_date !== $date1)
                            {
                                $tmp_date = $date1;
                                if ($index >= 1)
                                {?>
                                        </div>
                                    </div>
                                <?}?>
                                    <div class="themes-date">
                                        <p class='date-title'><?=$tmp_date?></p>
                                        <div class="themes-date-wrapper">
                            <?}?>

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
                                                            echo "Комментариев в теме: ".$comments[0];
                                                        }
                                                        ?>
                                                    </span>
                                                </div>
                                            </a>       
                        <?
                            $index++;
                        }?>
                </div>
            </div>

        </main>
    </div>

    <?include './../pages/footer.php'?>
</body>
</html>