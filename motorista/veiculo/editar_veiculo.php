<?php


require "../configurações/segurança.php";
try {
    include "../configurações/conexao.php";



    $query = $conexao->prepare("UPDATE veiculos SET numero_chassi_veiculo=:numero_chassi_veiculo, marca_veiculo=:marca_veiculo,modelo_veiculo=:modelo_veiculo, ano_veiculo=:ano_veiculo, placa_veiculo=:placa_veiculo, tipo_veiculo=:tipo_veiculo WHERE id_veiculo=:id_veiculo");
    $query->bindParam(':id_veiculo', $_POST['id_veiculo']);
    $query->bindParam(':numero_chassi_veiculo', $_POST['numero_chassi_veiculo']);
    $query->bindParam(':marca_veiculo', $_POST['marca_veiculo']);
    $query->bindParam(':modelo_veiculo', $_POST['modelo_veiculo']);
    $query->bindParam(':ano_veiculo', $_POST['ano_veiculo']);
    $query->bindParam(':placa_veiculo', $_POST['placa_veiculo']);
    $query->bindParam(':tipo_veiculo', $_POST['tipo_veiculo']);
    $query->execute();


    if ($query->rowCount() == 1) {
        retornaOK('Alterado com sucesso. ');

    } else {
        retornaOK('Nenhum dado alterado. ');
    }


} catch (PDOException $exception) {
    retornaErro($exception->getMessage());
}


