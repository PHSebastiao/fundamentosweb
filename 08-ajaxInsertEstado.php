<?php
require "07-connect.php";

$data = [];
$erros = [];

if (!empty($_POST["nomeEstado"])) {
    $nome = $_POST["nomeEstado"];
    $sql = "INSERT INTO estado (nomeEstado) VALUES ('$nome');";

    if (mysqli_query($conn, $sql)) {
        $data['success'] = true;
        $data['message'] = "Sucesso ao adicionar $nome!";
    }
} else {
    $erros['nome'] = "Nome é requerido";
}

if (!empty($erros)) {
    $data['success'] = false;
    $data['erros'] = $erros;
}

echo json_encode($data);