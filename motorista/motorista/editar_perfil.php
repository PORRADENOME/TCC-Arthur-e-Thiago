<?php

require "../configurações/segurança.php";
try {
    include "../configurações/conexao.php";



    $telefone = ($_POST['telefone']);

    $verificacaoTelefone = validaTelefone($telefone);

    if ($verificacaoTelefone == false){

        retornaErro('Telefone / Celular inválido');
    }

    $email = ($_POST['email']);

    $verificacaoEmail = validaEmail($email);

    if ($verificacaoEmail == false){

        retornaErro('Email inválido');
    }

    $query = $conexao->prepare("SELECT * FROM motorista WHERE email_motorista=:email_motorista AND id_motorista<>:id_motorista");
    $query-> bindValue(':email_motorista', $_POST['email']);
    $query-> bindValue(':id_motorista'  , $_SESSION['id']);
    $query->execute();
    if ($query->rowCount()==1) {
        retornaErro('E-mail já cadastrado');
    }

    $Criptografia = sha1($_POST['senha_atual']);

    /*echo("<script>console.log('PHP: " . $Criptografia . "');</script>");*/

    $query = $conexao->prepare("SELECT * FROM motorista WHERE senha_motorista=:senha_atual AND id_motorista<>:id_motorista");
    $query-> bindValue(':senha_atual', $Criptografia);
    $query-> bindValue(':id_motorista'  , $_SESSION['id']);
    $query->execute();
    if ($query->rowCount()==1) {
        retornaErro('Sua senha atual está incorreta');
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

    if (isset($_POST['senha'])==true) {

        if ($_POST['senha'] != '') {
            if ($_POST['senha'] != $_POST['confsenha']) {
                retornaErro('Senha diferente');
            }

            $senhaCripitografada = sha1($_POST['senha']);

            $query = $conexao->prepare("UPDATE motorista SET senha_motorista=:senha_motorista WHERE id_motorista=:id_motorista");
            $query->bindParam(':senha_motorista', $_SESSION['id']);
            $query->bindParam(':senha', $senhaCripitografada);
            $query->execute();
        }
    }else {
        if ($query->rowCount() == 1) {
            retornaOK('Alterado com sucesso. ');

        } else {
            retornaOK('Nenhum dado alterado. ');
        }

        header("../perfil/perfil_cliente.php");

    }

} catch (PDOException $exception) {
    retornaErro ( $exception->getMessage() );
}
