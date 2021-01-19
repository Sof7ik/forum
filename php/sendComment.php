<?php

require_once './connection.php';

$userId = unserialize($_COOKIE['user'])['id'];
$themeId = $_GET['themeId'];

$commentText = trim($_POST['commentText'], " \r\0\x0B");

if($commentText !== '')
{
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
}
else
{
    $errorArray = [
        'commentErrors' => [
            [
                'code' => 06,
                'message' => 'Нельзя оставить пустой комментарий'
            ]
        ]
    ];

    setcookie("errors", serialize($errorArray), time()+10, '/');
}

header('Location: ./../pages/theme.php?id='.$themeId.'#comments');

?>