<?php

try {

    include "../configurações/conexao.php";

    require "../configurações/segurança.php";

    $query = $conexao->prepare("INSERT INTO atendente (nome,funcao,telefone) VALUES (:nome,:funcao,:telefone) ");
    $query->bindValue(':nome',$_POST['nome']);
    $query->bindValue(':funcao',$_POST['funcao']);
    $query->bindValue(':telefone',$_POST['telefone']);
    $query->execute();

    if ($query->rowCount() == 1) {
        retornaOK('Inserido com sucesso ');
    } else {
        retornaErro('Erro ao inserir');
    }

} catch (Exception $exception) {
    retornaErro($exception->getMessage());
}
