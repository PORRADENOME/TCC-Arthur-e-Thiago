<?php

try {
    include "../configurações/conexao.php";
    require "../configurações/segurança.php";

    $query = $conexao->prepare("SELECT * FROM atendente WHERE nome=:nome AND id<>:id");
    $query-> bindValue(':nome', $_POST['nome']);
    $query-> bindValue(':id'  , $_POST['id']);
    $query->execute();
    if ($query->rowCount()==1){
        retornaErro('atendente já foi cadastrado.');
    }


    $query = $conexao->prepare("UPDATE atendente SET nome=:nome, funcao=:funcao, telefone=:telefone WHERE id=:id");
    $query->bindParam(':id',$_POST['id']);
    $query->bindParam(':nome',$_POST['nome']);
    $query->bindParam(':funcao',$_POST['funcao']);
    $query->bindParam(':telefone',$_POST['telefone']);
    $query->execute();
    if ($query->rowCount() == 1) {
        retornaOK('Alterado com sucesso. ');

    }else {
        retornaOK('Nenhum dado alterado. ');
    }

} catch (PDOException $exception) {
    retornaErro ( $exception->getMessage() );
}
