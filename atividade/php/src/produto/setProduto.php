<?php
require "../connect.php";

$response = array("success" => false);

if (isset($_POST["nomeProduto"])) {
    try {
        $sql = $conn->prepare("SELECT COUNT(*) FROM produto WHERE idProduto = :idProduto");
        $sql->bindParam(":idProduto", $_POST["idProduto"]);
        $sql->execute();
        $count = $sql->fetchColumn();

        if ($count == 0) {
            $stmt = $conn->prepare("INSERT INTO produto (nomeProduto, pesoProduto, precoProduto) VALUES (:nomeProduto, :pesoProduto, :precoProduto)");
            $stmt->bindParam(":nomeProduto", $_POST["nomeProduto"]);
            if (isset($_POST["pesoProduto"])) $stmt->bindParam(":pesoProduto", $_POST["pesoProduto"]);
            if (isset($_POST["precoProduto"])) $stmt->bindParam(":precoProduto", $_POST["precoProduto"]);

            if ($stmt->execute()) {
                $response["success"] = true;
                $response["message"] = "Registro inserido com sucesso!";
            }
        } else {
            $stmt = $conn->prepare("UPDATE produto SET nomeProduto = :nomeProduto, pesoProduto = :pesoProduto, precoProduto = :precoProduto WHERE idProduto = :idProduto");
            $stmt->bindParam(":idProduto", $_POST["idProduto"]);
            $stmt->bindParam(":nomeProduto", $_POST["nomeProduto"]);
            if (isset($_POST["pesoProduto"])) $stmt->bindParam(":pesoProduto", $_POST["pesoProduto"]);
            if (isset($_POST["precoProduto"])) $stmt->bindParam(":precoProduto", $_POST["precoProduto"]);

            if ($stmt->execute()) {
                $response["success"] = true;
                $response["message"] = "Registro alterado com sucesso!";
            }
        }
    } catch (PDOException $e) {
        $response["message"] = $e->getMessage();
    }
}

echo json_encode($response);
