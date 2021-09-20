<?php
require "../configurações/segurança.php";
try{

    include "../configurações/conexao.php";

    if(!isset($_GET['id'])){
        die('Acesse através da listagem');
    }
    $query = $conexao->prepare("SELECT * FROM servico WHERE id=:id");
    $query->bindValue(":id", $_GET['id']);
    $resultado = $query->execute();

    if($query->rowCount()==0){
        exit("Objeto não encontrado");
    }
    $linha = $query->fetchObject();

}catch(PDOException $exception){
    echo $exception->getMessage();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Exibir servico</title>
</head>
<body>

<p><strong>ID:</strong> <?php echo $linha->ID; ?></p>
<p><strong>Nome:</strong> <?php echo $linha->nome; ?></p>
<p><strong>valor:</strong> <?php echo $linha->valor; ?></p>
<p><strong>descriçao:</strong> <?php echo $linha->descricao; ?></p>

<p><a href="listagem_servico.php">Voltar a lista de servicos</a></p>

</body>
</html>
