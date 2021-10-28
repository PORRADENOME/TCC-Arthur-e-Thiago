<?php
require "../configurações/segurança.php";
try {

    include "../configurações/conexao.php";

    /*
     $query = $conexao->prepare("SELECT * FROM funcionario WHERE funcionario=:funcionario");
     $query->bindValue(':funcionario',$_POST['funcionario']);
     $query->execute();
     if ($query->rowCount() == 1) {
         retornaErro('funcionario ja em uso');
     }
    */

    $query = $conexao->prepare("SELECT * FROM estado WHERE nome_estado=:nome");
    $query-> bindValue(':nome', $_POST['nome']);
    $query->execute();
    if ($query->rowCount()==1) {
        retornaErro('Estado já cadastrado');
    }


    $query = $conexao->prepare("INSERT INTO estado (nome_estado) VALUES (:nome) ");
    $query->bindValue(':nome',$_POST['nome']);

    $query->execute();

    if ($query->rowCount() == 1) {
        retornaOK('Inserido com sucesso ');
    } else {
        retornaErro('Erro ao inserir');
    }

} catch (Exception $exception) {
    retornaErro($exception->getMessage());
}