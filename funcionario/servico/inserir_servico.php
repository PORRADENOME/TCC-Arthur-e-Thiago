<?php
require "../configurações/segurança.php";
try {

    include "../configurações/conexao.php";

   # $senhaCriptografada = sha1($_POST['senha']);

    $query = $conexao->prepare("SELECT * FROM servico WHERE nome=:nome");
    $query->bindValue(':nome',$_POST['nome']);
    $query->execute();
    if ($query->rowCount() == 1) {
        retornaErro('servico ja existente');
    }


    $query = $conexao->prepare("INSERT INTO servico (nome,descricao,valor) VALUES (:nome,:descricao,:valor) ");
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
