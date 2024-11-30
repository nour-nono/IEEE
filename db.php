<?php
// Autoload dependencies installed via Composer

require_once __DIR__ . '/vendor/autoload.php';

// to use $_ENV variables, we need to install phpdotenv package
// we should use this command to install the package: composer require vlucas/phpdotenv
// createImmutable method is used to load the .env file from the specified directory

$phpdotenv = \Dotenv\Dotenv::createImmutable(__DIR__);  // __DIR__ is a magic constant that returns the directory of the current file

/*
    load method is used to load the .env file and read the variables from it,  
    so we can use $_ENV['VARIABLE_NAME'] to access the variables
*/

$phpdotenv->load();

// Set up database connection parameters

$dsn = 'mysql:hostname='.$_ENV['HOSTNAME'].';dbname='.$_ENV['DATABASE'].';port='.$_ENV['PORT'].';';
$user = $_ENV['USERNAME'];
$password = $_ENV['PASSWORD'];
$options = [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES => false];

// Get the table name from environment variables

$table_name = $_ENV['TABLE'];

// Create a new PDO instance for database connection

$db = new PDO($dsn,$user,$password,$options);
