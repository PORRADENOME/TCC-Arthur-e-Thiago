<?php
//require "../configurações/segurança.php";
try {
    include "../configurações/conexao.php";

    $query = $conexao->prepare("SELECT * FROM funcionario WHERE funcionario=:funcionario AND id<>:id");
    $query-> bindValue(':funcionario', $_POST['funcionario']);
    $query-> bindValue(':id'  , $_POST['id']);
    $query->execute();
    if ($query->rowCount()==1){
        retornaErro('Usuario já foi cadastrado.');
    }

    $query = $conexao->prepare("SELECT * FROM funcionario WHERE email=:email AND id<>:id");
    $query-> bindValue(':email', $_POST['email']);
    $query-> bindValue(':id'  , $_POST['id']);
    $query->execute();
    if ($query->rowCount()==1) {
        retornaErro('funcionario já foi cadastrado devido ao E-mail repetido');
    }

    $query = $conexao->prepare("UPDATE funcionario SET nome=:nome, email=:email, funcionario=:funcionario WHERE id=:id");
    $query->bindParam(':id',$_POST['id']);
    $query->bindParam(':nome',$_POST['nome']);
    $query->bindParam(':email',$_POST['email']);
    $query->bindParam(':funcionario',$_POST['funcionario']);
    $query->execute();

    if ($_POST['senha']!='') {
        if ($_POST['senha'] != $_POST['confsenha']) {
            retornaErro('Senha diferente');
        }

        $senhaCripitografada = sha1($_POST['senha']);

        $query = $conexao->prepare("UPDATE funcionario SET senha=:senha WHERE id=:id");
        $query->bindParam(':id', $_POST['id']);
        $query->bindParam(':senha', $senhaCripitografada);
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
