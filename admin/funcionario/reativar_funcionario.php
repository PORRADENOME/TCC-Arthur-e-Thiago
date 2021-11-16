<?php
require "../configurações/segurança.php";
try {
    include "../configurações/conexao.php";

    if (!isset($_POST['id'])) {
        die('Acesse através da listagem');
    }

    $query = $conexao->prepare("UPDATE funcionario SET valor_admin=0 WHERE id_funcionario=:id_funcionario");
    $query->bindParam(':id_funcionario', $_POST['id']);
    $query->execute();

    if ($query->rowCount() == 1) {
        retornaOK( 'Reativaddo com sucesso');
    }
    else {
        retornaErro( 'Erro ao reativar');
    }

} catch (PDOException $exception) {
    echo $exception->getMessage();
}