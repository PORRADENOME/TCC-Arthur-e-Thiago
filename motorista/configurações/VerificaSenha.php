<?php

session_start();

include "conexao.php";

$senha = sha1($_POST['senha_motorista']);
$query = $conexao->prepare("SELECT * FROM motorista WHERE email_motorista=:email_motorista AND senha_motorista=:senha_motorista ");
$query->bindValue(':email_motorista', $_POST['email_motorista']);
$query->bindValue(':senha_motorista', $senha);
$query->execute ();

if ($query->rowCount ()==1){
    $linha = $query->fetch ();

    if ($linha->motorista_ativo == 2) {
        $_SESSION['autorizado'] = false;

        echo('Usuário Banido');

    }

        $_SESSION['id'] = $linha->id_motorista;
        $_SESSION['email'] - $linha->email_motorista;
        $_SESSION['motorista'] = $_POST['motorista']; $_SESSION['autorizado'] = true;
        $_SESSION['autorizado'] = true;

        header ("Location: ../motorista/perfil_motorista.php");

}else {

    $_SESSION['autorizado'] = false;

    echo('Senha ou E-mail incorretos');
}


