<?php


require "../configurações/segurança.php";
try {
    include "../configurações/conexao.php";



    $query = $conexao->prepare("UPDATE orcamento SET data_e_horario=:data_e_horario, inf_adicionais=:inf_adicionais WHERE id_orcamento=:id_orcamento");
    $query->bindParam(':id_orcamento', $_POST['id_orcamento']);
    $query->bindParam(':data_e_horario', $_POST['data_e_horario']);
    $query->bindParam(':inf_adicionais', $_POST['inf_adicionais']);
    $query->execute();


    if ($query->rowCount() == 1) {
        retornaOK('Alterado com sucesso. ');

    } else {
        retornaOK('Nenhum dado alterado. ');
    }


} catch (PDOException $exception) {
    retornaErro($exception->getMessage());
}

