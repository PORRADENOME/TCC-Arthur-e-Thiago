<?php


require "../configurações/segurança.php";
try {
    include "../configurações/conexao.php";



    $query = $conexao->prepare("UPDATE orcamento SET data_e_horario_orcamento=:data_e_horario_orcamento, inf_adicionais_orcamento=:inf_adicionais_orcamento WHERE id_orcamento=:id_orcamento");
    $query->bindParam(':id_orcamento', $_POST['id_orcamento']);
    $query->bindParam(':data_e_horario_orcamento', $_POST['data_e_horario_orcamento']);
    $query->bindParam(':inf_adicionais_orcamento', $_POST['inf_adicionais_orcamento']);
    $query->execute();


    if ($query->rowCount() == 1) {
        retornaOK('Alterado com sucesso. ');

    } else {
        retornaOK('Nenhum dado alterado. ');
    }


} catch (PDOException $exception) {
    retornaErro($exception->getMessage());
}

