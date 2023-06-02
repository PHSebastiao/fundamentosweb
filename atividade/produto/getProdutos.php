<?php
require_once "../connect.php";

$response = array("success" => false);

//prepara a query para selecionar os dados da tabela pessoa
$stmt = $conn->prepare("SELECT * FROM produto");

//executa a query e atualiza a resposta
if ($stmt->execute()) {
    $response["success"] = true;
    $response["data"] = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//retorna a resposta como JSON
echo json_encode($response);
