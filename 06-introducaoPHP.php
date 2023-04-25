<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Introdução ao PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <h1><?= "Introdução a if e else" ?></h1>


    <?php
    date_default_timezone_set('America/Sao_Paulo');
    $h = date("H");
    echo "Hora atual " . date("H:i:s");
    echo "<br>";
    if ($h < 19) {
        echo "Have a good day!";
    } else {
        echo "Have a good evening";
    }
    ?>
    
    <br>

    <?php
    $x = 1;

    while ($x <= 5) {
        echo "The number is: $x <br>";
        $x++;
    }
    ?>

</body>

</html>