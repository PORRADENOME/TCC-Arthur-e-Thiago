<?php
require "../configurações/segurança.php";
try {
    include "../configurações/conexao.php";

    if (!isset($_POST['id'])) {
        die('Acesse através da listagem');
    }

    if ($_POST['id'] == $_SESSION['id']){

        retornaErro('Você não pode banir a si mesmo!');
    }

    $query = $conexao->prepare("SELECT * FROM funcionario WHERE id_funcionario=:id_funcionario");
    $query->bindParam(':id_funcionario', $_POST['id']);
    $query->execute();
    $linhafuncionario = $query->fetchObject();

    if (($linhafuncionario->valor_admin)==1 ){

        retornaErro('Você não pode banir outros administradores!');
    }

    $query = $conexao->prepare("UPDATE funcionario SET valor_admin=2 WHERE id_funcionario=:id_funcionario");
    $query->bindParam(':id_funcionario', $_POST['id']);
    $query->execute();

    if ($query->rowCount() == 1) {
        retornaOK( 'Banido com sucesso');
    }
    else {
        retornaErro( 'Erro ao banir');
    }

} catch (PDOException $exception) {
    echo $exception->getMessage();
}