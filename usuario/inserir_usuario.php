<?php
require "../configurações/segurança.php";
try {

    include "../configurações/conexao.php";

    if ($_POST['senha'] !=$_POST['confsenha']){
        retornaErro('senhas diferentes');
    }

    $senhaCriptografada = sha1 ($_POST['senha']);

    $query = $conexao->prepare("SELECT * FROM usuario WHERE usuario=:usuario");
    $query->bindValue(':usuario',$_POST['usuario']);
    $query->execute();
    if ($query->rowCount() == 1) {
        retornaErro('usuario ja em uso');
    }

    $query = $conexao->prepare("SELECT * FROM usuario WHERE email=:email");
    $query-> bindValue(':email', $_POST['email']);
    $query->execute();
    if ($query->rowCount()==1) {
        retornaErro('E-mail ja em uso');
    }


    $query = $conexao->prepare("INSERT INTO usuario (nome,senha,email,usuario) VALUES (:nome,:senha,:email,:usuario) ");
    $query->bindValue(':nome',$_POST['nome']);
    $query->bindValue(':senha',$senhaCriptografada);
    $query->bindValue(':email',$_POST['email']);
    $query->bindValue(':usuario',$_POST['usuario']);

    $query->execute();

    if ($query->rowCount() == 1) {
        retornaOK('Inserido com sucesso ');
    } else {
        retornaErro('Erro ao inserir');
    }

} catch (Exception $exception) {
    retornaErro($exception->getMessage());
}
