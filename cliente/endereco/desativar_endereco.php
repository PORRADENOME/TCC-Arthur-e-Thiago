<?php

require "../configurações/segurança.php";
try {
    include "../configurações/conexao.php";

    if (!isset($_POST['id'])) {
        die('Acesse através da listagem');
    }

        $query = $conexao->prepare("Select
        id_orcamento,
        endereco_partida,
        endereco_destino,
        orcamento_ativo
    From
        orcamento
    Where
        (orcamento.endereco_partida=:id_endereco Or
        orcamento.endereco_destino=:id_endereco) And 
        orcamento_ativo!=2
        ");
    $query->bindParam(':id_endereco', $_POST['id']);

    $query->execute();
    $linha = $query->fetchAll();

    if($query->rowCount() == 0) {



        $query = $conexao->prepare("UPDATE endereco SET endereco_ativo=2 
                                              WHERE endereco.id_endereco=:id_endereco
                                                                                                                ");
        $query->bindParam(':id_endereco', $_POST['id']);
        $query->execute();

        if ($query->rowCount() >= 1) {
            retornaOK('Desativado com sucesso');
        } else {
            retornaErro('Erro ao desativar');
        }

    }else{
        retornaErro("Erro ao desativar, existem orçamentos vinculados a este endereço");
    }
} catch (PDOException $exception) {
    echo $exception->getMessage();
}