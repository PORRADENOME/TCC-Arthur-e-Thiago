<?php


require "../configurações/segurança.php";
try {
    include "../configurações/conexao.php";


    $query = $conexao->prepare("UPDATE endereco SET nome_endereco=:nome_endereco,
                                                              pais=:pais,
                                                              estado=:estado,
                                                              cidade=:cidade, 
                                                              bairro=:bairro,
                                                              rua=:rua, 
                                                              numero=:numero, 
                                                              complemento=:complemento 
                                                            WHERE 
                                                              id_endereco=:id_endereco");
    $query->bindParam(':id_endereco', $_POST['id_endereco']);
    $query->bindParam(':nome_endereco', $_POST['nome_endereco']);
    $query->bindParam(':pais', $_POST['pais']);
    $query->bindParam(':estado', $_POST['estado']);
    $query->bindParam(':cidade', $_POST['cidade']);
    $query->bindParam(':bairro', $_POST['bairro']);
    $query->bindParam(':rua', $_POST['rua']);
    $query->bindParam(':numero', $_POST['numero']);
    $query->bindParam(':complemento', $_POST['complemento']);
    $query->execute();


    if ($query->rowCount() == 1) {
        retornaOK('Alterado com sucesso. ');

    } else {
        retornaOK('Nenhum dado alterado. ');
    }


} catch (PDOException $exception) {
    retornaErro($exception->getMessage());
}

