<?php

session_start();
if (!isset($_SESSION['usuario'])) header("Location: login.php?erro=session");

include_once "conexao.php";

$equacao = $_POST['equacao'];
$nivel = $_POST['nivel'];
$questoesRespondidas = $_POST['questao'];

$query = $conexao->query("SELECT * FROM questao WHERE dificuldade = '{$nivel}' AND tipo_equacao = '{$equacao}'");

$questoes = $query->fetch_all();
$num_questoes = $query->num_rows;

$acertos = 0;

foreach ($questoesRespondidas as $questao) {
   $resposta_correta = $conexao->query("SELECT resposta FROM questao WHERE idQuestao = '{$questao}'")->fetch_row()[0];
   $resposta_usuario = isset($_POST["resposta-{$questao}"]) ? $_POST["resposta-{$questao}"] : null;

   if ($resposta_correta == $resposta_usuario) $acertos++;
}

$idUsuario = $_SESSION['usuario']['idUsuario'];

$pontuacao = $conexao->query("SELECT pontuacao FROM usuario WHERE idUsuario = {$idUsuario}")->fetch_assoc()['pontuacao'];
$novaPontuacao = $pontuacao + ($acertos * 5);
$conexao->query("UPDATE usuario SET pontuacao = {$novaPontuacao} WHERE idUsuario = {$idUsuario}");

$_SESSION["jogo"] = [
   "acertos" => $acertos,
   "equacao" => $equacao,
   "nivel" => $nivel,
   "num_questoes" => $num_questoes
];

header("Location: ../pontuacao.php");
