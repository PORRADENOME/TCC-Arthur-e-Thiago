<?php
require "../configurações/segurança.php";
try {
    include "../configurações/conexao.php";

    if (!isset($_POST['id'])) {
        die('Acesse através da listagem');
    }

    $query = $conexao->prepare("UPDATE cliente SET cliente_ativo=0 WHERE id_cliente=:id_cliente");
    $query->bindParam(':id_cliente', $_POST['id']);
    $query->execute();

    if ($query->rowCount() == 1) {
        retornaOK( 'Banido com sucesso');
    }
    else {
        retornaErro( 'Erro ao banir');
    }

} catch (PDOException $exception) {
    echo $exception->getMessage();
}
