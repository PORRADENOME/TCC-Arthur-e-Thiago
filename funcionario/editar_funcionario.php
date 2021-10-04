<?php
require "../configurações/segurança.php";
try {
    include "../configurações/conexao.php";

    $query = $conexao->prepare("SELECT * FROM funcionario WHERE cpf_funcionario=:cpf_funcionario AND id_funcionario<>:id_funcionario");
    $query-> bindValue(':cpf_funcionario'  , $_POST['cpf_funcionario']);
    $query-> bindValue(':id_funcionario'  , $_POST['id_funcionario']);
    $query->execute();
    if ($query->rowCount()==1){
        retornaErro('Funcionário já foi cadastrado.');
    }

    $query = $conexao->prepare("SELECT * FROM funcionario WHERE email_funcionario=:email_funcionario AND id_funcionario<>:id_funcionario");
    $query-> bindValue(':email_funcionario', $_POST['email_funcionario']);
    $query-> bindValue(':id_funcionario'  , $_POST['id_funcionario']);
    $query->execute();
    if ($query->rowCount()==1) {
        retornaErro('funcionario já foi cadastrado devido ao E-mail repetido');
    }

    $query = $conexao->prepare("UPDATE funcionario SET nome_funcionario=:nome_funcionario, email_funcionario=:email_funcionario, cpf_funcionario=:cpf_funcionario, telefone_funcionario=:telefone_funcionario WHERE id_funcionario=:id_funcionario");
    $query->bindParam(':id_funcionario',$_POST['id_funcionario']);
    $query->bindParam(':nome_funcionario',$_POST['nome_funcionario']);
    $query->bindParam(':email_funcionario',$_POST['email_funcionario']);
    $query->bindParam(':cpf_funcionario',$_POST['cpf_funcionario']);
    $query->bindParam(':telefone_funcionario',$_POST['telefone_funcionario']);
    $query->execute();

    if ($_POST['senha_funcionario']!='') {
        if ($_POST['senha_funcionario'] != $_POST['confsenha']) {
            retornaErro('Senha diferente');
        }

        $senhaCripitografada = sha1($_POST['senha']);

        $query = $conexao->prepare("UPDATE funcionario SET senha_funcionario=:senha_funcionario WHERE id_funcionario=:id_funcionario");
        $query->bindParam(':id_funcionario', $_POST['id_funcionario']);
        $query->bindParam(':senha_funcionario', $senhaCripitografada);
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
