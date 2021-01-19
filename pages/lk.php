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

    <title>Личный кабинет - Пульс Ивантеевки</title>

    <link rel='stylesheet' href='/styles/style.css'>

    <script src='' defer></script>
</head>
<body>
    <?php require './header.php'; ?>
    
    <main class="lk">

        <div class="container">

            <?
            $errors = unserialize($_COOKIE['errors']);
            if (!empty($errors['updateErrors']))
            {
                foreach ($errors['updateErrors'] as $key => $error) {
                    ?>
                    <p class="error-message"><?=$error['message']?></p>
                    <?php
                }
            }
            ?>

            <div class="change-data">
                <p>Изменить учетные данные</p>

                <form action="/php/change_user_data.php" method="POST">
                    <div class="input-wrapper">
                        <label for="userEmailToChange">Email</label>
                        <input type="email" name="userEmail" id="userEmailToChange" maxlength="255">
                    </div>
                    <input type="submit" value="Изменить email" class="button" name="whatToChange">

                    <div class="input-wrapper" style="margin-top: 20px">
                        <label for="userPasswordToChange">Пароль</label>
                        <input type="password" name="userPass" id="userPasswordToChange" maxlength="255">
                    </div>
                    <input type="submit" value="Изменить пароль" class="button" name="whatToChange">
                </form>
                
            </div>
            
            

        </div>

    </main>

    <?include dirname(__DIR__) . '/pages/footer.php'?>
</body>
</html>