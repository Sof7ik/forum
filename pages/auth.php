<?php
if(!empty($_COOKIE['user']))
{
    header('Location: ./../index.php');
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

    <title>Авторизация - Пульс Ивантеевки</title>

    <link rel='stylesheet' href='/styles/style.css'>

    <script src='' defer></script>
</head>
<body>
    <?require './header.php'; ?>

    <main class="auth-page">
        <div class="container">
            <img src="/img/logo.png" alt="logo" class="reg-logo">

            <form action="./../php/auth.php" method="post" class="reg-form">

                <div class="input-wrapper">
                    <label for="userEmail">Email</label>
                    <input type="email" name="userEmail" id="userEmail" required>
                </div>

                <div class="input-wrapper">
                    <label for="userPassword">Пароль</label>
                    <input type="password" name="userPass" id="userPassword" required>
                </div>

                <input type="submit" value="Войти" class="button submit-button">

            </form>

            <p class="not-registered">Ещё не зарегистрированы? <a href="/pages/registration.php">Зарегистрируйтесь!</a></p>
        </div>
    </main>
</body>
</html>