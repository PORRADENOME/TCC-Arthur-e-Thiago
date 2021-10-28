<?php

require "../configurações/segurança.php";
try {
    include "../configurações/conexao.php";

    $query = $conexao->prepare("SELECT * FROM motorista WHERE email_motorista=:email_motorista AND id_motorista<>:id_motorista");
    $query-> bindValue(':email_motorista', $_POST['email']);
    $query-> bindValue(':id_motorista'  , $_SESSION['id']);
    $query->execute();
    if ($query->rowCount()==1) {
        retornaErro('E-mail já cadastrado');
    }

    $query = $conexao->prepare("UPDATE motorista SET nome_motorista=:nome_motorista,
                                                             email_motorista=:email_motorista,
                                                             cpf_motorista=:cpf_motorista,
                                                             telefone_motorista=:telefone_motorista,
                                                             carteira_de_motorista=:carteira_de_motorista
                                                         WHERE 
                                                             id_motorista=:id_motorista");
    $query->bindParam(':id_motorista',$_SESSION['id']);
    $query->bindParam(':nome_motorista',$_POST['nome']);
    $query->bindParam(':email_motorista',$_POST['email']);
    $query->bindParam(':cpf_motorista',$_POST['cpf']);
    $query->bindParam(':telefone_motorista',$_POST['telefone']);
    $query->bindParam(':carteira_de_motorista',$_POST['carteira']);
    $query->execute();

    if ($_POST['senha']!='') {
        if ($_POST['senha'] != $_POST['confsenha']) {
            retornaErro('Senha diferente');
        }

        $senhaCripitografada = sha1($_POST['senha']);

        $query = $conexao->prepare("UPDATE motorista SET senha_motorista=:senha_motorista WHERE id_motorista=:id_motorista");
        $query->bindParam(':senha_motorista', $_SESSION['id']);
        $query->bindParam(':senha', $senhaCripitografada);
        $query->execute();
    }

    if ($query->rowCount() == 1) {
        retornaOK('Alterado com sucesso. ');

    } else {
        retornaOK('Nenhum dado alterado. ');
    }

    header("../perfil/perfil_cliente.php");

} catch (PDOException $exception) {
    retornaErro ( $exception->getMessage() );
}