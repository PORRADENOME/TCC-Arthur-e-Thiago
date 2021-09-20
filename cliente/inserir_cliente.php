<?php
require "../configurações/segurança.php";
try {

    include "../configurações/conexao.php";

    if (validaCPF($_POST['cpf'])==false) {
        retornaErro('Erro na validação do cpf');
    }

    $query = $conexao->prepare("SELECT * FROM cliente WHERE cpf=:cpf");
    $query-> bindValue(':cpf', $_POST['cpf']);
    $query->execute();
    if ($query->rowCount()==1){
        retornaErro('cliente já foi cadastrado devido ao cpf repetido');
    }

    $query = $conexao->prepare("SELECT * FROM cliente WHERE email=:email ");
    $query-> bindValue(':email', $_POST['email']);
    $query->execute();
    if ($query->rowCount()==1) {
        retornaErro('cliente já foi cadastrado devido ao E-mail repetido');
    }

    $query = $conexao->prepare("INSERT INTO cliente (nome,email,telefone,cpf,datanascimento) VALUES (:nome,:email,:telefone,:cpf,:datanascimento) ");
    $query->bindValue(':nome',$_POST['nome']);
    $query->bindValue(':email',$_POST['email']);
    $query->bindValue(':telefone',$_POST['telefone']);
    $query->bindValue(':cpf',$_POST['cpf']);
    $query->bindValue(':datanascimento',$_POST['datanascimento']);
    $query->execute();

    if ($query->rowCount() == 1) {
        retornaOK('Inserido com sucesso ');
    } else {
        retornaErro('Erro ao inserir');
    }

} catch (Exception $exception) {
    retornaErro($exception->getMessage());
}
