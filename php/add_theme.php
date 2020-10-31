<?php
$user = unserialize($_COOKIE['user']);

$name = $_POST['themeName'];
$themeDesc = $_POST['themeDesc'];
$userId = $user['id'];

require_once './connection.php';

$newTheme = $pdo->prepare(
    "INSERT INTO 
        `themes`
            (`id`, `name`, `description`, `date`, `author`, `status`) 
    VALUES 
            (NULL, :name, :desc, NOW(), :userId, 1)");

$themeInfo = ['name' => $name, 'desc' => $themeDesc, 'userId' => $userId];

if ($newTheme->execute($themeInfo))
{
    header('Location: ./../pages/my_themes.php');
}
?>