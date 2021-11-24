<?php
require "../configurações/segurança.php";
try {
    include "../configurações/conexao.php";

    if (!isset($_POST['id'])) {
        die('Acesse através da listagem');
    }


    $query = $conexao->prepare("UPDATE cidade SET cidade_ativa=2 WHERE id_cidade=:id_cidade");
    $query->bindParam(':id_cidade', $_POST['id']);
    $query->execute();

    if ($query->rowCount() >= 1) {
        retornaOK( 'Desativado com sucesso');
    }
    else {
        retornaErro( 'Erro ao desativar');
    }

} catch (PDOException $exception) {
    echo $exception->getMessage();
}