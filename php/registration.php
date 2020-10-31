<?php
 
require_once './connection.php';

$insertUser = $pdo->prepare(
    "INSERT INTO 
    `users`
        (`id`, `name`, `surname`, `email`, `password`, `role`, `status`) 
    VALUES 
        (NULL, :name, :surname, :mail, :pass, 2, 1);
");

$userPassword = $_POST['userPass'];
$userPassword2 = $_POST['userPass2'];

if (trim($userPassword) === trim($userPassword2))
{
    $email = $_POST['userEmail'];

    $checkEmail = $pdo->prepare(
        "SELECT COUNT(`users`.`id`)
        from ".dbname.".`users`
        WHERE `email` = :email;
    ");
    $checkEmail->execute(array('email' => $email));
    $checkEmail = $checkEmail->fetch();

    if ($checkEmail[0] === 0)
    {
        $userName = $_POST['userName'];
        $userSurname = $_POST['userSurname'];

        $userInfo = [
            'name' => $userName,
            'surname' => $userSurname,
            'mail' => $email,
            'pass' => $userPassword
        ];
        $insertUser->execute($userInfo);

        header('Location: ./../pages/auth.php');
    }
    else
    {
        $errorArray = [
            'regErrors' => [
                [
                    'code' => 02,
                    'message' => 'Данный адрес электронной почты уже занят'
                ]
            ]
        ];
    
        setcookie("errors", serialize($errorArray), time()+10, '/');
    
        header('Location: ./../pages/registration.php');
    }
}
?>

<!-- 
    1. Email required unique
    2. Name required
    3. Surname required
    4. Password required

    role = User

    errors
 -->