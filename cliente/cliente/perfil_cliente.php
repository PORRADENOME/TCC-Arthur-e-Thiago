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

<div class="form-group">
    <label for="nome_cliente">Nome</label>
    <input class="form-control" id="nome_cliente" type="text" name="nome_cliente" readonly value="<?php echo $linhacliente->nome_cliente;?>">
</div>
<div class="form-group">
    <label for="email_cliente">Email</label>
    <input class="form-control" id="email_cliente" type="text" name="email_cliente" readonly value="<?php echo $linhacliente->email_cliente;?>">
</div>
<div class="form-group">
    <label for="cpf_cliente">CPF</label>
    <input class="form-control" id="cpf_cliente" type="text" name="cpf_cliente" readonly value="<?php echo $linhacliente->cpf_cliente;?>">
</div>
<div class="form-group">
    <label for="telefone_cliente">Telefone</label>
    <input class="form-control" id="telefone_cliente" type="text" name="telefone_cliente" readonly value="<?php echo $linhacliente->telefone_cliente;?>">
</div>

