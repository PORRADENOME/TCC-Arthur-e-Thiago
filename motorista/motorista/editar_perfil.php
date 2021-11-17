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


        $query = $conexao->prepare("UPDATE motorista SET nome_motorista=:nome_motorista,
                                                                 email_motorista=:email_motorista,
                                                                 cpf_motorista=:cpf_motorista,
                                                                 telefone_motorista=:telefone_motorista
                                                             WHERE
                                                                 id_motorista=:id_motorista");
        $query->bindParam(':id_motorista', $_SESSION['id']);
        $query->bindParam(':nome_motorista', $_POST['nome']);
        $query->bindParam(':email_motorista', $_POST['email']);
        $query->bindParam(':cpf_motorista', $_POST['cpf']);
        $query->bindParam(':telefone_motorista', $_POST['telefone']);
        $query->execute();






        if  ( (isset($_POST['senha']) == true) AND ($_POST['senha'] != '') AND ($_POST['senha_atual'] !='') )  {

            $Criptografia = sha1($_POST['senha_atual']);

            $query = $conexao->prepare("SELECT * FROM motorista WHERE senha_motorista=:senha_atual AND id_motorista=:id_motorista");
            $query-> bindValue(':senha_atual', $Criptografia);
            $query-> bindValue(':id_motorista'  , $_SESSION['id']);
            $query->execute();
            if ($query->rowCount()==0) {
                retornaErro('Sua senha atual está incorreta');
            }



                if (($_POST['senha'] != $_POST['confsenha']) OR ($_POST['confsenha'] != $_POST['senha'])) {
                    retornaErro('Senha diferente');
                }else {

                    $senhaCripitografada = sha1($_POST['senha']);

                    $query = $conexao->prepare("UPDATE motorista SET senha_motorista=:senha_motorista WHERE id_motorista=:id_motorista");
                    $query->bindParam(':id_motorista', $_SESSION['id']);
                    $query->bindParam(':senha_motorista', $senhaCripitografada);
                    $query->execute();
                    if ($query->rowCount() == 1) {
                        retornaOK('Alterado com sucesso. ');
                    } else {
                        retornaOK('Nenhum dado alterado. ');
                    }
                }
        }else if(($_POST['senha_atual'] !='') AND ($_POST['senha'] =='')) {

            retornaErro('Digite sua Nova Senha ou aperte cancelar');
        }else{
            if ($query->rowCount() == 1) {
                retornaOK('Alterado com sucesso. ');

            } else {
                retornaOK('Nenhum dado alterado. ');
            }
        }

} catch (PDOException $exception) {
    retornaErro ( $exception->getMessage() );

}
