<?php


require "../configurações/segurança.php";
try {

    require '../configurações/conexao.php';

    $pagina = $_POST ['current'];
    $quantidade = $_POST ['rowCount'];
    $inicio = ($pagina - 1) * $quantidade;

    $sql = "Select
    proposta.id_proposta,
    proposta.preco,
    proposta.informacoes_adicionais,
    motorista.nome_motorista
From
    proposta Inner Join
    motorista On proposta.motorista_proposta = motorista.id_motorista
    where orcamento_proposta={$_POST['id']}";


    if ($_POST['searchPhrase'] != '') {
        $sql .= " AND (
                 preco LIKE '%{$_POST['searchPhrase']}%'
                 OR informacoes_adicionais LIKE '%{$_POST['searchPhrase']}%'
                 OR nome_motorista LIKE '%{$_POST['searchPhrase']}%'                              
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
