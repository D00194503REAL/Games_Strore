<?php

$dsn = "mysql:host=localhost;dbname=d00194503";
$username = "root";
$password = "";

try
{
    $db = new PDO($dsn, $username, $password);
    $db ->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
    $db ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    error_reporting(E_ALL);
    //echo 'it worked';
} catch (Exception $e) {
    $error_message = $e ->getMessage();
    include("database_error.php");
    exit();
}
