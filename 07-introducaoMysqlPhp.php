<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aula 7 - Uso de Banco</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <div>
        <?php
        require "07-connect.php";

        $sql = "INSERT INTO estado (nomeEstado) VALUES ('São Paulo')";

        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
        }

        mysqli_close($conn);
        ?>

    </div>
</body>

</html>