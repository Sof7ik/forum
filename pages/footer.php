<?
$links = [
    'ok' => "https://ok.ru/group/54967703830633",
    'facebook' => "https://www.facebook.com/gazeta.puls/",
    'twitter' => "https://twitter.com/pulsivanteevki",
    'youtube' => "https://www.youtube.com/channel/UCtpjEk_xxFWrHJcqPRnL15Q",
    "instagramm" => "https://www.instagram.com/puls_ivanteevki/",
    "web" => "http://inivanteevka.ru/", 
    "vk" => "https://vk.com/puls_ivanteevki"
]
?>

<footer>
    <div class="container">

        <div class="footer-info-wrapper">

            <div class="left-footer">
                <img src="/img/heart-rate-459225_1280.webp">
                <p>Пульс Ивантеевки - электронная газета</p>
            </div>

            <div class="center-footer">
                <ul class="links">
                    <li><a href="/index.php">Главная страница</a></li>
                    <li><a href="/pages/my_themes.php">Мои темы</a></li>
                    <li><a href="/pages/add_theme.php">Создать тему</a></li>
                    <li><a href="/pages/lk.php">Личный кабинет</a></li>
                    <li><a href="/pages/rules.php">Правила форума</a></li>
                </ul>

                <?
                $userRole = unserialize($_COOKIE['user'])['role'];
                if ($userRole === 1)
                {
                    ?>
                    <ul class="links">
                        <li><a href="/pages/admin/all_themes.php">Список тем</a></li>
                        <li><a href="/pages/admin/all_users.php">Список пользователей</a></li>
                    </ul>
                    <?
                };
                ?>

                
            </div>

            <div class="right-footer">
                <p>Контактые данные</p>

                <p class="address">Иванттевка,<br>пр. Маяковского, 3А</p>

                <div class="tels">
                    <a href="tel:+79050000000">+7 (905) 000-00-00</a>
                    <a href="tel:+79050000000">+7 (905) 000-00-00</a>
                </div>
                
            </div>

        </div>

        <div class="copyright">
            <p>Все права защищены, 2020-2021</p>

            <div class="social">
                <?foreach ($links as $key => $link) {
                    ?><a href="<?=$link?>" target="_blank" class="social-link <?=$key?>"></a><?
                }?>
               
            </div>
        </div>
       

    </div>
</footer>

