<?php
$user = unserialize($_COOKIE['user']);

$name = $_POST['themeName'];
$themeDesc = $_POST['themeDesc'];
$userId = $user['id'];

$file = $_FILES['themeThumbnail'];

if (!file_exists(dirname(__DIR__) . '\theme-thumbnail\\'.$file['name']))
{
    if(move_uploaded_file($file['tmp_name'], dirname(__DIR__) . '\theme-thumbnail\\' . $file['name']))
    {
        require_once './connection.php';

        $newTheme = $pdo->prepare(
            "INSERT INTO 
                `themes`
                    (`id`, `name`, `description`, `image`, `date`, `author`, `status`) 
            VALUES 
                    (NULL, :name, :desc, :filename , NOW(), :userId, 1)");

        $themeInfo = ['name' => $name, 'desc' => $themeDesc, 'filename' => $file['name'],'userId' => $userId];

        if ($newTheme->execute($themeInfo))
        {
            header('Location: ./../pages/my_themes.php');
        }
    }
}


?>