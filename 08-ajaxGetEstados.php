<?php
require "07-connect.php";

$sql = "SELECT idEstado, nomeEstado FROM estado";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0 && isset($_GET["displayMode"]) == "table") {
    echo "<div>";
    // output data of each row
    echo "<table class=\"table\" >\n\t<thead>\n\t\t<tr>\n\t\t\t<th>Id</th>\n\t\t\t<th>Nome</th>\n\t\t</tr>\n\t</thead>\n<tbody>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>\n\t<td>" . $row["idEstado"] . "</td>\n\t<td> " . $row["nomeEstado"] . "</td><tr>";
    }
    echo "</tbody></table>";
    echo "</div>";
} else if (mysqli_num_rows($result) > 0 && isset($_GET["displayMode"]) == "plainText") {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "Id: " . $row["idEstado"] . " - Nome: " . $row["nomeEstado"] . "<br>";
    }
} else {
    echo "0 results";
}

mysqli_close($conn);
