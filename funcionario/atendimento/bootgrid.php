<?php

try {
    require '../configurações/conexao.php';

    require "../configurações/segurança.php";

    $pagina = $_POST['current'];
    $quantidade = $_POST['rowCount'];
    $inicio = ($pagina - 1 ) * $quantidade;

    //Contagem quantidade de registros
    $sql="Select
    motorista.nome As atendente_nome,
    atendente.nome As cliente_nome,
    atendimento.id,
    atendimento.valortotal,
    atendimento.desconto
From
    atendimento Inner Join
    atendente On atendimento.idatendente = atendente.id Inner Join
    motorista On atendimento.idcliente = motorista.id
Where 1 ";

    if ($_POST['searchPhrase']!=''){
        $sql .= " and (
                        atendente.nome LIKE '%{$_POST['searchPhrase']}%'
                        OR motorista.nome LIKE '%{$_POST['searchPhrase']}%'
                        ) ";
    }

    $resultados = $conexao->prepare($sql);
    $resultados->execute();
    $total = $resultados->rowCount();
    //FIM - Contagem quantidade de registros

    $sql .= " ORDER BY ";
    foreach ($_POST['sort'] as $campo => $tipo_order) {
        $sql .= $campo . " "  . $tipo_order;
    }

    if ($quantidade<>-1){
        $sql .=  " LIMIT {$inicio} , {$quantidade} ";
    }

    $resultados=$conexao->prepare($sql);
    $resultados->execute();

    $ret['current'] = $pagina;
    $ret['rowCount'] = $resultados->rowCount();
    $ret['total'] = $total;
    $ret['rows'] = $resultados->fetchAll();

    echo json_encode($ret);

}catch (PDOException $exception){
    echo $exception->getMessage();
}
