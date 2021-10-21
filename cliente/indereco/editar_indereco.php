<?php


require "../configurações/segurança.php";
try {
    include "../configurações/conexao.php";



    $query = $conexao->prepare("UPDATE indereco SET pais_indereco=:pais_indereco, bairro_indereco=:bairro_indereco,rua_indereco=:rua_indereco, numero_indereco=:numero_indereco, complemento_indereco=:complemento_indereco WHERE id_indereco=:id_indereco");
    $query->bindParam(':id_indereco', $_POST['id_indereco']);
    $query->bindParam(':pais_indereco', $_POST['pais_indereco']);
    $query->bindParam(':bairro_indereco', $_POST['bairro_indereco']);
    $query->bindParam(':rua_indereco', $_POST['rua_indereco']);
    $query->bindParam(':numero_indereco', $_POST['numero_indereco']);
    $query->bindParam(':complemento_indereco', $_POST['complemento_indereco']);
    $query->bindParam(':email_funcionario', $_POST['email_funcionario']);
    $query->execute();


    if ($query->rowCount() == 1) {
        retornaOK('Alterado com sucesso. ');

    } else {
        retornaOK('Nenhum dado alterado. ');
    }


} catch (PDOException $exception) {
    retornaErro($exception->getMessage());
}

