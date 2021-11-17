<?php
require "../configurações/segurança.php";
try {
    include "../configurações/conexao.php";

    if (!isset($_POST['id'])) {
        die('Acesse através da listagem');
    }

    $query = $conexao->prepare("UPDATE proposta SET proposta_aprovada=2 WHERE id_proposta=:id_proposta");
    $query->bindParam(':id_proposta', $_POST['id']);
    $query->execute();

    if ($query->rowCount() == 1) {
        retornaOK( 'Desativado com sucesso');
    }
    else {
        retornaErro( 'Erro ao desativar');
    }

} catch (PDOException $exception) {
    echo $exception->getMessage();
}