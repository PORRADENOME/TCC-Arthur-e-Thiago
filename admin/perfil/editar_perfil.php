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



    $query = $conexao->prepare("UPDATE funcionario SET nome_funcionario=:nome_funcionario,
                                                                 email_funcionario=:email_funcionario,
                                                                 cpf_funcionario=:cpf_funcionario,
                                                                 telefone_funcionario=:telefone_funcionario
                                                             WHERE 
                                                                 id_funcionario=:id_funcionario");
    $query->bindParam(':id_funcionario',$_SESSION['id']);
    $query->bindParam(':nome_funcionario',$_POST['nome']);
    $query->bindParam(':email_funcionario',$_POST['email']);
    $query->bindParam(':cpf_funcionario',$_POST['cpf']);
    $query->bindParam(':telefone_funcionario',$_POST['telefone']);
    $query->execute();

    if  ( (isset($_POST['senha']) == true) AND ($_POST['senha'] != '') AND ($_POST['senha_atual'] !='') ) {

        $Criptografia = sha1($_POST['senha_atual']);

        $query = $conexao->prepare("SELECT * FROM funcionario WHERE senha_funcionario=:senha_atual AND id_funcionario=:id_funcionario");
        $query->bindValue(':senha_atual', $Criptografia);
        $query->bindValue(':id_funcionario', $_SESSION['id']);
        $query->execute();
        if ($query->rowCount()==0) {
            retornaErro('Sua senha atual está incorreta');
        }


        if (($_POST['senha'] != $_POST['confsenha']) OR ($_POST['confsenha'] != $_POST['senha'])) {
                retornaErro('Senha diferente');
        }else {

            $senhaCripitografada = sha1($_POST['senha']);

            $query = $conexao->prepare("UPDATE funcionario SET senha_funcionario=:senha_funcionario WHERE id_funcionario=:id_funcionario");
            $query->bindParam(':id_funcionario', $_SESSION['id']);
            $query->bindParam(':senha_funcionario', $senhaCripitografada);
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
