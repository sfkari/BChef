<?php
function connexion()
{
    $host = "localhost";
    $dbname = 'bchef_db';
    $username = 'root';
    $pass = '';
    $port = '3306';

    try {
        return new PDO("mysql:host=$host; port=$port;dbname=$dbname",$username, $pass);
    } catch (PDOException $e) {
        echo 'error ' . $e->getMessage();
    }
}
?>