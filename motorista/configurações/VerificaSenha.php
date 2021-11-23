<?php

session_start();

try {

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

        retornaErro('Usuário Banido');
    }

        $_SESSION['id'] = $linha->id_motorista;
        $_SESSION['email'] = $linha->email_motorista;
        $_SESSION['motorista'] = $linha->nome_motorista;
        $_SESSION['autorizado'] = true;

        retornaOK('Acesso autorizado');

}else {

    $_SESSION['autorizado'] = false;

    retornaErro('Senha ou E-mail incorretos');
}

} catch (Exception $exception) {
    retornaErro($exception->getMessage());
}



