<?php
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

    $query = $conexao->prepare("SELECT * FROM cliente WHERE email_cliente=:email");
    $query-> bindValue(':email', $_POST['email']);
    $query->execute();
    if ($query->rowCount()==1) {
        retornaErro('E-mail já em uso');
    }


    $query = $conexao->prepare("INSERT INTO cliente (nome_cliente,cpf_cliente,email_cliente,senha_cliente, telefone_cliente ) VALUES (:nome,:cpf,:email,:senha,:telefone) ");
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
