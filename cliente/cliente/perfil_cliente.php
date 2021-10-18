<?php
require "../configurações/segurança.php";
try {
    require "../configurações/conexao.php";
    var_dump($_SESSION);

    $query = $conexao->PREPARE("SELECT * FROM cliente WHERE id_cliente=:id");
    $query->bindValue(":id", $_SESSION['id']);

    $resultado = $query->execute();

    if($query->rowCount()==0){
        exit("Objeto não encontrado");
    }

    $linhacliente = $query->fetchObject();

    var_dump($linhacliente);

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
