<?php
require "../configurações/segurança.php";
try {
    include "../configurações/conexao.php";

    if (!isset($_POST['id'])) {
        die('Acesse através da listagem');
    }

    $query = $conexao->prepare("SELECT * FROM atendimento_servico WHERE idservico=:id");
    $query-> bindValue(':id'  , $_POST['id']);
    $query->execute();
    if ($query->rowCount()>0){
        retornaErro('servico nao pode ser excluido');
    }

    $query = $conexao->prepare("DELETE FROM servico WHERE id=:id");
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
