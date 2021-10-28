<?php
require "../configurações/segurança.php";
try {
    require "../configurações/conexao.php";
    // var_dump($_SESSION);

    $query = $conexao->PREPARE("SELECT * FROM funcionario WHERE id_funcionario=:id");
    $query->bindValue(":id", $_SESSION['id']);

    $resultado = $query->execute();

    if($query->rowCount()==0){
        exit("Objeto não encontrado");
    }

    $linhafuncionario = $query->fetchObject();

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

            <h1>Olá <?php echo $linhafuncionario->nome_funcionario?> !</h1>

            <br>

            <table class="table table-borderles table-striped">
                <thead>
                <tr>
                    <th scope="col">Nome :</th>
                    <th scope="col"><?php echo $linhafuncionario->nome_funcionario ?></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">E-mail :</th>
                    <td><?php echo $linhafuncionario->email_funcionario ?></td>
                </tr>
                <tr>
                    <th scope="row">Telefone / Celular :</th>
                    <td><?php echo $linhafuncionario->telefone_funcionario ?></td>
                </tr>
                <tr>
                    <th scope="row">CPF :</th>
                    <td><?php echo $linhafuncionario->cpf_funcionario ?></td>

                </tr>
                </tbody>
            </table>

        </div>
    </div>
</div>

