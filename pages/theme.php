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
            echo 'Тема - Пульс Ивантеевки';
        ?>
    </title>

    <link rel='stylesheet' href='/styles/style.css'>
</head>
<body>
    <?php require './header.php'; ?>

    <div class="container">

        <main class="theme-main">

            <?php require_once './aside.php';?>

            <div class="theme-info-wrapper">

                <?php require_once './../php/watch_theme.php';?>

                <form action='/php/sendComment.php?themeId=<?=$themeId?>' method='post' class="comment-form">
                    <div class="input-wrapper">
                        <label for="userPassword">Написать комментарий<span class="required"> *</span></label>
                        <textarea name="commentText" id="commentText" required></textarea>
                    </div>

                    <?
                        $userStatus = unserialize($_COOKIE['user'])['status'];
                        if (empty($_COOKIE['user']))
                        {
                            ?>
                            <abbr title="Чтобы оставлять ответы в темах, необходимо авторизоваться">
                                <input type="submit" value="Отправить комментарий" disabled class="button submit-button inactive">
                            </abbr>
                            <p style="text-align: left; margin-top: 5px;" class="not-registered"><a href="/pages/auth.php">Войти</a></p>
                            <?
                        }

                        if ($userStatus === 2)
                        {
                            //заблокирован
                            ?>
                            <abbr title="Вы не можете оставлять ответы в темах, так как аминистраторы форума временно заблокировали Вам эту возможность">
                                <input type="submit" value="Отправить комментарий" disabled class="button submit-button inactive">
                            </abbr>
                            <?
                        }
                        else if ($userStatus === 1)
                        {
                            //разблокирован
                            ?><input type="submit" value="Отправить комментарий" class="button submit-button"><?
                        }

                        $errors = unserialize($_COOKIE['errors']);
                        if (!empty($errors['commentErrors']))
                        {
                            foreach ($errors['commentErrors'] as $key => $error) {
                                ?>
                                <p class="error-message"><?=$error['message']?></p>
                                <?
                            }
                        }
                    ?>
                    
                </form>

            </div>

        </main>

    </div>

    <?include dirname(__DIR__) . '/pages/footer.php'?>

</body>
</html>