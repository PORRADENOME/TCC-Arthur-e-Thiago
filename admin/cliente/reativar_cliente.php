<?php
require "../configurações/segurança.php";
try {
    include "../configurações/conexao.php";

    if (!isset($_POST['id'])) {
        die('Acesse através da listagem');
    }

    $query = $conexao->prepare("UPDATE cliente SET cliente_ativo=1 WHERE id_cliente=:id_cliente");
    $query->bindParam(':id_cliente', $_POST['id']);
    $query->execute();

    if ($query->rowCount() == 1) {
        retornaOK( 'Reativado com sucesso');
    }
    else {
        retornaErro( 'Erro ao reativar');
    }

} catch (PDOException $exception) {
    echo $exception->getMessage();
}
