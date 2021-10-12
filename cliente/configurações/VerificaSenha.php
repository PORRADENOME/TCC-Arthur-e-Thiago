<?php

session_start();

include "conexao.php";

$senha = sha1($_POST['senha_cliente']);
$query = $conexao->prepare("SELECT * FROM cliente WHERE email_cliente=:email_cliente AND senha_cliente=:senha_cliente ");
$query->bindValue(':email_cliente', $_POST['email_cliente']);
$query->bindValue(':senha_cliente', $senha);
$query->execute ();

if ($query->rowCount ()==1){
    $linha = $query->fetch ();

        $_SESSION['id'] = $linha->id;
        $_SESSION['email'] - $linha->email;
        $_SESSION['cliente'] = $_POST['cliente']; $_SESSION['autorizado'] = true;
        $_SESSION['autorizado'] = true;

        header ("Location: ../cliente/perfil_cliente.php");

}else {

    $_SESSION['autorizado'] = false;

    echo 'senha incorreta';
}


