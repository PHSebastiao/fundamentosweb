<?php
require_once "../connect.php";

$response = array("success" => false);

try {
    if (isset($_POST['cpf'])) {
        $cpf = $_POST['cpf'];

        $stmt = $conn->prepare("DELETE FROM pessoa WHERE CPF = :cpf");
        $stmt->bindParam(":cpf", $cpf);
        $result = $stmt->execute();

        if ($result) {
            $response["success"] = true;
        }
    }
} catch (PDOException $e) {
    $response["message"] = $e->getMessage();
}

echo json_encode($response);
