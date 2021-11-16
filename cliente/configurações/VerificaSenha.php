<?php

session_start();

include "conexao.php";

$senha = sha1($_POST['senha_cliente']);
$query = $conexao->prepare("SELECT * FROM cliente WHERE email_cliente=:email_cliente AND senha_cliente=:senha_cliente ");
$query->bindValue(':email_cliente', $_POST['email_cliente']);
$query->bindValue(':senha_cliente', $senha);
$query->execute ();

/*$linha=$query->fetchObject();*/

if ($query->rowCount ()==1 /*AND $linha->cliente_ativo=1*/) {
    $linha = $query->fetch();

    if ($linha->cliente_ativo == 2) {
        $_SESSION['autorizado'] = false;

        echo 'Usuário Banido';
        exit;

    } elseif ($linha->cliente_ativo == 3) {
        $_SESSION['autorizado'] = false;

        echo 'Usuário Desativado';
        exit;

    }

    $_SESSION['id'] = $linha->id_cliente;
    $_SESSION['email'] - $linha->email_cliente;
    $_SESSION['cliente'] = $_POST['cliente'];
    $_SESSION['autorizado'] = true;

    header("Location: ../cliente/perfil_cliente.php");

}else {

    $_SESSION['autorizado'] = false;

    echo 'Senha ou Email Incorretos.';
}


