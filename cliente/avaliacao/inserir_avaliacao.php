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


    $query = $conexao->prepare("INSERT INTO avaliacao (texto_avaliacao,data_avaliacao ) VALUES (:texto_avaliacao,:data_avaliacao) ");
    $query->bindValue(':texto_avaliacao',$_POST['texto_avaliacao']);
    $query->bindValue(':data_avaliacao',$_POST['data_avaliacao']);



    $query->execute();

    if ($query->rowCount() == 1) {
        retornaOK('Inserido com sucesso ');
    } else {
        retornaErro('Erro ao inserir');
    }

} catch (Exception $exception) {
    retornaErro($exception->getMessage());
}
