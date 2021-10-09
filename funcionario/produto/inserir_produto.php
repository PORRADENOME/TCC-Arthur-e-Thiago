<?php
require "../configurações/segurança.php";
try {

    include "../configurações/conexao.php";


    $query = $conexao->prepare("SELECT * FROM produto WHERE nome=:nome");
    $query->bindValue(':nome',$_POST['nome']);
    $query->execute();
    if ($query->rowCount() == 1) {
        retornaErro('produto ja existente');
    }


    $query = $conexao->prepare("INSERT INTO produto (nome,descricao,valor) VALUES (:nome,:descricao,:valor) ");
    $query->bindValue(':nome',$_POST['nome']);
    $query->bindValue(':descricao',$_POST['descricao']);
    $query->bindValue(':valor',$_POST['valor']);
    $query->execute();

    if ($query->rowCount() == 1) {
        retornaOK('Inserido com sucesso ');
    } else {
        retornaErro('Erro ao inserir');
    }

} catch (Exception $exception) {
    retornaErro($exception->getMessage());
}
