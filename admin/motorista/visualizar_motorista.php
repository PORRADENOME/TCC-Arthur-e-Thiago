<?php

require "../configurações/segurança.php";
try {
    require "../configurações/conexao.php";
    // var_dump($_SESSION);

    $query = $conexao->PREPARE("SELECT id_motorista,
                                                 nome_motorista,
                                                 cpf_motorista,
                                                 email_motorista,
                                                 telefone_motorista,
                                                 carteira_de_motorista                                             
                                                 
                                                 FROM motorista WHERE id_motorista=:id");
    $query->bindValue(":id", $_GET['id']);

    $resultado = $query->execute();

    if($query->rowCount()==0){
        exit("Objeto não encontrado");
    }

    $linhamotorista = $query->fetchObject();


    $link_imagem = '/imagem.php?imagem=' . $linhamotorista->carteira_de_motorista;


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

            <h1>Dados de <?php echo $linhamotorista->nome_motorista ?>!</h1>
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
                    <th scope="row">CPF :</th>
                    <td><?php echo $linhamotorista->cpf_motorista ?></td>
                </tr>
                <tr>
                    <th scope="row">E-mail :</th>
                    <td><?php echo $linhamotorista->email_motorista ?></td>
                </tr>
                <tr>
                    <th scope="row">Telefone / Celular :</th>
                    <td><?php echo $linhamotorista->telefone_motorista ?></td>
                </tr>
                <tr>
                    <th scope="row">CNH : </th>
                    <td><img src="<?php echo $link_imagem?>" id="CNH" ></td>
                </tr>
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