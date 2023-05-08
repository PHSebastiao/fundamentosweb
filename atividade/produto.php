<!doctype php>
<html lang="pt-br" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Produto CRUD</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0-alpha3/css/bootstrap.min.css" integrity="sha512-iGjGmwIm1UHNaSuwiNFfB3+HpzT/YLJMiYPKzlQEVpT6FWi5rfpbyrBuTPseScOCWBkRtsrRIbrTzJpQ02IaLA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css" integrity="sha512-6S2HWzVFxruDlZxI3sXOZZ4/eJ8AcxkQH1+JjSe/ONCEqR9L4Ysq5JdT5ipqtzU7WHalNwzwBv+iE51gNHJNqQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
</head>

<body class="h-100 overflow-x-hidden">
    <?php require_once "connect.php"; ?>
    <main class="container pt-3">
        <div class="row">
            <div class="col-11">
                <h1>CRUD Produto</h1>
            </div>
            <div class="col-1 d-flex align-content-end justify-content-end">
                <button type="button" class="btn btn-success mt-auto" id="refreshTableBtn">
                    <span class="spinner-border spinner-border-sm" id="refresh-spinner" role="status" aria-hidden="true"></span>
                    <i class="bi bi-arrow-counterclockwise"></i>
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-5 insert-edit">
                <form id="form">
                    <input type="hidden" name="idProduto" id="idProduto">
                    <div class=row>
                        <div class="col-12 mb-3">
                            <label for="nomeProduto" class="form-label">Nome</label>
                            <input type="text" name="nomeProduto" id="nomeProduto" class="form-control" placeholder="Nome" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="pesoProduto" class="form-label">Peso</label>
                            <div class="input-group">
                                <input type="text" name="pesoProduto" id="pesoProduto" class="form-control" required>
                                <span class="input-group-text" id="basic-addon1">g</span>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="precoProduto" class="form-label">Preço</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">R$</span>
                                <input type="text" name="precoProduto" id="precoProduto" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" id="submitButton">Enviar</button>
                    <button type="button" class="btn btn-secondary" id="clearForm">Limpar</button>
                    <a href="./" class="btn btn-link">
                        << Voltar</a>
                </form>
            </div>
            <div class="col-7">
                <table id="produtos-table" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Peso</th>
                            <th>Preço</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <!-- If there are no records, display a message -->
                        <tr>
                            <td class="text-center" colspan="4">No records found.</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0-alpha3/js/bootstrap.bundle.min.js" integrity="sha512-vIAkTd3Ary9rwf0lrb9kIipyIkavKpYGnyopBXs6SiLfNSzAvCNvvQvKwBV5Xlag4O8oZpZ5U5n4bHoErGQxjw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js" integrity="sha512-lbwH47l/tPXJYG9AcFNoJaTMhGvYWhVM9YI43CT+uteTRRaiLCui8snIgyAN8XWgNjNhCqlAUdzZptso6OCoFQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="./assets/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#precoProduto").mask("#.##0,00", {
                reverse: true
            });
            $("#pesoProduto").mask("#.##0,00", {
                reverse: true
            });
            $("#refresh-spinner").hide();
            loadProdutos();
        });

        $("#clearForm").click(function(e) {
            e.preventDefault();

            clearForm();
        });

        $("#refreshTableBtn").click(function(e) {
            e.preventDefault();

            if ($(this).hasClass("disabled")) return;

            loadPessoas();
        });


        $("#form").on("submit", function(e) {
            e.preventDefault();

            let data = {
                idProduto: $("#idProduto").val(),
                nomeProduto: $("#nomeProduto").val(),
                pesoProduto: $("#pesoProduto").val(),
                precoProduto: $("#precoProduto").val(),
            }

            $.ajax({
                url: "./produto/setProduto.php",
                method: "POST",
                data: data,
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.message, "Sucesso");
                        loadProdutos();
                        clearForm();
                    } else {
                        toastr.error(data.message, "Erro ao adicionar registro.")
                    }
                },
                error: function(e) {
                    console.log(e);
                    toastr.error("Erro ao executar requisição");
                }
            })
        });

        function toggleSpinner(show) {
            if (show) {
                $("#refresh-spinner").show();
                $("#refreshTableBtn").addClass("disabled");
            } else {
                $("#refresh-spinner").hide();
                $("#refreshTableBtn").removeClass("disabled");
            }
        }

        async function loadProdutos() {
            toggleSpinner(true);
            await new Promise(r => setTimeout(r, 400));
            $.ajax({
                url: "./produto/getProdutos.php",
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#produtos-table tbody').empty();
                        $('#produtos-table tfoot').show();

                        if (response.data.length !== 0) {
                            $('#produtos-table tfoot').hide();

                            $.each(response.data, function(index, produto) {
                                var row = `<tr data-idProduto='${produto.idProduto}' data-nome='${produto.nomeProduto}' data-pesoProduto='${produto.pesoProduto}' data-precoProduto='${produto.precoProduto}'>` +
                                    '<td>' + produto.idProduto + '</td>' +
                                    '<td>' + produto.nomeProduto + '</td>' +
                                    '<td>' + produto.pesoProduto + '</td>' +
                                    '<td> R$' + produto.precoProduto + '</td>' +
                                    '<td>' +
                                    '<a class="btn btn-sm btn-info editBtn me-2"><i class="bi bi-pencil"></i></a>' +
                                    '<a class="btn btn-sm btn-danger deleteBtn"><i class="bi bi-trash3"></i></a>' +
                                    '</td>' +
                                    '</tr>';
                                $('#produtos-table tbody').append(row);
                            });

                            addClickEvent();
                        }
                    }
                }
            }).done(function() {
                toggleSpinner();
            });
        }

        function clearForm() {
            $("#idProduto").val("");
            $("#precoProduto").val("");
            $("#nomeProduto").val("");
            $("#pesoProduto").val("");
        }

        function addClickEvent() {
            $("#produtos-table .editBtn").on('click', function(e) {
                e.preventDefault();

                let obj = $(this).parents("tr").data();

                $("#idProduto").val(obj.idproduto);
                $("#nomeProduto").val(obj.nome);
                $("#precoProduto").val(obj.precoproduto);
                $("#pesoProduto").val(obj.pesoproduto);

                $.applyDataMask("#precoProduto, #pesoProduto");
            });

            $("#produtos-table .deleteBtn").on('click', function(e) {
                e.preventDefault();

                $.ajax({
                    url: "./produto/deleteProduto.php",
                    method: "POST",
                    data: {
                        idProduto: $(this).parents("tr").data("idproduto")
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data.success) {
                            toastr.success("Registro excluído com sucesso", "Sucesso!");
                            loadProdutos();
                            $("#idProduto").val("")
                        } else {
                            toastr.error(data.message, "Erro ao excluir registro.");
                        }
                    },
                    error: function() {
                        toastr.error("Erro ao executar requisição");
                    }
                })
            });
        }
    </script>
</body>

</html>