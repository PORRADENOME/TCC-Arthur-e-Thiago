<?php

require "../configurações/segurança.php";
try {
    include "../configurações/conexao.php";

    if (!isset($_POST['id'])) {
        die('Acesse através da listagem');
    }

//    $query = $conexao->prepare("SELECT orcamento.id_orcamento,orcamento.endereco_destino,orcamento.endereco_partida,endereco.id_endereco
//                                                                                                           FROM orcamento
//                                                                                                           INNER JOIN
//                                                                                                                endereco
//                                                                                                           ON
//                                                                                                                orcamento.endereco_partida=endereco.id_endereco
//                                                                                                           WHERE
//                                                                                                              endereco.id_endereco=2");


//    if ($query->rowCount() >= 1) {
//        $id_orcamento = $query->fetchObject();


        $query = $conexao->prepare("UPDATE endereco SET endereco_ativo=2 WHERE id_endereco=:id_endereco 
                                                                                                                ");
        $query->bindParam(':id_endereco', $_POST['id']);
//        $query->bindParam(':id_orcamento', $_POST[$id_orcamento]);
        $query->execute();

        if ($query->rowCount() == 1) {
            retornaOK('Desativado com sucesso');
        } else {
            retornaErro('Erro ao desativar');
        }
//    }else{
//    $query = $conexao->prepare("SELECT orcamento.id_orcamento,orcamento.endereco_destino,orcamento.endereco_partida,endereco.id_endereco
//                                                                                                           FROM orcamento
//                                                                                                           INNER JOIN
//                                                                                                                endereco
//                                                                                                           ON
//                                                                                                                orcamento.endereco_destino=endereco.id_endereco
//                                                                                                           WHERE
//

        //        $id_orcamento = $query->fetchObject();


//        $query = $conexao->prepare("UPDATE endereco,orcamento,proposta SET endereco_ativo=2,orcamento_ativo=2,proposta_aprovada=2 WHERE id_endereco=:id_endereco
////                                                                                                                AND
////                                                                                                                    endereco_destino=:id_endereco
////                                                                                                                AND
////                                                                                                                    orcamento_proposta=:id_orcamento ");
////        $query->bindParam(':id_endereco', $_POST['id']);
////        $query->bindParam(':id_orcamento', $_POST[$id_orcamento]);
////        $query->execute();
////
////        if ($query->rowCount() >= 1) {
////            retornaOK('Desativado com sucesso');
////        } else {
////            retornaErro($id_orcamento);
////        }
////    }

} catch (PDOException $exception) {
    echo $exception->getMessage();
}