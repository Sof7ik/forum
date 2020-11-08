<?php
$user = unserialize($_COOKIE['user']);
if ($user['role'] !== 1)
{
    header('Location: /index.php');
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

    <title>Все пользователи - Пульс Ивантеевки</title>

    <link rel='stylesheet' href='/styles/style.css'>

    <script src='' defer></script>
</head>
<body>
    <?require './../header.php'; ?>

    <?include_once './admin-nav.html';?>
    
    <main class="themes">
        <div class="container">

            <div class="themes-wrapper" style="padding-top: 50px;">

                <form action="/php/updateUsers.php" method="post">
                    <div class="toolbar">
                        <p style="margin-bottom: 10px;">С выделенными:</p>
                        <input type="submit" class="button accept" value="Разблокировать" name="userDecision">
                        <input type="submit" class="button decline" value="Заблокировать" name="userDecision">
                    </div>

                    <?require_once './../../php/selectAllUsers.php'?>
                </form>

            </div>

        </div>

    </main>

</body>
</html>