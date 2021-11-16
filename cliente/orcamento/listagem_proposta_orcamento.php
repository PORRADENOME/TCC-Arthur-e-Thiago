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

<title>Listagem de Propostas</title>

<link href="../js/jquery.bootgrid.css" rel="stylesheet"/>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Listagem de Propostas</h1>
            <br>
            <table id="grid-data" class="table table-condensed table-hover table striped">
                <thead>
                <tr>
                    <th data-column-id="preco" data-order="asc" data-sortable="true">Preço</th>
                    <th data-column-id="informacoes_adicionais" data-sortable="true">Informações</th>
                    <th data-column-id="nome_motorista" data-sortable="true">Motorista</th>
                    <th data-column-id="commands" data-formatter="commands" data-sortable="false"></th>

                </tr>
                </thead>
            </table>
            <button class="btn btn-primary" role="button" onclick="history.back()" >
                Voltar
            </button>
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
            post: function ()
            {
                return {
                    id: <?php echo $_GET['id']; ?>
                };
            },
            url: "bootgrid_propostas.php",
            formatters: {
                "commands": function (column, row) {
                    return "<button type=\"button\" class=\"btn btn-primary command-visualizar\" data-row-id=\"" + row.id_proposta + "\"><span class=\"fas fa-eye\"></span></button> " +
                        "<button type=\"button\" class=\"btn btn-info command-perfil\" data-row-id=\"" + row.id_proposta + "\"><span class=\"fas fa-truck\"></span></button> " +
                        "<button type=\"button\" class=\"btn btn-danger command-rejeitar\" data-row-id=\"" + row.id_proposta + "\"><span class=\"fas fa-times\"></span></button> " +
                        "<button type=\"button\" class=\"btn btn-success command-aceitar\" data-row-id=\"" + row.id_proposta + "\"><span class=\"fas fa-check\"></span></button>";
                }
            }
        }).on("loaded.rs.jquery.bootgrid", function () {
            grid.find(".command-visualizar").on("click", function (e) {
                document.location = 'visualizar_proposta_orcamento.php?id=' + $(this).data("row-id");
            }).end().find(".command-perfil").on("click", function (e) {
                document.location = 'visualizar_perfil_motorista.php?id=' + $(this).data("row-id");
            }).end().find(".command-rejeitar").on("click", function (e) {
                iziToastRejeitar($(this).data("row-id"));
            }).end().find(".command-aceitar").on("click", function (e) {
                iziToastAceitar($(this).data("row-id"));

            });

        });

    });

    function rejeitar(id) {
        $.post(
            "rejeitar_proposta.php",
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

    function aceitar(id) {
        $.post(
            "aceitar_proposta.php",
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


