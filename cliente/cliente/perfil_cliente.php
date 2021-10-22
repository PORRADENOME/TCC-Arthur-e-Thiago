<?php
require "../configurações/segurança.php";
try {
    require "../configurações/conexao.php";
    // var_dump($_SESSION);

    $query = $conexao->PREPARE("SELECT * FROM cliente WHERE id_cliente=:id");
    $query->bindValue(":id", $_SESSION['id']);

    $resultado = $query->execute();

    if($query->rowCount()==0){
        exit("Objeto não encontrado");
    }

    $linhacliente = $query->fetchObject();

    // var_dump($linhacliente);



}catch(PDOException $exception){
    echo $exception->getMessage();
}

include ("../configurações/bootstrap.php");
include ("../configurações/menu.php");
?>

<div class="container">
    <div class="row">
        <div class="col-12">

            <h1>Olá <?php echo $linhacliente->nome_cliente?> !</h1>

            <br>

            <table class="table table-borderles table-striped">
                <thead>
                <tr>
                    <th scope="col">Nome :</th>
                    <th scope="col"><?php echo $linhacliente->nome_cliente ?></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">E-mail :</th>
                    <td><?php echo $linhacliente->email_cliente ?></td>
                </tr>
                <tr>
                    <th scope="row">Telefone / Celular :</th>
                    <td><?php echo $linhacliente->telefone_cliente ?></td>
                </tr>
                <tr>
                    <th scope="row">CPF :</th>
                    <td><?php echo $linhacliente->cpf_cliente ?></td>

                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

