<?php


require "../configurações/segurança.php";
try {

    include "../configurações/conexao.php";


    $query = $conexao->prepare("INSERT INTO proposta (preco,
                                                               informacoes_adicionais,
                                                               motorista_proposta,
                                                               orcamento_proposta
                                                               ) 
                                                            VALUES 
                                                               (:preco,
                                                               :informacoes_adicionais,
                                                               :motorista_proposta,
                                                               :id_orcamento
                                                               ) ");
    $query->bindValue(':preco', $_POST['preco']);
    $query->bindValue(':informacoes_adicionais', $_POST['informacoes_adicionais']);
    $query->bindValue(':motorista_proposta', $_SESSION['id']);
    $query->bindValue(':id_orcamento', $_POST['id_orcamento']);

    $query->execute();

    if ($query->rowCount() == 1) {
        retornaOK('Inserido com sucesso ');
    } else {
        retornaErro('Erro ao inserir');
    }

} catch (Exception $exception) {
    retornaErro($exception->getMessage());
}

