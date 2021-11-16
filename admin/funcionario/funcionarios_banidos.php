<?php

require "../configurações/segurança.php";
try {
    require "../configurações/conexao.php";

} catch (PDOException $exception) {
    echo $exception->getMessage();
}

include("../configurações/bootstrap.php");
include("../configurações/menu.php");
?>

<link href="../js/jquery.bootgrid.css" rel="stylesheet"/>

<title>Listagem de Funcionários Banidos</title>

<div class="container-lg">
    <div class="row">
        <div class="col-12">
            <h1>Listagem de Funcionários Banidos</h1>
            <br>
            <table id="grid-data" class="table table-condensed table-hover table striped">
                <thead>
                <tr>
                    <th data-column-id="id_funcionario">ID</th>
                    <th data-column-id="nome_funcionario" data-order="desc" data-sortable="true">Nome</th>
                    <th data-column-id="cpf_funcionario" data-sortable="true">CPF</th>
                    <th data-column-id="email_funcionario" data-sortable="true">E-mail</th>
                    <th data-column-id="telefone_funcionario" data-sortable="true">Telefone</th>
                    <th data-column-id="commands" data-formatter="commands" data-sortable="false"></th>

                </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<script src="../js/jquery.bootgrid.js"></script>
<script src="../js/jquery.bootgrid.fa.js"></script>


<script>
    var grid;
    $(document).ready(function () {
        grid = $("#grid-data").bootgrid({
            ajax: true,
            url: "bootgrid_banidos.php",
            formatters: {
                "commands": function (column, row) {
                    return "<button type=\"button\" class=\"btn btn-success command-delete\" data-row-id=\"" + row.id_funcionario + "\"><span class=\"fas fa-undo-alt\"></span></button>";
                }
            }
        }).on("loaded.rs.jquery.bootgrid", function () {
            grid.find(".command-delete").on("click", function (e) {
                iziToastReativar($(this).data("row-id"));

            });

        });

    });

    function reativar(id) {
        $.post(
            "reativar_funcionario.php",
            {id: id},
            function (data) {
                if (data.status == 0) {
                    iziToast.error({
                        message: data.mensagem
                    });
                } else {
                    iziToast.success({
                        message: data.mensagem
                    });
                    grid.bootgrid("reload");
                }
            },
            "json"
        );
    }

</script>
