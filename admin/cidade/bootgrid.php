<?php
require "../configurações/segurança.php";
try {

    require '../configurações/conexao.php';

    $pagina = $_POST ['current'];
    $quantidade = $_POST ['rowCount'];
    $inicio = ($pagina - 1) * $quantidade;

   // $sql = "SELECT * FROM cidade, estado WHERE cidade.estado_cidade=:estado.id_estado ";
    $sql = "SELECT cidade.nome_cidade,cidade.id_cidade,cidade.cidade_ativa,estado.nome_estado FROM cidade 
                                                                                        INNER JOIN estado 
                                                                                        ON cidade.estado_cidade=estado.id_estado 
                                                                                        WHERE cidade_ativa!=2";

    if($_POST['searchPhrase'] != '')
    {
        $sql .= " AND (
                 id_cidade LIKE '%{$_POST['searchPhrase']}%' 
                 OR nome_cidade LIKE '%{$_POST['searchPhrase']}%'
                 OR nome_estado LIKE '%{$_POST['searchPhrase']}%'
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
