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



    $query = $conexao->prepare("INSERT INTO veiculo (numero_chassi_veiculo,marca_veiculo,modelo_veiculo,ano_veiculo,placa_veiculo,tipo_veiculo) VALUES (:numero_chassi,:marca,:modelo,:ano,:placa,:tipo) ");
    $query->bindValue(':numero_chassi', $_POST['numero_chassi']);
    $query->bindValue(':marca', $_POST['marca']);
    $query->bindValue(':modelo', $_POST['modelo']);
    $query->bindValue(':ano', $_POST['ano']);
    $query->bindValue(':placa', $_POST['placa']);
    $query->bindValue(':tipo', $_POST['tipo']);

    $query->execute();

    if ($query->rowCount() == 1) {
        retornaOK('Inserido com sucesso ');
    } else {
        retornaErro('Erro ao inserir');
    }

} catch (Exception $exception) {
    retornaErro($exception->getMessage());
}

