<?php
require "../configurações/segurança.php";
try {
    include "../configurações/conexao.php";

    $query = $conexao->prepare("SELECT * FROM estado WHERE nome_estado=:nome_estado AND id_estado<>:id_estado");
    $query-> bindValue(':nome_estado'  , $_POST['nome_estado']);
    $query-> bindValue(':id_estado'  , $_POST['id_estado']);
    $query->execute();
    if ($query->rowCount()==1){
        retornaErro('Estado já foi cadastrado.');
    }


    $query = $conexao->prepare("UPDATE estado SET nome_estado=:nome_estado WHERE id_estado=:id_estado");
    $query->bindParam(':id_estado',$_POST['id_estado']);
    $query->bindParam(':nome_estado',$_POST['nome_estado']);
    $query->execute();

    if ($query->rowCount() == 1) {
        retornaOK('Alterado com sucesso. ');

    } else {
        retornaOK('Nenhum dado alterado. ');
    }


} catch (PDOException $exception) {
    retornaErro ( $exception->getMessage() );
}

