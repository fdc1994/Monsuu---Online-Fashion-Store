<?php

$servername = "localhost";
$username = "monsuupt_223bb78da41f44447ff0ad216d5a49d6b0f1c3";
$password = "Ben2010!,.";
$dbname = "monsuupt_monsuu";

$ligacao = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($ligacao, 'utf8');

if ($ligacao->connect_error) {
    die("A Ligação Falhou!" . $ligacao->connect_error);
}
?>