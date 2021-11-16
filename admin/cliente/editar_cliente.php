<?php
require "../configurações/segurança.php";
try {
    include "../configurações/conexao.php";

    $cpf = ($_POST['cpf_cliente']);

    $verificacaoCPF = validaCPF($cpf);

    if ($verificacaoCPF == false) {

        retornaErro('CPF inválido');
    }

    $telefone = ($_POST['telefone_cliente']);

    $verificacaoTelefone = validaTelefone($telefone);

    if ($verificacaoTelefone == false){

        retornaErro('Telefone / Celular inválido');
    }

    $email = ($_POST['email_cliente']);

    $verificacaoEmail = validaEmail($email);

    if ($verificacaoEmail == false){

        retornaErro('Email inválido');
    }

    $query = $conexao->prepare("SELECT * FROM cliente WHERE cpf_cliente=:cpf_cliente AND id_cliente<>:id_cliente");
    $query-> bindValue(':cpf_cliente'  , $_POST['cpf_cliente']);
    $query-> bindValue(':id_cliente'  , $_POST['id_cliente']);
    $query->execute();
    if ($query->rowCount()==1){
        retornaErro('Cliente já foi cadastrado.');
    }

    $query = $conexao->prepare("SELECT * FROM cliente WHERE email_cliente=:email_cliente AND id_cliente<>:id_cliente");
    $query-> bindValue(':email_cliente', $_POST['email_cliente']);
    $query-> bindValue(':id_cliente'  , $_POST['id_cliente']);
    $query->execute();
    if ($query->rowCount()==1) {
        retornaErro('Cliente já foi cadastrado devido ao E-mail repetido');
    }

    $query = $conexao->prepare("UPDATE cliente SET nome_cliente=:nome_cliente, 
                                                             email_cliente=:email_cliente,
                                                             cpf_cliente=:cpf_cliente,
                                                             telefone_cliente=:telefone_cliente
                                                         WHERE id_cliente=:id_cliente");
    $query->bindParam(':id_cliente',$_POST['id_cliente']);
    $query->bindParam(':nome_cliente',$_POST['nome_cliente']);
    $query->bindParam(':email_cliente',$_POST['email_cliente']);
    $query->bindParam(':cpf_cliente',$_POST['cpf_cliente']);
    $query->bindParam(':telefone_cliente',$_POST['telefone_cliente']);
    $query->execute();

    if ($_POST['senha_cliente']!='') {
        if ($_POST['senha_cliente'] != $_POST['confsenha']) {
            retornaErro('Senha diferente');
        }

        $senhaCripitografada = sha1($_POST['senha_cliente']);

        $query = $conexao->prepare("UPDATE cliente SET senha_cliente=:senha_cliente WHERE id_cliente=:id_cliente");
        $query->bindParam(':id_cliente', $_POST['id_cliente']);
        $query->bindParam(':senha_cliente', $senhaCripitografada);
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
