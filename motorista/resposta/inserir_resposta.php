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


    $query = $conexao->prepare("INSERT INTO resposta (texto_resposta,data_resposta ) VALUES (:texto_resposta,:data_resposta) ");
    $query->bindValue(':texto_resposta',$_POST['texto_resposta']);
    $query->bindValue(':data_resposta',$_POST['data_resposta']);

    $query->execute();

    if ($query->rowCount() == 1) {
        retornaOK('Inserido com sucesso ');
    } else {
        retornaErro('Erro ao inserir');
    }

} catch (Exception $exception) {
    retornaErro($exception->getMessage());
}
