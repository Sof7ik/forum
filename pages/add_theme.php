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

    <title>Создать новую тему - Пульс Ивантеевки</title>

    <link rel='stylesheet' href='/styles/style.css'>

    <script src='' defer></script>
</head>
<body>
    <?require './header.php'; ?>

    <main class="add-theme">

        <div class="container">
            <form enctype="multipart/form-data" action="./../php/add_theme.php" method="post" class="add-theme-form">
                <div class="input-wrapper">
                    <label for="themeName">Название темы<span class="required"> *</span></label>
                    <input type="text" name="themeName" id="themeName" required>
                </div>

                <div class="input-wrapper">
                    <label for="themeDesc">Описание темы<span class="required"> *</span></label>
                    <textarea name="themeDesc" id="themeDesc" required></textarea>
                </div>

                <div class="input-wrapper">
                    <label for="">Изображение<span class="required"> *</span></label>
                    <label for="themeThumbnail" class="file-label">Обзор</label>
                    <input type="hidden" name="MAX_FILE_SIZE" value="30000000" />
                    <input type="file" name="themeThumbnail" id="themeThumbnail" style="display: none;">
                </div>

                <input type="submit" value="Создать тему" class="button">
            </form>
        </div>

    </main>
</body>
</html>