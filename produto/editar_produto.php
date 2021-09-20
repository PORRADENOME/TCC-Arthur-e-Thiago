<?php
require "../configurações/segurança.php";
try {
    include "../configurações/conexao.php";

    $query = $conexao->prepare("SELECT * FROM produto WHERE nome=:nome AND id<>:id");
    $query-> bindValue(':nome', $_POST['nome']);
    $query-> bindValue(':id'  , $_POST['id']);
    $query->execute();
    if ($query->rowCount()==1){
        retornaErro('produto já foi cadastrado.');
    }


    $query = $conexao->prepare("UPDATE produto SET nome=:nome, valor=:valor, descricao=:descricao WHERE id=:id");
    $query->bindParam(':id',$_POST['id']);
    $query->bindParam(':nome',$_POST['nome']);
    $query->bindParam(':valor',$_POST['valor']);
    $query->bindParam(':descricao',$_POST['descricao']);
    $query->execute();
    if ($query->rowCount() == 1) {
        retornaOK('Alterado com sucesso. ');

    }else {
        retornaOK('Nenhum dado alterado. ');
    }

} catch (PDOException $exception) {
    retornaErro ( $exception->getMessage() );
}
