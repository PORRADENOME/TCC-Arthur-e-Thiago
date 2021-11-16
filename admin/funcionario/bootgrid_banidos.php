<?php
require "../configurações/segurança.php";
try {

    require '../configurações/conexao.php';

    $pagina = $_POST ['current'];
    $quantidade = $_POST ['rowCount'];
    $inicio = ($pagina - 1) * $quantidade;

    $sql = "SELECT * FROM funcionario WHERE valor_admin!=0 AND valor_admin!=1 ";

    if($_POST['searchPhrase'] != '')
    {
        $sql .= " AND (
                 id_funcionario LIKE '%{$_POST['searchPhrase']}%' 
                 OR nome_funcionario LIKE '%{$_POST['searchPhrase']}%'
                 OR email_funcionario LIKE '%{$_POST['searchPhrase']}%'
                 OR cpf_funcionario LIKE '%{$_POST['searchPhrase']}%'
                 OR telefone_funcionario LIKE '%{$_POST['searchPhrase']}%'
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

