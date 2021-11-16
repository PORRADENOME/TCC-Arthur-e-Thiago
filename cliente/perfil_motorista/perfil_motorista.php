<?php
require "../configurações/segurança.php";
try {
    require "../configurações/conexao.php";
    // var_dump($_SESSION);

    $query = $conexao->PREPARE("SELECT * FROM motorista WHERE id_motorista=:id");
    $query->bindValue(":id", $_SESSION['id']);

    $resultado = $query->execute();

    if($query->rowCount()==0){
        exit("Objeto não encontrado");
    }

    $linhamotorista = $query->fetchObject();

    // var_dump($linhamotorista);

}catch(PDOException $exception){
    echo $exception->getMessage();
}

include ("../configurações/bootstrap.php");
include ("../configurações/menu.php");
?>

<div class="container">
    <div class="row">
        <div class="col-12">

            <h1>Olá <?php echo $linhamotorista->nome_motorista?> !</h1>

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
                </tr>
                <tr>
                    <th scope="row">CPF :</th>
                    <td><?php echo $linhamotorista->cpf_motorista ?></td>

                </tr>
                <tr>
                    <th scope="row">CNH :</th>
                    <td><?php echo $linhamotorista->carteira_de_motorista ?></td>

                </tr>
                </tbody>
            </table>
            <div class="form-group">
            </div>

            <div class="accordion" id="accordionExample">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Editar Perfil
                            </button>
                        </h5>
                    </div>



                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">

                            <div class="container">
                                <form action="editar_perfil.php" method="post" class="jsonForm">

                                    <div class="card-body">
                                        <label for="nome">Nome </label>
                                        <input class="form-control" type="text" id="nome" name="nome" value="<?php echo $linhamotorista->nome_motorista; ?>" required>
                                    </div>

                                    <div class="card-body">
                                        <label for="cpf">CPF </label>
                                        <input class="form-control" type="text" id="cpf" name="cpf" value="<?php echo $linhamotorista->cpf_motorista; ?>" readonly required>
                                    </div>

                                    <div class="card-body">
                                        <label for="email">E-mail </label>
                                        <input class="form-control" type="email" id="email" name="email" value="<?php echo $linhamotorista->email_motorista; ?>" required>
                                    </div>

                                    <div class="card-body">
                                        <label for="telefone">Telefone / Celular </label>
                                        <input class="form-control" type="text" id="telefone" name="telefone" value="<?php echo $linhamotorista->telefone_motorista; ?>" required>
                                    </div>

                                    <div class="card-body">
                                        <label for="carteira">Carteira de Motorista</label>
                                        <input class="form-control" type="text" id="carteira" name="carteira" value="<?php echo $linhamotorista->carteira_de_motorista; ?>" readonly required>
                                    </div>

                                    <div class="card-body">
                                        <label for="senha">Senha </label>
                                        <input class="form-control" type="password" id="senha" name="senha">
                                    </div>

                                    <div class="card-body">
                                        <label for="confsenha">Confirme sua senha </label>
                                        <input class="form-control" type="password" id="confsenha" name="confsenha">
                                    </div>


                                    <button type="submit" class="btn btn-primary">Editar</button>
                                    <a href="perfil_motorista.php" class="btn btn-danger">Cancelar</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
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
                            $.header("/perfil/perfil_motorista.php");
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

