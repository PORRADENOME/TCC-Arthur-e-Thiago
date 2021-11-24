<?php

session_start();

try {

    include "conexao.php";

    $senha = sha1($_POST['senha_funcionario']);
    $query = $conexao->prepare("SELECT * FROM funcionario WHERE email_funcionario=:email_funcionario AND senha_funcionario=:senha_funcionario ");
    $query->bindValue(':email_funcionario', $_POST['email_funcionario']);
    $query->bindValue(':senha_funcionario', $senha);
    $query->execute();

    if ($query->rowCount() == 1) {
        $linha = $query->fetch();

        if ($linha->valor_admin == 2) {
            $_SESSION['autorizado'] = false;

            retornaErro('Usuário Banido');
        }

        $_SESSION['id'] = $linha->id_funcionario;
        $_SESSION['valor_admin'] = $linha->valor_admin;
        $_SESSION['email'] = $linha->email_funcionario;
        $_SESSION['autorizado'] = true;

            retornaOK("Acesso autorizado");


    } else {

        $_SESSION['autorizado'] = false;

        retornaErro('Senha ou E-mail Incorretos');
    }

}catch (Exception $exception) {
    retornaErro($exception->getMessage());
}
?>