<?php

require "../configurações/segurança.php";
try {
    include "../configurações/conexao.php";

    $query = $conexao->prepare("SELECT * FROM cidade WHERE nome_cidade=:nome_cidade AND id_cidade<>:id_cidade");
    $query-> bindValue(':nome_cidade', $_POST['nome_cidade']);
    $query-> bindValue(':id_cidade'  , $_POST['id_cidade']);
    $query->execute();
    if ($query->rowCount()==1) {
        retornaErro('Cidade já foi cadastrada');
    }

    $query = $conexao->prepare("UPDATE cidade SET nome_cidade=:nome_cidade, estado_cidade=:estado_cidade WHERE id_cidade=:id_cidade");
    $query->bindParam(':id_cidade',$_POST['id_cidade']);
    $query->bindParam(':nome_cidade',$_POST['nome_cidade']);
    $query->bindParam(':estado_cidade',$_POST['estado_cidade']);
    $query->execute();

    if ($query->rowCount() == 1) {
        retornaOK('Alterado com sucesso. ');

    } else {
        retornaOK('Nenhum dado alterado. ');
    }

} catch (PDOException $exception) {
    retornaErro ( $exception->getMessage() );
}

