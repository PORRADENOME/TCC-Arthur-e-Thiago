<?php
require "../configurações/segurança.php";
try {
   // include "../seguranca.php";
    require "../configurações/conexao.php";

    $queryProduto = $conexao->prepare("SELECT * FROM produto WHERE id=:id");
    $queryProduto->bindValue(":id", $_POST['idproduto']);
    $queryProduto->execute();

    $linhaProduto = $queryProduto->fetchObject();

    $query = $conexao->prepare("INSERT INTO atendimento_produto (idproduto, idatendimento, valorproduto, quantidade) VALUES (:idproduto, :idatendimento, :valorproduto, :quantidade)" );
    $query->bindValue(':idproduto', $_POST['idproduto']);
    $query->bindValue(':idatendimento', $_POST['idatendimento']);
    $query->bindValue(':quantidade', $_POST['quantidade']);
    $query->bindValue(':valorproduto', $linhaProduto->valor);
    $query->execute();

    if ($query->rowCount()==1){
        retornaOK('Inserido com sucesso');
    }else{
        retornaErro('Erro ao inserir');
    }

} catch (Exception $exception ) {
    retornaErro( $exception->getMessage() );
}
