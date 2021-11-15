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

<title>Propostas Aceitas</title>



<div class="container">
    <div class="linha">
        <div class="col-12">
            <h1>Propostas Aceitas</h1>
            <br>
            <table id="grid-data" class="table table-condensed table-hover table striped">
                <thead>
                <tr id="row">
                    <th data-column-id="id_proposta">ID</th>
                    <th data-column-id="preco" data-order="desc" data-sortable="true" >Preço</th>
                    <th data-column-id="informacoes_adicionais" data-sortable="true">Informaçoes Adicionais</th>
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
            url: "bootgrid_proposta_aceita.php",
            formatters: {
                "commands": function (column, row) {
                    return "<button type=\"button\" class=\"btn btn-primary command-visualizar\" data-row-id=\"" + row.id_orcamento + "\"><span class=\"fas fa-eye\"></span></button>";
                }
            }
        }).on("loaded.rs.jquery.bootgrid", function () {
            grid.find(".command-visualizar").on("click", function (e) {
                document.location = 'visualizar_proposta_aceita.php?id=' + $(this).data("row-id");
            });

        });

    });




</script>

