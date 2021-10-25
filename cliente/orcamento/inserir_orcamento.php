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



    $query = $conexao->prepare("INSERT INTO orcamento (data_e_horario,
                                                                 inf_adicionais,
                                                                 endereco_partida,
                                                                 endereco_destino) 
                                                                VALUES 
                                                                 (:data_e_horario,
                                                                 :inf_adicionais,
                                                                 :endereco_partida,
                                                                 :endereco_destino) ");
    $query->bindValue(':data_e_horario', $_POST['data_e_horario']);
    $query->bindValue(':inf_adicionais', $_POST['inf_adicionais']);
    $query->bindValue(':endereco_partida', $_POST['endereco_partida']);
    $query->bindValue(':endereco_destino', $_POST['endereco_destino']);

    $query->execute();

    if ($query->rowCount() == 1) {
        retornaOK('Inserido com sucesso ');
    } else {
        retornaErro('Erro ao inserir');
    }

} catch (Exception $exception) {
    retornaErro($exception->getMessage());
}

