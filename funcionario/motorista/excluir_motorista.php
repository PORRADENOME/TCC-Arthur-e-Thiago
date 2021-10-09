<?php
require "../configurações/segurança.php";
try {
    include "../configurações/conexao.php";

    if (!isset($_POST['id'])) {
        die('Acesse através da listagem');
    }

    $query = $conexao->prepare("DELETE FROM motorista WHERE id_motorista=:id_motorista");
    $query->bindParam(':id_motorista', $_POST['id']);
    $query->execute();

    if ($query->rowCount() == 1) {
        retornaOK( 'Excluido com sucesso');
    }
    else {
        retornaErro( 'Erro ao excluir');
    }

} catch (PDOException $exception) {
    echo $exception->getMessage();
}
