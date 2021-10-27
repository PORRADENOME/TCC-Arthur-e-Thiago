<?php

require "../configurações/segurança.php";
try {

    require '../configurações/conexao.php';

    $pagina = $_POST ['current'];
    $quantidade = $_POST ['rowCount'];
    $inicio = ($pagina - 1) * $quantidade;

    $sql = "Select
                cidade.nome_cidade,
                estado.nome_estado
            From
                area_atuacao 
	            Inner Join
		            cidade On area_atuacao.cidade_atuacao = cidade.id_cidade 
                    Inner Join
		                estado On cidade.estado_cidade = estado.id_estado";


    if ($_POST['searchPhrase'] != '') {
        $sql .= " AND (
                 estado.nome_estado LIKE '%{$_POST['searchPhrase']}%'
                 OR cidade.nome_cidade LIKE '%{$_POST['searchPhrase']}%'
                 ) ";
    }
    $resultados = $conexao->prepare($sql);
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
} catch (PDOException $exception) {
    echo($exception->getMessage());
}
