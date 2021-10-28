<?php
require "../configurações/segurança.php";
try {

    include "../configurações/conexao.php";

    if ($_POST['senha'] !=$_POST['confsenha']){
        retornaErro('senhas diferentes');
    }

    $senhaCriptografada = sha1 ($_POST['senha']);

   /*
    $query = $conexao->prepare("SELECT * FROM funcionario WHERE funcionario=:funcionario");
    $query->bindValue(':funcionario',$_POST['funcionario']);
    $query->execute();
    if ($query->rowCount() == 1) {
        retornaErro('funcionario ja em uso');
    }
   */

    $query = $conexao->prepare("SELECT * FROM funcionario WHERE email_funcionario=:email");
    $query-> bindValue(':email', $_POST['email']);
    $query->execute();
    if ($query->rowCount()==1) {
        retornaErro('E-mail ja em uso');
    }


    $query = $conexao->prepare("INSERT INTO funcionario (nome_funcionario,cpf_funcionario,email_funcionario,senha_funcionario, telefone_funcionario ) VALUES (:nome,:cpf,:email,:senha,:telefone) ");
    $query->bindValue(':nome',$_POST['nome']);
    $query->bindValue(':cpf',$_POST['cpf']);
    $query->bindValue(':email',$_POST['email']);
    $query->bindValue(':senha',$senhaCriptografada);
    $query->bindValue(':telefone',$_POST['telefone']);

    $query->execute();

    if ($query->rowCount() == 1) {
        retornaOK('Inserido com sucesso ');
    } else {
        retornaErro('Erro ao inserir');
    }

} catch (Exception $exception) {
    retornaErro($exception->getMessage());
}
