<?php
require "../configurações/segurança.php";
try{

    include "../configurações/conexao.php";

    if(!isset($_GET['id'])){
        die('Acesse através da listagem');
    }
    $query = $conexao->prepare("SELECT * FROM funcionario WHERE id=:id");
    $query->bindValue(":id", $_GET['id']);
    $resultado = $query->execute();

    if($query->rowCount()==0){
        exit("funcionario não encontrado");
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
    <title>Exibir Funcionário</title>
</head>
<body>

<p><strong>ID:</strong> <?php echo $linha->ID; ?></p>
<p><strong>Nome:</strong> <?php echo $linha->nome; ?></p>
<p><strong>Senha:</strong> <?php echo $linha->senha; ?></p>
<p><strong>E-mail:</strong> <?php echo $linha->email; ?></p>
<p><strong>Usuario:</strong> <?php echo $linha->funcionario; ?></p>
<p><a href="listagem_funcionario.php">Voltar a lista de usuarios</a></p>

</body>
</html>
