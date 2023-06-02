<?php
require_once "../connect.php";

$response = array("success" => false);

try {
    if (isset($_POST['idProduto'])) {
        $cpf = $_POST['idProduto'];

        $stmt = $conn->prepare("DELETE FROM produto WHERE idProduto = :idProduto");
        $stmt->bindParam(":idProduto", $cpf);
        $result = $stmt->execute();

        if ($result) {
            $response["success"] = true;
        }
    }
} catch (PDOException $e) {
    $response["message"] = $e->getMessage();
}

echo json_encode($response);
