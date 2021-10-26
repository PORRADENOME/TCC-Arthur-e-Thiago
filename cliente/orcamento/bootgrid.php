<?php


require "../configurações/segurança.php";
try {

    require '../configurações/conexao.php';

    $pagina = $_POST ['current'];
    $quantidade = $_POST ['rowCount'];
    $inicio = ($pagina - 1) * $quantidade;

    $sql = "SELECT orcamento.data_e_horario,
                   orcamento.inf_adicionais,
                   endereco.nome_endereco,
                   endereco.nome_endereco 
                FROM 
                   orcamento 
                INNER JOIN 
                   endereco
                ON 
                   orcamento.endereco_partida=endereco.id_endereco
                AND 
                   orcamento.endereco_destino=endereco.id_endereco";


    if ($_POST['searchPhrase'] != '') {
        $sql .= " AND (
                 data_e_horario LIKE '%{$_POST['searchPhrase']}%'
                 OR inf_adicionais LIKE '%{$_POST['searchPhrase']}%'
                 OR nome_endereco LIKE '%{$_POST['searchPhrase']}%'                              
                 OR nome_endereco LIKE '%{$_POST['searchPhrase']}%'
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
