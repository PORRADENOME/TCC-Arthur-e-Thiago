<?php

try {
    include "../configurações/conexao.php";
    require "../configurações/segurança.php";

    if (!isset($_POST['id'])) {
        die('Acesse através da listagem');
    }

    $query = $conexao->prepare("SELECT * FROM atendimento WHERE idatendente=:id");
    $query-> bindValue(':id'  , $_POST['id']);
    $query->execute();
    if ($query->rowCount()>0){
        retornaErro('atendente nao pode ser excluido');
    }

    $query = $conexao->prepare("DELETE FROM atendente WHERE id=:id");
    $query->bindParam(':id', $_POST['id']);
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
