<?php

require "../configurações/segurança.php";
try {
    require "../configurações/conexao.php";
    // var_dump($_SESSION);

    $query = $conexao->PREPARE("SELECT motorista.id_motorista,
                                                 motorista.nome_motorista,
                                                 motorista.email_motorista,
                                                 motorista.telefone_motorista,                                             
                                                 proposta.id_proposta,
                                                 proposta.motorista_proposta                                                 
                                                 FROM proposta INNER JOIN motorista ON proposta.motorista_proposta = motorista.id_motorista WHERE id_proposta=:id");
    $query->bindValue(":id", $_GET['id']);

    $resultado = $query->execute();

    if($query->rowCount()==0){
        exit("Objeto não encontrado");
    }

    $linhamotorista = $query->fetchObject();

}catch(PDOException $exception){
    echo $exception->getMessage();
}

include ("../configurações/bootstrap.php");
include ("../configurações/menu.php");
?>

<title>Perfil do Motorista</title>

<div class="container">
    <div class="row">
        <div class="col-12">

            <h1>Este é o perfil de <?php echo $linhamotorista->nome_motorista ?>!</h1>
            <br>

            <table class="table table-borderles table-striped">
                <thead>
                <tr>
                    <th scope="col">Nome :</th>
                    <th scope="col"><?php echo $linhamotorista->nome_motorista ?></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">E-mail :</th>
                    <td><?php echo $linhamotorista->email_motorista ?></td>
                </tr>
                <tr>
                    <th scope="row">Telefone / Celular :</th>
                    <td><?php echo $linhamotorista->telefone_motorista ?></td>
                </tbody>
            </table>

            <div class="form-group">
            </div>
            <button class="btn btn-primary" role="button" onclick="history.back()" >
                Voltar
            </button>
    </div>

    <script>
        $(document).ready(function () {
            $(' .jsonForm ').ajaxForm({
                dataType: 'json',
                success: function (data) {
                    if (data.status==true){
                        iziToast.success({
                            message: data.mensagem,
                            onClosing: function(){
                                document.location.reload(true);
                            }
                        });
                        $('.jsonForm').trigger('reset');
                    }else{
                        iziToast.error({
                            message: data.mensagem
                        });
                    }
                },
                error: function (data) {
                    iziToast.error({
                        message: 'Servidor retornou erro'
                    });
                }
            });
        });
    </script>