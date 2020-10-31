<?php

define('host', 'localhost');
define('dbname', 'forum');
define('user', 'root');
define('pass', '');
define('charset', 'utf8');

# MySQL через PDO_MYSQL 
// $pdo = null; - закрывает подключение к БД

$dsn = "mysql:host=".host.";dbname=".dbname.";charset=".charset;
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_LAZY,
    PDO::ATTR_EMULATE_PREPARES   => false
];
$pdo = new PDO($dsn, user, pass, $opt);

?>