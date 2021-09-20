<?php
require "../configurações/segurança.php";
try {
    include "../configurações/conexao.php";

    if (validaCPF($_POST['cpf'])==false) {
        retornaErro('Erro na validação do cpf');
    }

    $query = $conexao->prepare("SELECT * FROM cliente WHERE cpf=:cpf AND id<>:id");
    $query-> bindValue(':cpf', $_POST['cpf']);
    $query-> bindValue(':id'  , $_POST['id']);
    $query->execute();
    if ($query->rowCount()==1){
        retornaErro('cliente já foi cadastrado devido ao cpf repetido');
    }

    $query = $conexao->prepare("SELECT * FROM cliente WHERE email=:email AND id<>:id");
    $query-> bindValue(':email', $_POST['email']);
    $query-> bindValue(':id'  , $_POST['id']);
    $query->execute();
    if ($query->rowCount()==1){
        retornaErro('cliente já foi cadastrado devido ao E-mail repetido');
    }


    $query = $conexao->prepare("UPDATE cliente SET nome=:nome, email=:email, telefone=:telefone, cpf=:cpf, datanascimento=:datanascimento WHERE id=:id");
    $query->bindParam(':id',$_POST['id']);
    $query->bindParam(':nome',$_POST['nome']);
    $query->bindParam(':email',$_POST['email']);
    $query->bindParam(':telefone',$_POST['telefone']);
    $query->bindParam(':cpf',$_POST['cpf']);
    $query->bindParam(':datanascimento',$_POST['datanascimento']);
    $query->execute();
    if ($query->rowCount() == 1) {
        retornaOK('Alterado com sucesso. ');

    }else {
        retornaOK('Nenhum dado alterado. ');
    }

} catch (PDOException $exception) {
    retornaErro ( $exception->getMessage() );
}
