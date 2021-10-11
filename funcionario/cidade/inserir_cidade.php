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

    $query = $conexao->prepare("SELECT * FROM cidade WHERE nome_cidade=:nome_cidade");
    $query-> bindValue(':nome_cidade', $_POST['nome']);
    $query->execute();
    if ($query->rowCount()==1) {
        retornaErro('Cidade já cadastrada');
    }


    $query = $conexao->prepare("INSERT INTO cidade (nome_cidade, estado_cidade) VALUES (:nome,:estado_cidade) ");
    $query->bindValue(':nome',$_POST['nome']);
    $query->bindValue(':estado_cidade',$_POST['estado_cidade']);


    $query->execute();

    if ($query->rowCount() == 1) {
        retornaOK('Inserido com sucesso ');
    } else {
        retornaErro('Erro ao inserir');
    }

} catch (Exception $exception) {
    retornaErro($exception->getMessage());
}