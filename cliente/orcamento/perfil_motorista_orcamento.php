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

            <h1>Perfil do Motorista</h1>

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

                </tbody>
            </table>

        </div>
    </div>
</div>

