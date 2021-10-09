<?php

try {
    require '../configurações/conexao.php';

    require "../configurações/segurança.php";

    $pagina = $_POST['current'];
    $quantidade = $_POST['rowCount'];
    $inicio = ($pagina - 1 ) * $quantidade;

    //Contagem quantidade de registros
    $sql="Select
    atendimento_produto.quantidade,
    produto.nome,
    atendimento_produto.valorproduto,
    atendimento_produto.id
From
    atendimento_produto Inner Join
    produto On atendimento_produto.idproduto = produto.id
Where
    atendimento_produto.idatendimento = {$_POST['id']}  ";

    if ($_POST['searchPhrase']!=''){
        $sql .= " and (
                        produto.nome LIKE '%{$_POST['searchPhrase']}%' or
                        produto.descricao LIKE '%{$_POST['searchPhrase']}%'
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
