<?php
try{

    include "../configurações/segurança.php";
    include "../configurações/conexao.php";

    if (!isset($_POST['id'])) {
        die('Faltando parametro: POST["id"]');
    }

    $query = $conexao->prepare("SELECT id_endereco,nome_endereco FROM endereco WHERE 
                                                                                                id_endereco!=:id_endereco 
                                                                                         AND   
                                                                                                cliente_endereco={$_SESSION['id']}");
    $query->bindParam(':id_endereco', $_POST['id']);


    $resultado = $query->execute();
    $arr_endereco = $query->fetchAll();

    //echo var_dump($arr_cidades);

    header('Content-type: application/json');
    echo json_encode($arr_endereco);


}catch (PDOException $exception){
    echo $exception->getMessage();
}