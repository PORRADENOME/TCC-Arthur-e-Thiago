<?php
require "../configurações/segurança.php";
try {

    require '../configurações/conexao.php';

    $pagina = $_POST ['current'];
    $quantidade = $_POST ['rowCount'];
    $inicio = ($pagina - 1) * $quantidade;

   // $sql = "SELECT * FROM cidade, estado WHERE cidade.estado_cidade=:estado.id_estado ";
    $sql = "SELECT * FROM cidade WHERE 1 ";

    if($_POST['searchPhrase'] != '')
    {
        $sql .= " AND (
                 id_cidade LIKE '%{$_POST['searchPhrase']}%' 
                 OR nome_cidade LIKE '%{$_POST['searchPhrase']}%'
                 OR nome_estado LIKE '%{$_POST['searchPhrase']}%'
                 ) ";
    }

    $sql = "SELECT * FROM estado WHERE 1 ";

    if($_POST['searchPhrase'] != '')
    {
        $sql .= " AND (
                 nome_estado LIKE '%{$_POST['searchPhrase']}%' 
                 ) ";
    }

    $resultados=$conexao->prepare($sql);
    $resultados->execute();
    $total = $resultados->rowCount();


    $sql .= " ORDER BY ";

    foreach ($_POST['sort'] as $campo => $tipo_order) {
        $sql .= $campo . " " . $tipo_order;
    }

    if ($quantidade <> -1) {
        $sql .= " LIMIT {$inicio}, {$quantidade} ";
    }
    $resultados = $conexao->prepare($sql);
    $resultados->execute();

    $ret['current'] = $pagina;
    $ret['rowCount'] = $resultados->rowCount();
    $ret['total'] = $total;
    $ret['rows'] = $resultados->fetchAll();

    echo json_encode($ret);
}catch (PDOException $exception){
    echo ($exception->getMessage());
}
