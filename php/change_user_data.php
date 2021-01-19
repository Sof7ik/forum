<?
require_once './connection.php';

$toDo = $_POST['whatToChange'];
$userId = unserialize($_COOKIE['user'])['id'];

if ($toDo === 'Изменить email')
{
    $email = $_POST['userEmail'];

    if ($email !== '')
    {
        $updateUser = $pdo->prepare(
            "UPDATE `users` SET `email` = :email  WHERE `id` = :id"
        );
    
        if (!$updateUser->execute(array('email' => $email, 'id' => $userId)))
        {
            $errorArray = [
                'updateErrors' => [
                    [
                        'code' => 8,
                        'message' => 'Что-то пошло не так. Попробуйте еще раз'
                    ]
                ]
            ];
    
            setcookie('errors', serialize($errorArray), time()+10, '/');
        }
    }
    else 
    {
        $errorArray = [
            'updateErrors' => [
                [
                    'code' => 8,
                    'message' => 'Email не валидный'
                ]
            ]
        ];
    
        setcookie("errors", serialize($errorArray), time()+10, '/');
    }
}
else if ($toDo === 'Изменить пароль')
{
    $password = $_POST['userPass'];

    if ($password !== '')
    {
        $updateUser = $pdo->prepare(
            "UPDATE `users` SET `password`=:pass WHERE `id` = :id"
        );
    
        if (!$updateUser->execute(array('pass' => $password, 'id' => $userId)))
        {
            $errorArray = [
                'updateErrors' => [
                    [
                        'code' => 8,
                        'message' => 'Что-то пошло не так. Попробуйте позже'
                    ]
                ]
            ];
        
            setcookie("errors", serialize($errorArray), time()+10, '/');
        }
    }
    else 
    {
        $errorArray = [
            'updateErrors' => [
                [
                    'code' => 8,
                    'message' => 'Пароль не валидный'
                ]
            ]
        ];
    
        setcookie("errors", serialize($errorArray), time()+10, '/');
    }
}

header('Location: /pages/lk.php');
?>