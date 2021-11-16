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

    $query = $conexao->prepare("SELECT * FROM funcionario WHERE email_funcionario=:email_funcionario AND id_funcionario<>:id_funcionario");
    $query-> bindValue(':email_funcionario', $_POST['email']);
    $query-> bindValue(':id_funcionario'  , $_SESSION['id']);
    $query->execute();
    if ($query->rowCount()==1) {
        retornaErro('E-mail já cadastrado');
    }

    $Criptografia = sha1($_POST['senha_atual']);

    $query = $conexao->prepare("SELECT * FROM funcionario WHERE senha_funcionario=:senha_atual AND id_funcionario<>:id_funcionario");
    $query-> bindValue(':senha_atual', $Criptografia);
    $query-> bindValue(':id_funcionario'  , $_SESSION['id']);
    $query->execute();
    if ($query->rowCount()==1) {
        retornaErro('Sua senha atual está incorreta');
    }

    $query = $conexao->prepare("UPDATE funcionario SET nome_funcionario=:nome_funcionario, email_funcionario=:email_funcionario, cpf_funcionario=:cpf_funcionario, telefone_funcionario=:telefone_funcionario WHERE id_funcionario=:id_funcionario");
    $query->bindParam(':id_funcionario',$_SESSION['id']);
    $query->bindParam(':nome_funcionario',$_POST['nome']);
    $query->bindParam(':email_funcionario',$_POST['email']);
    $query->bindParam(':cpf_funcionario',$_POST['cpf']);
    $query->bindParam(':telefone_funcionario',$_POST['telefone']);
    $query->execute();

    if ($_POST['senha']!='') {
        if ($_POST['senha'] != $_POST['confsenha']) {
            retornaErro('Senha diferente');
        }

        $senhaCripitografada = sha1($_POST['senha']);

        $query = $conexao->prepare("UPDATE funcionario SET senha_funcionario=:senha_funcionario WHERE id_funcionario=:id_funcionario");
        $query->bindParam(':id_funcionario', $_SESSION['id']);
        $query->bindParam(':senha_funcionario', $senhaCripitografada);
        $query->execute();
    }

    if ($query->rowCount() == 1) {
        retornaOK('Alterado com sucesso. ');
        header("../perfil/perfil_funcionario.php");
    } else {
        retornaOK('Nenhum dado alterado. ');

        header("../perfil/perfil_funcionario.php");
    }



} catch (PDOException $exception) {
    retornaErro ( $exception->getMessage() );
}
