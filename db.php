<?php
// try {
//     $db = new PDO('mysql:host=localhost;dbname=ieee;port=3308', 'root', '', [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
// } catch (PDOException $e) {
//     echo 'Connection failed: ' . $e->getMessage();
// }












// composer require vlucas/phpdotenv
require_once __DIR__ . '/vendor/autoload.php';


$phpdotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$phpdotenv->load();






$dsn = 'mysql:hostname='.$_ENV['HOSTNAME'].';dbname='.$_ENV['DATABASE'].';port='.$_ENV['PORT'].';';
$user = $_ENV['USERNAME'];
$password = $_ENV['PASSWORD'];
$options = [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES => false];
$db = new PDO($dsn,$user,$password,$options);

$table_name = $_ENV['TABLE'];





















