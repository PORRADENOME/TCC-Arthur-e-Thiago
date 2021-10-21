<?php


require "../configurações/segurança.php";
try {
    include "../configurações/conexao.php";

    if (!isset($_POST['id'])) {
        die('Acesse através da listagem');
    }

    $query = $conexao->prepare("DELETE FROM indereco WHERE id_indereco=:id_indereco");
    $query->bindParam(':id_indereco', $_POST['id']);
    $query->execute();

    if ($query->rowCount() == 1) {
        retornaOK('Excluido com sucesso');
    } else {
        retornaErro('Erro ao excluir');
    }

} catch (PDOException $exception) {
    echo $exception->getMessage();
}

