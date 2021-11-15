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

    $cpf = ($_POST['cpf']);

    $verificacaoCPF = validaCPF($cpf);

    if ($verificacaoCPF == false) {

        retornaErro('Erro CPF inválido');
    }

    $query = $conexao->prepare("SELECT * FROM motorista WHERE email_motorista=:email");
    $query-> bindValue(':email', $_POST['email']);
    $query->execute();
    if ($query->rowCount()==1) {
        retornaErro('E-mail já em uso');
    }


    $query = $conexao->prepare("INSERT INTO motorista (nome_motorista,cpf_motorista,email_motorista,senha_motorista, telefone_motorista, carteira_de_motorista ) VALUES (:nome,:cpf,:email,:senha,:telefone,:carteira) ");
    $query->bindValue(':nome',$_POST['nome']);
    $query->bindValue(':cpf',$_POST['cpf']);
    $query->bindValue(':email',$_POST['email']);
    $query->bindValue(':senha',$senhaCriptografada);
    $query->bindValue(':telefone',$_POST['telefone']);
    $query->bindValue(':carteira',$_POST['carteira']);

    $query->execute();

    if ($query->rowCount() == 1) {
        retornaOK('Inserido com sucesso ');
    } else {
        retornaErro('Erro ao inserir');
    }

} catch (Exception $exception) {
    retornaErro($exception->getMessage());
}
