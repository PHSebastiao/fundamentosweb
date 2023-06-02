<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Utilização de forms</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <?php
    require "connect.php";

    if (isset($_POST["nomeEstado"])) {
        $nome = $_POST["nomeEstado"];
        $sql = "INSERT INTO estado (nomeEstado) VALUES ('$nome');";

        echo "<script> $(function() {";
        if (mysqli_query($conn, $sql)) {
            echo "toastr.success('Adicionado $nome com sucesso!')";
        } else {
            echo "<script>toastr.warning('Erro ao adicionar no banco.')</script>";
        }
        echo "}); </script>";
    }
    ?>

</head>

<body>
    <div class="container">
        <div class="row mt-2">
            <div class="col-md-5">
                <h1>Inserção de Estados</h1>
                <form action="./09-formMysql.php" method="post">
                    <input type="text" name="nomeEstado" id="nomeEstado" class="form-control mb-3">
                    <button type="submit" class="btn btn-secondary">Submit</button>

                </form>
            </div>
            <div class="col-md-7">
                <h2>Select estados</h2>

                <?php

                $sql = "SELECT idEstado, nomeEstado FROM estado";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                    echo "<table class=\"table\"><tr><th>Id</th><th>Nome</th></tr>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr><td>" . $row["idEstado"] . "</td><td> " . $row["nomeEstado"] . "</td><tr>";
                    }
                    echo "</table>";
                } else {
                    echo "0 results";
                }

                mysqli_close($conn);
                ?>
            </div>
        </div>
    </div>
</body>

</html>