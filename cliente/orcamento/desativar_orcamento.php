<?php
require "../configurações/segurança.php";
try {
    include "../configurações/conexao.php";

    if (!isset($_POST['id'])) {
        die('Acesse através da listagem');
    }

    $query = $conexao->prepare("UPDATE orcamento SET orcamento_ativo=2 WHERE id_orcamento=:id_orcamento");
    $query->bindParam(':id_orcamento', $_POST['id']);
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
