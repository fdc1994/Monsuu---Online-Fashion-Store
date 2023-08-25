<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "monsuu";

$ligacao = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($ligacao, 'utf8');

if ($ligacao->connect_error) {
    die("A Ligação Falhou!" . $ligacao->connect_error);
}
?>