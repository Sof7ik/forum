<?php
$user = unserialize($_COOKIE['user']);
if ($user['role'] !== 1)
{
    header('Location: ./../../index.php');
}
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

    <title>Все темы форума - Пульс Ивантеевки</title>

    <link rel='stylesheet' href='/styles/style.css'>

    <script src='' defer></script>
</head>
<body>
    <?require './../header.php'; ?>
    
    <main class="themes">
        <div class="container">

            <div class="themes-wrapper" style="padding-top: 50px;">

                <form action="./../../php/admin.php" method="post">
                    <div class="toolbar">
                        <p style="margin-bottom: 10px;">С выделенными:</p>
                        <input type="submit" class="button" value="Одобрить">
                        <input type="submit" class="button" value="Отклонить">
                    </div>

                    <?php
                    require_once './../../php/connection.php';
                    $allThemes = $pdo->query("SELECT * FROM `forum`.`themes` ORDER BY `date` DESC;");
                    while ($theme = $allThemes->fetch())
                    {
                        ?>
                            <div class="theme theme-admin">
                                <div class="theme-select">
                                    <input type="checkbox" name="themeAccept[]" value="<?=$theme['id']?>" id="">
                                </div>
                                
                                <div class="theme-info">
                                    <h3 class="theme-name"><?=$theme['name']?></h3>
                                    <p class="theme-text"><?=$theme['description']?></p>
                                </div>
                                
                            </div>
                        <?php
                    }
                    
                    ?>

                    <!-- <div class="theme theme-admin">
                        <div class="theme-select">
                            <input type="checkbox" name="themeAccept[]" id="">
                        </div>
                        
                        <div class="theme-info">
                            <h3 class="theme-name">Название темы</h3>
                            <p class="theme-text">Краткий текст о теме - Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus accusantium fugit, beatae, fuga cumque nesciunt dicta mollitia voluptatem temporibus illo laudantium? Dignissimos corrupti enim, cum deserunt at harum maiores assumenda!</p>
                        </div>
                        
                    </div> -->

                </form>

            </div>

        </div>

    </main>

</body>
</html>