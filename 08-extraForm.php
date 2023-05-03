<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Utilização de forms</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.css" rel="stylesheet" />

</head>

<body>
    <div class="container">
        <div class="row mt-2">
            <div class="col-md-5">
                <h1>Inserção de Estados</h1>
                <form id="insertForm">
                    <input type="text" name="nomeEstado" id="nomeEstado" class="form-control mb-3">
                    <button type="submit" class="btn btn-secondary" id="submitButton">Submit</button>

                </form>
            </div>
            <div class="col-md-7">
                <h2>Select estados</h2>

                <div id="result"></div>
                <button class="btn btn-primary mb-3" id="fetchStates">Fetch</button>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        $(document).ready(function() {
            selectStates();
        });

        $("#fetchStates").click(function(e) {
            e.preventDefault();

            selectStates();
        });

        $("#insertForm").submit(function(e) {
            e.preventDefault();

            $.post({
                type: "POST",
                url: "08-ajaxInsertEstado.php",
                data: {
                    nomeEstado: $("#nomeEstado").val()
                }
            }).done(function(data) {
                data = JSON.parse(data);
                if (data.success) {
                    toastr.success(data.message);
                    selectStates();
                } else {
                    toastr.error(data.erros.nome);
                }
            });

            selectStates()
        })

        function selectStates() {
            $.get({
                type: "GET",
                url: "./08-ajaxGetEstados.php",
                data: {
                    displayMode: "table"
                }
            }).done(function(data) {
                $("#result").html(data);
            });
        }
    </script>
</body>

</html>