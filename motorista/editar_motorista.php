<?php
require "../configurações/segurança.php";
try {
    include "../configurações/conexao.php";

    $query = $conexao->prepare("SELECT * FROM motorista WHERE motorista=:motorista AND id<>:id");
    $query-> bindValue(':motorista', $_POST['motorista']);
    $query-> bindValue(':id'  , $_POST['id']);
    $query->execute();
    if ($query->rowCount()==1){
        retornaErro('Usuario já foi cadastrado.');
    }

    $query = $conexao->prepare("SELECT * FROM motorista WHERE email=:email AND id<>:id");
    $query-> bindValue(':email', $_POST['email']);
    $query-> bindValue(':id'  , $_POST['id']);
    $query->execute();
    if ($query->rowCount()==1) {
        retornaErro('motorista já foi cadastrado devido ao E-mail repetido');
    }

    $query = $conexao->prepare("UPDATE motorista SET nome=:nome, email=:email, motorista=:motorista WHERE id=:id");
    $query->bindParam(':id',$_POST['id']);
    $query->bindParam(':nome',$_POST['nome']);
    $query->bindParam(':email',$_POST['email']);
    $query->bindParam(':motorista',$_POST['motorista']);
    $query->execute();

    if ($_POST['senha']!='') {
        if ($_POST['senha'] != $_POST['confsenha']) {
            retornaErro('Senha diferente');
        }

        $senhaCripitografada = sha1($_POST['senha']);

        $query = $conexao->prepare("UPDATE motorista SET senha=:senha WHERE id=:id");
        $query->bindParam(':id', $_POST['id']);
        $query->bindParam(':senha', $senhaCripitografada);
        $query->execute();
    }

        if ($query->rowCount() == 1) {
            retornaOK('Alterado com sucesso. ');

        } else {
            retornaOK('Nenhum dado alterado. ');
        }


} catch (PDOException $exception) {
    retornaErro ( $exception->getMessage() );
}
