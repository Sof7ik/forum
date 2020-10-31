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
            <?php require_once './php/main.php'; ?>
        </div>

    </main>
    
</div>

</body>
</html>