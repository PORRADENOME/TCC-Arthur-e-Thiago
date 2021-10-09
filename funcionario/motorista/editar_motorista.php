<?php
require "../configurações/segurança.php";
try {
    include "../configurações/conexao.php";

    $query = $conexao->prepare("SELECT * FROM motorista WHERE cpf_motorista=:cpf_motorista AND id_motorista<>:id_motorista");
    $query-> bindValue(':cpf_motorista'  , $_POST['cpf_motorista']);
    $query-> bindValue(':id_motorista'  , $_POST['id_motorista']);
    $query->execute();
    if ($query->rowCount()==1){
        retornaErro('motorista já foi cadastrado.');
    }

    $query = $conexao->prepare("SELECT * FROM motorista WHERE email_motorista=:email_motorista AND id_motorista<>:id_motorista");
    $query-> bindValue(':email_motorista', $_POST['email_motorista']);
    $query-> bindValue(':id_motorista'  , $_POST['id_motorista']);
    $query->execute();
    if ($query->rowCount()==1) {
        retornaErro('motorista já foi cadastrado devido ao E-mail repetido');
    }

    $query = $conexao->prepare("UPDATE motorista SET nome_motorista=:nome_motorista, email_motorista=:email_motorista, cpf_motorista=:cpf_motorista, telefone_motorista=:telefone_motorista, carteira_de_motorista=:carteira_de_motorista WHERE id_motorista=:id_motorista");
    $query->bindParam(':id_motorista',$_POST['id_motorista']);
    $query->bindParam(':nome_motorista',$_POST['nome_motorista']);
    $query->bindParam(':email_motorista',$_POST['email_motorista']);
    $query->bindParam(':cpf_motorista',$_POST['cpf_motorista']);
    $query->bindParam(':telefone_motorista',$_POST['telefone_motorista']);
    $query->bindParam(':carteira_de_motorista',$_POST['carteira_de_motorista']);
    $query->execute();

    if ($_POST['senha_motorista']!='') {
        if ($_POST['senha_motorista'] != $_POST['confsenha']) {
            retornaErro('Senha diferente');
        }

        $senhaCripitografada = sha1($_POST['senha_motorista']);

        $query = $conexao->prepare("UPDATE motorista SET senha_motorista=:senha_motorista WHERE id_motorista=:id_motorista");
        $query->bindParam(':id_motorista', $_POST['id_motorista']);
        $query->bindParam(':senha_motorista', $senhaCripitografada);
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
