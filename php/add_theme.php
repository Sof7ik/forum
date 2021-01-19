<?php
$user = unserialize($_COOKIE['user']);

$name = $_POST['themeName'];
$themeDesc = $_POST['themeDesc'];
$userId = $user['id'];
$themePreview = $_FILES['themePreview'];
$text = $_POST['text'];

$files = $_FILES['themeImages'];
$newArrFiles = [];

foreach ($files as $key => $file) {
    foreach ($file as $key1 => $fileInfo)
    {
        $newArrFiles[$key1][$key] = $fileInfo;
    }
}

function moveFile($fileInfo)
{
    // $fileName = time() . $fileInfo['name'];
    $fileName = $fileInfo['name'];
    if (!file_exists(dirname(__DIR__) . '\theme-thumbnail\\' . $fileName))
    {
        if (move_uploaded_file($fileInfo['tmp_name'], dirname(__DIR__) . '\theme-thumbnail\\' . $fileName))
        {
            return $fileName;
        }
        else 
        {
            return false;
        }
    }
}

$files = '';

foreach ($newArrFiles as $key => $file) {
    if (!file_exists(dirname(__DIR__) . '\theme-thumbnail\\'.$file['name']))
    {
        if ($fileNameToDb = moveFile($file)) {

            if (strlen($files) !== 0)
            {
                $files = $files . ',' . $fileNameToDb;
            }
            else
            {
                $files = $fileNameToDb;
            }
            
        } else
        {
            $isSaved = false;

            $errorArray = [
                'addThemeErrors' => [
                    [
                        'code' => 03,
                        'message' => 'Ошибка при сохранении файла'
                    ]
                ]
            ];
            header('Location: ./../pages/add_theme.php');
        }
    }
    else
    {
        $errorArray = [
            'addThemeErrors' => [
                [
                    'code' => 04,
                    'message' => 'Такой файл уже существует. Попробуйте переименовать файл изображения на своем компьютере'
                ]
            ]
        ];
        header('Location: ./../pages/add_theme.php');
    }
    if (!empty($errorArray))
    {
        setcookie("errors", serialize($errorArray), time()+10, '/');
    }
}

if (!file_exists(dirname(__DIR__) . '\theme-thumbnail\\'.$themePreview['name']))
{
    if ($PreviewFileNameToDb = moveFile($themePreview)) {

        require_once './connection.php';

        $newTheme = $pdo->prepare(
            "INSERT INTO 
                `themes`
                    (`id`, `name`, `description`, `image`, `text`, `images`, `date`, `author`, `status`, `watches`) 
            VALUES 
                    (NULL, :name, :desc, :image, :text, :images, NOW(), :userId, 1, 0)");

        $themeInfo = ['name' => $name, 'desc' => $themeDesc, 'image' => $PreviewFileNameToDb, 'text' => $text, 'images' => $files, 'userId' => $userId];

        if ($newTheme->execute($themeInfo))
        {
            header('Location: ./../pages/my_themes.php');
        }
        else 
        {
            $errorArray = [
                'addThemeErrors' => [
                    [
                        'code' => 05,
                        'message' => 'Ошибка при добавлении записи'
                    ]
                ]
            ];
            header('Location: ./../pages/add_theme.php');
        }

    }
}
else 
{
    $errorArray = [
        'addThemeErrors' => [
            [
                'code' => 04,
                'message' => 'Такой файл уже существует. Попробуйте переименовать файл изображения на своем компьютере'
            ]
        ]
    ];
    header('Location: ./../pages/add_theme.php');
}

?>