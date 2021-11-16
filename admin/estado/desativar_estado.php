<?php
require "../configurações/segurança.php";
try {
    include "../configurações/conexao.php";

    if (!isset($_POST['id'])) {
        die('Acesse através da listagem');
    }

    $query = $conexao->prepare("UPDATE estado,cidade SET estado_ativo=2,cidade_ativa=2 WHERE id_estado=:id_estado AND estado_cidade=:id_estado ");
    $query->bindParam(':id_estado', $_POST['id']);
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