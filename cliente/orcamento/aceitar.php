<?php


require "../configurações/segurança.php";
try {
    include "../configurações/conexao.php";



    $query = $conexao->prepare("UPDATE proposta SET proposta_aprovada=1 WHERE id_proposta=:id_proposta");
    $query->bindParam(':id_orcamento', $_POST['id_orcamento']);
    $query->execute();


    if ($query->rowCount() == 1) {
        retornaOK('Alterado com sucesso. ');

    } else {
        retornaOK('Nenhum dado alterado. ');
    }


} catch (PDOException $exception) {
    retornaErro($exception->getMessage());
}
