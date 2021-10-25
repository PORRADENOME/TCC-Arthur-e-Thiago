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



    $query = $conexao->prepare("INSERT INTO endereco (nome_endereco,
                                                                pais,
                                                                estado,
                                                                cidade,
                                                                bairro,
                                                                rua,
                                                                numero,
                                                                complemento,
                                                                cliente_endereco) 
                                                            VALUES 
                                                                (:nome_endereco,
                                                                :pais,
                                                                :estado,
                                                                :cidade,
                                                                :bairro,
                                                                :rua,
                                                                :numero,
                                                                :complemento,
                                                                :cliente_endereco) ");
    $query->bindValue(':nome_endereco', $_POST['nome_endereco']);
    $query->bindValue(':pais', $_POST['pais']);
    $query->bindValue(':estado', $_POST['estado']);
    $query->bindValue(':cidade', $_POST['cidade']);
    $query->bindValue(':bairro', $_POST['bairro']);
    $query->bindValue(':rua', $_POST['rua']);
    $query->bindValue(':numero', $_POST['numero']);
    $query->bindValue(':complemento', $_POST['complemento']);
    $query->bindValue(':cliente_endereco', $_SESSION['id']);

    $query->execute();

    if ($query->rowCount() == 1) {
        retornaOK('Inserido com sucesso ');
    } else {
        retornaErro('Erro ao inserir');
    }

} catch (Exception $exception) {
    retornaErro($exception->getMessage());
}

