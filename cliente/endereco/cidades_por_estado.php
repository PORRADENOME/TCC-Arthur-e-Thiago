<?php
try{
    include "../configurações/conexao.php";

    if (!isset($_POST['id'])) {
        die('Faltando parametro: POST["id"]');
    }

    $query = $conexao->prepare("SELECT * FROM cidade WHERE estado_cidade=:id_estado");
    $query->bindParam(':id_estado', $_POST['id']);

    $resultado = $query->execute();
    $arr_cidades = $query->fetchAll();

    //echo var_dump($arr_cidades);

    header('Content-type: application/json');
    echo json_encode($arr_cidades);


}catch (PDOException $exception){
    echo $exception->getMessage();
}