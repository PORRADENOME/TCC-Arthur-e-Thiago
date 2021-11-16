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

    if ($linha->valor_admin == 2) {
        $_SESSION['autorizado'] = false;

        retornaErro('Usuário Banido');

        header("Location: ../configurações/index.php");
        exit;

    }

        $_SESSION['id'] = $linha->id_funcionario;
        $_SESSION['valor_admin'] = $linha->valor_admin;
        $_SESSION['email'] - $linha->email;
        $_SESSION['funcionario'] = $_POST['funcionario']; $_SESSION['autorizado'] = true;
        $_SESSION['autorizado'] = true;


            if ($_SESSION['valor_admin']==1):

                header ("Location: ../funcionario/listagem_funcionario.php");
            elseif ($_SESSION['valor_admin']==0):

                header ("Location: ../perfil/perfil_funcionario.php");
            endif;


}else {

    $_SESSION['autorizado'] = false;

    echo 'senha ou email incorretos';
}


?>