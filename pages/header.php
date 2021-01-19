<?php
    if (empty($_COOKIE['user']))
    {
        $href = '/pages/auth.php';
    } else {
        $href = '/pages/lk.php'; 
    }
    $user = unserialize($_COOKIE['user']);
?>

<header>

    <div class="header-wrapper">
        <div class="logo">
            <a href="/index.php" class="logo-url">
                <img src="/img/logo.png" alt="logo">
            </a>
            
        </div>

        <h1>
            <a href="/index.php">
                <span class="main-title">ПУЛЬС ИВАНТЕЕВКИ</span>
                <span class="sub-title">газета о жизни в Ивантеевке</span>
            </a>
        </h1>

    </div>

</header>

<div class="container nav-container">
    <nav class="navbar">

        <div class="items-wrapper">
            <a href="/index.php" class="navbar-item">Главная</a>
            <!-- <a href="#" class="navbar-item">Главная</a>
            <a href="#" class="navbar-item">Главная</a>
            <a href="#" class="navbar-item">Главная</a> -->
            <a href="/pages/rules.php" class="navbar-item">Правила форума</a>
        </div>

        <form action="/php/searchThemes.php" method="POST" class='searchForm'>
            <div class="search">
                <input type="text" name="searchQuery" id="searchQuery" class="input" placeholder="Название статьи...">

                <label for="searchPosts" class="searchLabel"></label>
                <input type="submit" id="searchPosts" style="display: none">
            </div>
        </form>
        
        <div class="login">
            <?
                if(empty($_COOKIE['user']))
                {
                    ?>
                    <a href="<?=$href;?>" class="login-button">
                        <svg id="Layer_1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 29 29">
                            
                            <path class="st0" d="M13.8 0C6.4.4.3 6.5 0 14c-.2 4.6 1.8 8.7 5 11.4 1.2 1.1 2.7 2 4.2 2.6 1.6.6 3.4 1 5.2 1 2 0 3.7-.3 5.3-.8 1.6-.5 3-1.2 4.2-2.1 3.2-2.5 5-6.5 5-11.6C29 6.3 22.1-.4 13.8 0zm.7 27c-2.8 0-5.3-.9-7.4-2.4.1-.5.4-1 .9-1.3.3-.2.7-.3 1.1-.3h1.4l1.5-1.7 1.1-1.5c.5.2.9.3 1.4.3.5 0 1-.1 1.5-.3l1.1 1.5 1.5 1.7H20c.4 0 .6.2 1 .4.6.3 1 1 1.1 1.7-2 1.2-4.6 1.9-7.6 1.9zm3.7-15c.5 0 .8.6.8 1v.4c0 .4-.2.6-.8.6H18v.6c0 1.9-1.8 3.5-3.4 3.5-1.7 0-3.6-1.7-3.6-3.6V14h-.2c-.5 0-.7-.2-.7-.6V13c0-.4.2-1 .8-1h.1V9c0-1.5 1.9-2 3-2h1c1.1 0 3 .7 3 2.1V12h.2zm5.6 11.7c-.6-1.5-2.2-2.6-3.9-2.6h-.4l-1.7-2.3c1.2-.9 2.1-2.3 2.3-3.7.8-.5 1-.7 1-1.7V13c0-.9-.3-1.5-1-2V8.1L20 8c-.1-.3-.3-.5-.5-.7C18.5 5.9 16.7 5 15 5h-1c-1.6 0-3.1.7-4.2 2-.2.3-.6.8-.7 1.1v.1L9 11c-.8.5-1 1.1-1 2v.4c0 .9.2 1.2 1 1.7.2 1.4 1.1 2.8 2.3 3.7l-1.7 2.3h-.4c-1.6 0-2.9.9-3.7 2.1-2.6-2.6-4-6.4-3.5-10.4.8-5.6 5.4-10.1 11.1-10.7 7.5-.9 13.9 5 13.9 12.4 0 4-1.1 7.1-3.2 9.2z"/></svg> 
                        <?='ВОЙТИ'?>
                    </a>
                    <?
                }
                else
                {
                    ?>
                    <a href="<?=$href;?>" class="login-button">
                        <svg id="Layer_1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 29 29">
                            <path class="st0" d="M13.8 0C6.4.4.3 6.5 0 14c-.2 4.6 1.8 8.7 5 11.4 1.2 1.1 2.7 2 4.2 2.6 1.6.6 3.4 1 5.2 1 2 0 3.7-.3 5.3-.8 1.6-.5 3-1.2 4.2-2.1 3.2-2.5 5-6.5 5-11.6C29 6.3 22.1-.4 13.8 0zm.7 27c-2.8 0-5.3-.9-7.4-2.4.1-.5.4-1 .9-1.3.3-.2.7-.3 1.1-.3h1.4l1.5-1.7 1.1-1.5c.5.2.9.3 1.4.3.5 0 1-.1 1.5-.3l1.1 1.5 1.5 1.7H20c.4 0 .6.2 1 .4.6.3 1 1 1.1 1.7-2 1.2-4.6 1.9-7.6 1.9zm3.7-15c.5 0 .8.6.8 1v.4c0 .4-.2.6-.8.6H18v.6c0 1.9-1.8 3.5-3.4 3.5-1.7 0-3.6-1.7-3.6-3.6V14h-.2c-.5 0-.7-.2-.7-.6V13c0-.4.2-1 .8-1h.1V9c0-1.5 1.9-2 3-2h1c1.1 0 3 .7 3 2.1V12h.2zm5.6 11.7c-.6-1.5-2.2-2.6-3.9-2.6h-.4l-1.7-2.3c1.2-.9 2.1-2.3 2.3-3.7.8-.5 1-.7 1-1.7V13c0-.9-.3-1.5-1-2V8.1L20 8c-.1-.3-.3-.5-.5-.7C18.5 5.9 16.7 5 15 5h-1c-1.6 0-3.1.7-4.2 2-.2.3-.6.8-.7 1.1v.1L9 11c-.8.5-1 1.1-1 2v.4c0 .9.2 1.2 1 1.7.2 1.4 1.1 2.8 2.3 3.7l-1.7 2.3h-.4c-1.6 0-2.9.9-3.7 2.1-2.6-2.6-4-6.4-3.5-10.4.8-5.6 5.4-10.1 11.1-10.7 7.5-.9 13.9 5 13.9 12.4 0 4-1.1 7.1-3.2 9.2z"/>
                        </svg>
                        <?=$user['name'].' '.$user['surname']?>
                    </a>
                    <div class="dropdown">
                        <div class="nav">
                            <!-- <a href="./../pages/lk.php" class="dropdown-item">Профиль</a> -->
                            <a href="/pages/my_themes.php" class="dropdown-item">Мои темы</a>

                            <?php
                            if($user['role'] === 1)
                            {
                                ?><a href="/pages/admin/all_themes.php" class="dropdown-item">Админка</a><?php
                            }
                            ?>

                            <a href="/php/logout.php" class="dropdown-item">Выход</a>
                        </div>
                    </div>
                    <?
                }
            ?>
        </div>
       
    </nav>
</div>