<?php
require "../connect.php";

$response = array("success" => false);


if (isset($_POST["cpf"]) && isset($_POST["nomePessoa"]) && isset($_POST["idadePessoa"])) {
    try {
        $sql = $conn->prepare("SELECT COUNT(*) FROM pessoa WHERE cpf = :cpf");
        $sql->bindParam(":cpf", $_POST["cpf"]);
        $sql->execute();
        $countCPF = $sql->fetchColumn();

        $countCPFOriginal = 1;

        if(isset($_POST["cpfOriginal"]) && !empty($_POST["cpfOriginal"])){
            $sql = $conn->prepare("SELECT COUNT(*) FROM pessoa WHERE cpf = :cpf");
            $sql->bindParam(":cpf", $_POST["cpfOriginal"]);
            $sql->execute();
            $countCPFOriginal = $sql->fetchColumn();
        }

        if ($countCPF == 0 && $countCPFOriginal == 0 || empty($_POST["cpfOriginal"])) {
            $stmt = $conn->prepare("INSERT INTO pessoa (CPF, nomePessoa, idadePessoa) VALUES (:cpf, :nomePessoa, :idadePessoa)");
            $stmt->bindParam(":cpf", $_POST["cpf"]);
            $stmt->bindParam(":nomePessoa", $_POST["nomePessoa"]);
            $stmt->bindParam(":idadePessoa", $_POST["idadePessoa"]);

            if ($stmt->execute()) {
                $response["success"] = true;
                $response["message"] = "Registro inserido com sucesso!";
            }
        } else {
            $stmt = $conn->prepare("UPDATE pessoa SET nomePessoa = :nomePessoa, idadePessoa = :idadePessoa, cpf = :cpf WHERE cpf = :cpfOriginal");
            $stmt->bindParam(":cpf", $_POST["cpf"]);
            $stmt->bindParam(":cpfOriginal", $_POST["cpfOriginal"]);
            $stmt->bindParam(":nomePessoa", $_POST["nomePessoa"]);
            $stmt->bindParam(":idadePessoa", $_POST["idadePessoa"]);

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
