<?php
require "../configurações/segurança.php";
try {
    include "../configurações/conexao.php";

    if (!isset($_POST['id'])) {
        die('Acesse através da listagem');
    }

    $query = $conexao->prepare("UPDATE motorista SET motorista_ativo=2 WHERE id_motorista=:id_motorista");
    $query->bindParam(':id_motorista', $_POST['id']);
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
