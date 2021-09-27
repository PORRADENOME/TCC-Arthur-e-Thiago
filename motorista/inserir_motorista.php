<?php
require "../configurações/segurança.php";
try {

    include "../configurações/conexao.php";

    if ($_POST['senha'] !=$_POST['confsenha']){
        retornaErro('senhas diferentes');
    }

    $senhaCriptografada = sha1 ($_POST['senha']);

    $query = $conexao->prepare("SELECT * FROM motorista WHERE motorista=:motorista");
    $query->bindValue(':motorista',$_POST['motorista']);
    $query->execute();
    if ($query->rowCount() == 1) {
        retornaErro('motorista ja em uso');
    }

    $query = $conexao->prepare("SELECT * FROM motorista WHERE email=:email");
    $query-> bindValue(':email', $_POST['email']);
    $query->execute();
    if ($query->rowCount()==1) {
        retornaErro('E-mail ja em uso');
    }


    $query = $conexao->prepare("INSERT INTO motorista (nome,senha,email,motorista) VALUES (:nome,:senha,:email,:motorista) ");
    $query->bindValue(':nome',$_POST['nome']);
    $query->bindValue(':senha',$senhaCriptografada);
    $query->bindValue(':email',$_POST['email']);
    $query->bindValue(':motorista',$_POST['motorista']);

    $query->execute();

    if ($query->rowCount() == 1) {
        retornaOK('Inserido com sucesso ');
    } else {
        retornaErro('Erro ao inserir');
    }

} catch (Exception $exception) {
    retornaErro($exception->getMessage());
}
