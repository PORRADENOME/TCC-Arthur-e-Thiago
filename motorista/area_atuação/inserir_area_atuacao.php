<?php


require "../configurações/segurança.php";
try {

    include "../configurações/conexao.php";


    $query = $conexao->prepare("INSERT INTO area_atuacao (cidade_atuacao, motorista_atuacao) 
                                                            VALUES 
                                                               (:cidade,:motorista) ");
    $query->bindValue(':cidade', $_POST['cidade']);
    $query->bindValue(':motorista', $_SESSION['id']);

    $query->execute();

    if ($query->rowCount() == 1) {
        retornaOK('Inserido com sucesso ');
    } else {
        retornaErro('Erro ao inserir');
    }

} catch (Exception $exception) {
    retornaErro($exception->getMessage());}