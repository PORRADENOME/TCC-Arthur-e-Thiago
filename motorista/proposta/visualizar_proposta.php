<?php
require "../configurações/segurança.php";
try{

    include "../configurações/conexao.php";

    if(!isset($_GET['id_orcamento'])){
        die('Acesse através da listagem');
    }
    $query = $conexao->prepare("SELECT * FROM orcamento WHERE id_orcamento=:id_orcamento");
    $query->bindValue(":id_orcamento", $_GET['id_orcamento']);
    $resultado = $query->execute();

    if($query->rowCount()==0){
        exit("proposta não encontrado");
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
    <title>Exibir Pedidos</title>
</head>
<body>

<p><strong>ID:</strong> <?php echo $linha->id_orcamento; ?></p>
<p><strong>Nome:</strong> <?php echo $linha->data_e_horario; ?></p>
<p><strong>Senha:</strong> <?php echo $linha->inf_adicionais; ?></p>
<p><strong>E-mail:</strong> <?php echo $linha->endereco_partida; ?></p>
<p><strong>Usuario:</strong> <?php echo $linha->endereco_destino; ?></p>
<p><a href="listagem_proposta.php">Voltar para propostas</a></p>

</body>
</html>
