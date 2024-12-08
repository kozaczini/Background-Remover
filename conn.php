<?php
$db_user = 'root';
$db_password = '';

$conn = new PDO('mysql:host=localhost;dbname=users_db', $db_user, $db_password);
if(!$conn){
    die("Nie udało się połączyć z bazą danych!");
}?>