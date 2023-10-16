<?php

$host = "127.0.0.1";
$user = "root";
$pass = "";
$db = "equacao";

try {
    $conexao = new mysqli($host, $user, $pass, $db);
} catch (Exception  $e) {
    echo "Erro ao conectar-se: {$e->getMessage()}";
}
