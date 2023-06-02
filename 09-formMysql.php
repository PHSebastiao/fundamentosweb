<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Utilização de forms</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <?php
    require "connect.php";

    if (isset($_POST["nomeEstado"])) {
        $nome = $_POST["nomeEstado"];
        $sql = "INSERT INTO estado (nomeEstado) VALUES ('$nome');";

        if (mysqli_query($conn, $sql)) {
            echo "<script>console.log('criado com sucesso')</script>";
        }
    }



    ?>

</head>

<body>
    <div class="container">
        <h1>Inserção de Estados</h1>
        <form action="./09-formMysql.php" method="post">
            <div class="col-md-5">
                <input type="text" name="nomeEstado" id="nomeEstado" class="form-control mb-3">
                <button type="submit" class="btn btn-secondary">Submit</button>
            </div>
        </form>
    </div>
</body>

</html>