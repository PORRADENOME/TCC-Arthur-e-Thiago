<?php


require "../configurações/segurança.php";
try {

    include "../configurações/conexao.php";


    $query = $conexao->prepare("INSERT INTO veiculo (numero_chassi_veiculo,
                                                               marca_veiculo,
                                                               modelo_veiculo, 
                                                               ano_veiculo, 
                                                               placa_veiculo, 
                                                               tipo_veiculo,
                                                               motorista_veiculo) 
                                                            VALUES 
                                                               (:numero_chassi,
                                                               :marca,
                                                               :modelo,
                                                               :ano,
                                                               :placa,
                                                               :tipo,
                                                               :motorista_veiculo) ");
    $query->bindValue(':numero_chassi', $_POST['numero_chassi']);
    $query->bindValue(':marca', $_POST['marca']);
    $query->bindValue(':modelo', $_POST['modelo']);
    $query->bindValue(':ano', $_POST['ano']);
    $query->bindValue(':placa', $_POST['placa']);
    $query->bindValue(':tipo', $_POST['tipo']);
    $query->bindValue(':motorista_veiculo',  $_SESSION['id']);

    $query->execute();

    if ($query->rowCount() == 1) {
        retornaOK('Inserido com sucesso ');
    } else {
        retornaErro('Erro ao inserir');
    }

} catch (Exception $exception) {
    retornaErro($exception->getMessage());
}

