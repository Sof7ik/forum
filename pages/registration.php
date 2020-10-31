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

    <title>Регистрация - Пульс Ивантеевки</title>

    <link rel='stylesheet' href='/styles/style.css'>
</head>
<body>
    <?php require './header.php'; ?>

    <main class="auth-main">

        <div class="container">

            <img src="/img/logo.png" alt="logo" class="reg-logo">

            <?php
            $errors = unserialize($_COOKIE['errors']);
            if (!empty($errors['regErrors']))
            {
                foreach ($errors['regErrors'] as $key => $error) {
                    ?>
                    <p class="error-message"><?=$error['message']?></p>
                    <?php
                }
            }
            ?>

            <p class="no-pass"></p>

            <form action="/php/registration.php" method="post" class="reg-form" id="regForm">

                <div class="input-wrapper">
                    <label for="userEmail">Email<span class="required"> *</span></label>
                    <input type="email" name="userEmail" id="userEmail" required>
                </div>

                <div class="input-wrapper">
                    <label for="userName">Имя<span class="required"> *</span></label>
                    <input type="text" name="userName" id="userName" required>
                </div>

                <div class="input-wrapper">
                    <label for="userSurname">Фамилия<span class="required"> *</span></label>
                    <input type="text" name="userSurname" id="userSurname" required>
                </div>

                <div class="input-wrapper">
                    <label for="userPassword">Пароль<span class="required"> *</span></label>
                    <input type="password" name="userPass" id="userPassword" required>
                </div>

                <div class="input-wrapper">
                    <label for="userPassword">Повторите пароль<span class="required"> *</span></label>
                    <input type="password" name="userPass2" id="userPassword2" required>
                </div>

                <input type="submit" value="Зарегистрироваться!" class="button submit-button">

            </form>

            <p class="not-registered">Уже зарегистрированы? <a href="/pages/auth.php">Войти!</a></p>

        </div>

    </main>

    <script src='/js/reg.js' defer></script>

</body>
</html>