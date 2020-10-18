<?php

$host = 'localhost';
$dbname = 'forum';
$user = 'root';
$pass = '';

try {  
    // $DBH расшифровывается как «database handle»

    # MySQL через PDO_MYSQL  
    $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

    // $DBH = null; - закрывает подключение к БД
}  
catch(PDOException $e) {  
    echo $e->getMessage();
}

?>