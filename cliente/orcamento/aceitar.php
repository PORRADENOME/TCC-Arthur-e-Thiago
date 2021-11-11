<?php


require "../configurações/segurança.php";
try {
    include "../configurações/conexao.php";



    $query = $conexao->prepare("SELECT orcamento_proposta FROM proposta WHERE id_porposta=:idproposta");
    $query->bindParam(':id_proposta', $_POST['id_proposta']);
    $query->execute();

    $orcamento_proposta = $query->fetchObject();

    echo $orcamento_proposta;

    $query = $conexao->prepare("UPDATE proposta SET proposta_aprovada=1 WHERE id_proposta=:id_proposta");
    $query->bindParam(':id_proposta', $_POST['id_proposta']);
    $query->execute();

    $query = $conexao->prepare("UPDATE proposta SET proposta_aprovada=2 WHERE id_proposta!=1 AND orcamento_proposta=1;");
    $query->bindParam(':id_proposta', $_POST['id_proposta']);
    $query->bindParam(':orcamento_proposta', $orcamento_proposta);
    $query->execute();


    if ($query->rowCount() == 1) {
        retornaOK('Alterado com sucesso. ');

    } else {
        retornaOK('Nenhum dado alterado. ');
    }


} catch (PDOException $exception) {
    retornaErro($exception->getMessage());
}
