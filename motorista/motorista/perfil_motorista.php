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

    // var_dump($linhacliente);

}catch(PDOException $exception){
    echo $exception->getMessage();
}

include ("../configurações/bootstrap.php");
include ("../configurações/menu.php");
?>

<br>

<div class="container">
    <table class="table table-borderles table-dark table-striped">
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
        </tbody>
    </table>
</div>
