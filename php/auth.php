<?php
 
require_once './connection.php';

$email = $_POST['userEmail'];
$password = $_POST['userPass'];

$userInfo = [
    'email' => $email, 
    'password' => $password
];

$stmt = $pdo->prepare('SELECT * FROM `forum`.`users` WHERE `email` = :email AND `password` = :password');
$stmt->execute($userInfo);

while($row = $stmt->fetch(PDO::FETCH_LAZY))
{
    if ( count($row) > 0 )
    {
        $userArray = [
            "id" => $row['id'],
            "name" => $row['name'],
            "surname" => $row['surname'],
            "email" => $row['email'],
            "role" => $row['role'],
            "status" => $row['status']
        ];

        setcookie("user", serialize($userArray), time()+3600, '/');

        header('Location: ./../index.php');
    }
}
?>