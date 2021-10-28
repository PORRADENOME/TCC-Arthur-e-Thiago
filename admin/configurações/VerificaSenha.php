<?php

session_start();

include "conexao.php";

$senha = sha1($_POST['senha_funcionario']);
$query = $conexao->prepare("SELECT * FROM funcionario WHERE email_funcionario=:email_funcionario AND senha_funcionario=:senha_funcionario ");
$query->bindValue(':email_funcionario', $_POST['email_funcionario']);
$query->bindValue(':senha_funcionario', $senha);
$query->execute ();

if ($query->rowCount ()==1){
    $linha = $query->fetch ();

        $_SESSION['id'] = $linha->id;
        $_SESSION['email'] - $linha->email;
        $_SESSION['funcionario'] = $_POST['funcionario']; $_SESSION['autorizado'] = true;
        $_SESSION['autorizado'] = true;

        header ("Location: ../funcionario/listagem_funcionario.php");

}else {

    $_SESSION['autorizado'] = false;

    echo 'senha incorreta';
}


