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

<div class="form-group">
    <label for="nome_motorista">Nome</label>
    <input class="form-control" id="nome_motorista" type="text" name="nome_motorista" readonly value="<?php echo $linhamotorista->nome_motorista;?>">
</div>
<div class="form-group">
    <label for="email_motorista">Email</label>
    <input class="form-control" id="email_motorista" type="text" name="email_motorista" readonly value="<?php echo $linhamotorista->email_motorista;?>">
</div>
<div class="form-group">
    <label for="cpf_motorista">CPF</label>
    <input class="form-control" id="cpf_motorista" type="text" name="cpf_motorista" readonly value="<?php echo $linhamotorista->cpf_motorista;?>">
</div>
<div class="form-group">
    <label for="telefone_motorista">Telefone</label>
    <input class="form-control" id="telefone_motorista" type="text" name="telefone_motorista" readonly value="<?php echo $linhamotorista->telefone_motorista;?>">
</div>

