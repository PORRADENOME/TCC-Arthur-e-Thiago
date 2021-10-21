<?php


require "../configurações/segurança.php";
try {

    include "../configurações/conexao.php";


    /*
     $query = $conexao->prepare("SELECT * FROM funcionario WHERE funcionario=:funcionario");
     $query->bindValue(':funcionario',$_POST['funcionario']);
     $query->execute();
     if ($query->rowCount() == 1) {
         retornaErro('funcionario ja em uso');
     }
    */



    $query = $conexao->prepare("INSERT INTO endereco (nome_endereco, pais, estado, cidade bairro, rua, numero, complemento ) VALUES (:pais,:bairro,:rua,:numero,:complemento) ");
    $query->bindValue(':pais', $_POST['pais']);
    $query->bindValue(':bairro', $_POST['bairro']);
    $query->bindValue(':rua', $_POST['rua']);
    $query->bindValue(':numero', $_POST['inumero']);
    $query->bindValue(':complemento', $_POST['complemento']);

    $query->execute();

    if ($query->rowCount() == 1) {
        retornaOK('Inserido com sucesso ');
    } else {
        retornaErro('Erro ao inserir');
    }

} catch (Exception $exception) {
    retornaErro($exception->getMessage());
}

