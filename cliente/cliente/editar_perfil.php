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

    $query = $conexao->prepare("SELECT * FROM cliente WHERE email_cliente=:email_cliente AND id_cliente<>:id_cliente");
    $query-> bindValue(':email_cliente', $_POST['email']);
    $query-> bindValue(':id_cliente'  , $_SESSION['id']);
    $query->execute();
    if ($query->rowCount()==1) {
        retornaErro('E-mail já cadastrado');
    }


    $query = $conexao->prepare("UPDATE cliente SET nome_cliente=:nome_cliente,
                                                             email_cliente=:email_cliente,
                                                             cpf_cliente=:cpf_cliente, 
                                                             telefone_cliente=:telefone_cliente 
                                                         WHERE 
                                                             id_cliente=:id_cliente");
    $query->bindParam(':id_cliente',$_SESSION['id']);
    $query->bindParam(':nome_cliente',$_POST['nome']);
    $query->bindParam(':email_cliente',$_POST['email']);
    $query->bindParam(':cpf_cliente',$_POST['cpf']);
    $query->bindParam(':telefone_cliente',$_POST['telefone']);
    $query->execute();




        if  ( (isset($_POST['senha']) == true) AND ($_POST['senha'] != '') AND ($_POST['senha_atual'] !='') ) {

            $Criptografia = sha1($_POST['senha_atual']);

            $query = $conexao->prepare("SELECT * FROM cliente WHERE senha_cliente=:senha_atual AND id_cliente=:id_cliente");
            $query->bindValue(':senha_atual', $Criptografia);
            $query->bindValue(':id_cliente', $_SESSION['id']);
            $query->execute();
            if ($query->rowCount() == 0) {
                retornaErro('Sua senha atual está incorreta');
            }



            if (($_POST['senha'] != $_POST['confsenha']) OR ($_POST['confsenha'] != $_POST['senha'])) {
                retornaErro('Senha diferente');
            }else {

                $senhaCripitografada = sha1($_POST['senha']);

                $query = $conexao->prepare("UPDATE cliente SET senha_cliente=:senha_cliente WHERE id_cliente=:id_cliente");
                $query->bindParam(':id_cliente', $_SESSION['id']);
                $query->bindParam(':senha_cliente', $senhaCripitografada);
                $query->execute();

                    if ($query->rowCount() == 1) {
                    retornaOK('Alterado com sucesso. ');
                    } else {
                    retornaOK('Nenhum dado alterado. ');
                }
            }
        }else if(($_POST['senha_atual'] !='') AND ($_POST['senha'] =='')) {

            retornaErro('Digite sua Nova Senha ou aperte cancelar');
        }else {
            if ($query->rowCount() == 1) {
                retornaOK('Alterado com sucesso. ');

            } else {
                retornaOK('Nenhum dado alterado. ');

            }
        }

} catch (PDOException $exception) {
    retornaErro ( $exception->getMessage() );
}
