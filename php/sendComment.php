<?php

require_once './connection.php';

$userId = unserialize($_COOKIE['user'])['id'];
$themeId = $_GET['themeId'];

$commentText = $_POST['commentText'];
$commentText = trim($commentText, " \r\0\x0B");

$sendCommnet = $pdo->prepare(
    "INSERT INTO 
        `comments`
            (`id`, `author`, `date`, `text`, `id_theme`) 
    VALUES (NULL, :user, NOW(), :text, :theme);
");

$commentInfo = [
    'user' => $userId,
    'text' => $commentText,
    'theme' => $themeId
];

$sendCommnet->execute($commentInfo);

header('Location: ./../pages/theme.php?id='.$themeId);

?>