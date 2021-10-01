<?php

session_start();

include "conexao.php";

$senha = sha1($_POST['senha']);
$query = $conexao->prepare("SELECT * FROM funcionario WHERE funcionario=:email_funcionario AND senha=:senha_funcionario ");
$query->bindValue(':funcionario', $_POST['funcionario']);
$query->bindValue(':senha', $senha);
$query->execute ();

if ($query->rowCount ()==1){
    $linha = $query->fetch ();

    if ($linha->ativo==1){
        $_SESSION['id'] = $linha->id;
        $_SESSION['email'] - $linha->email;
        $_SESSION['funcionario'] = $_POST['funcionario']; $_SESSION['autorizado'] = true;
        $_SESSION['autorizado'] = true;

        header ("Location: ../funcionario/listagem_funcionario.php");
    }else if ($linha->ativo==2){
        $_SESSION['autorizado'] = false;

        echo 'banido';
    }else if ($linha->ativo==3){
        $_SESSION['autorizado'] = false;

        echo 'desativado';
    }

}else {

    $_SESSION['autorizado'] = false;

    echo 'senha incorreta';
}


