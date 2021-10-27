<?php


require "../configurações/segurança.php";
try {

    include "../configurações/conexao.php";


    $query = $conexao->prepare("INSERT INTO proposta (preco,
                                                               informacoes_adicionais,
                                                               ) 
                                                            VALUES 
                                                               (:preco,
                                                               :informacoes_adicionais,
                                                               ) ");
    $query->bindValue(':preco', $_POST['preco']);
    $query->bindValue(':informacoes_adicionais', $_POST['informacoes_adicionais']);


    $query->execute();

    if ($query->rowCount() == 1) {
        retornaOK('Inserido com sucesso ');
    } else {
        retornaErro('Erro ao inserir');
    }

} catch (Exception $exception) {
    retornaErro($exception->getMessage());
}

