<?php
require "../configurações/segurança.php";
try {
    include "../configurações/conexao.php";

    $query = $conexao->prepare("SELECT * FROM usuario WHERE usuario=:usuario AND id<>:id");
    $query-> bindValue(':usuario', $_POST['usuario']);
    $query-> bindValue(':id'  , $_POST['id']);
    $query->execute();
    if ($query->rowCount()==1){
        retornaErro('Usuario já foi cadastrado.');
    }

    $query = $conexao->prepare("SELECT * FROM usuario WHERE email=:email AND id<>:id");
    $query-> bindValue(':email', $_POST['email']);
    $query-> bindValue(':id'  , $_POST['id']);
    $query->execute();
    if ($query->rowCount()==1) {
        retornaErro('usuario já foi cadastrado devido ao E-mail repetido');
    }

    $query = $conexao->prepare("UPDATE usuario SET nome=:nome, email=:email, usuario=:usuario WHERE id=:id");
    $query->bindParam(':id',$_POST['id']);
    $query->bindParam(':nome',$_POST['nome']);
    $query->bindParam(':email',$_POST['email']);
    $query->bindParam(':usuario',$_POST['usuario']);
    $query->execute();

    if ($_POST['senha']!='') {
        if ($_POST['senha'] != $_POST['confsenha']) {
            retornaErro('Senha diferente');
        }

        $senhaCripitografada = sha1($_POST['senha']);

        $query = $conexao->prepare("UPDATE usuario SET senha=:senha WHERE id=:id");
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
