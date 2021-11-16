<?php
require "../configurações/segurança.php";
try {
    require "../configurações/conexao.php";

}catch(PDOException $exception){
    echo $exception->getMessage();
}

include ("../configurações/bootstrap.php");
include ("../configurações/menu.php");
?>

<link href="../js/jquery.bootgrid.css" rel="stylesheet" />

<title>Validar Motoristas</title>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Validar Motoristas</h1>
            <br>
            <table id="grid-data" class="table table-condensed table-hover table striped">
                <thead>
                <tr>
                    <th data-column-id="id_motorista">ID</th>
                    <th data-column-id="nome_motorista" data-order="desc" data-sortable="true">Nome</th>
                    <th data-column-id="cpf_motorista" data-sortable="true">CPF</th>
                    <th data-column-id="email_motorista" data-sortable="true">E-mail</th>
                    <th data-column-id="telefone_motorista" data-sortable="true">Telefone</th>
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
    $(document). ready(function () {
        grid=$("#grid-data").bootgrid({
            ajax: true,
            url: "bootgrid_validar_motorista.php",
            formatters: {
                "commands": function(column, row)
                {
                    return "<button type=\"button\" class=\"btn btn-primary command-edit\" data-row-id=\"" + row.id_motorista   + "\"><span class=\"fas fa-edit\"></span></button> ";

                }
            }
        }).on ("loaded.rs.jquery.bootgrid", function () {
            grid.find(".command-edit").on("click", function (e) {
                document.location='form_editar_motorista.php?id=' + $(this).data("row-id");
            });

        });

    });

</script>