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

    <title>Мои темы - Пульс Ивантеевки</title>

    <link rel='stylesheet' href='/styles/style.css'>
</head>
<body>
    <?php require './header.php'; ?>
    
    <div class="container">
    
        <main class="my-theme">
            <?
                $user = unserialize($_COOKIE['user']);
                $userStatus = $user['status'];

                if($userStatus === 1)
                {
                    ?>
                        <a href="./add_theme.php" class="button new-theme">Создать новую тему</a>
                    <?
                }
                else
                {
                    ?>
                        <abbr title="Вы не можете создавать темы, так как аминистраторы форума временно заблокировали Вам эту возможность">
                            <a class="button new-theme inactive">Создать новую тему</a>
                        </abbr>
                    <?
                }
            ?>

            <div class="themes-wrapper">
                <?php
                    require './../php/my_themes.php';
                ?>
            </div>
            

            <!-- <a href="/pages/theme.php" class="theme-url" id="theme_id-12">
                <div class="theme-title my-theme-wrapper-2">
                    <h3>Название темы <span>от</span> <span class="theme-date">гггг-мм-дд чч:мм</span> </h3>
                    <span class="theme-status">Статус темы</span>
                    <p class="theme-desc">Описание темы Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro, aspernatur molestias? Adipisci reiciendis necessitatibus odio a incidunt sapiente, nihil ab est omnis accusamus modi quisquam exercitationem aliquid soluta officia nemo!</p>
                </div>
            </a> -->

        </main>
    </div>

    <?include dirname(__DIR__) . '/pages/footer.php'?>

</body>
</html>