<?php


require "../configurações/segurança.php";
try {

    require '../configurações/conexao.php';

    $pagina = $_POST ['current'];
    $quantidade = $_POST ['rowCount'];
    $inicio = ($pagina - 1) * $quantidade;

    $query = $conexao->prepare("SELECT * FROM motorista WHERE id_motorista=:id_motorista");
    $query->bindParam(":id_motorista", $_SESSION['id']);
    $query->execute();

    $resultado = $query->fetchObject();

    $motorista_ativo = $resultado->motorista_ativo;

    if ($motorista_ativo!=0) {


        $sql = "SELECT orcamento.id_orcamento,
                   orcamento.data_e_horario,
                   orcamento.inf_adicionais,
                   orcamento.cliente_orcamento,
                   orcamento.orcamento_ativo,
                   cliente.nome_cliente             
                   FROM orcamento INNER JOIN cliente ON orcamento.cliente_orcamento=cliente.id_cliente  
                   WHERE orcamento_ativo!=2 AND proposta_aceita!=1  ";


        if ($_POST['searchPhrase'] != '') {
            $sql .= " AND (
                 id_orcamento LIKE '%{$_POST['searchPhrase']}%' 
                 OR data_e_horario LIKE '%{$_POST['searchPhrase']}%'
                 OR inf_adicionais LIKE '%{$_POST['searchPhrase']}%'
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

    }else{

        $sql = "SELECT orcamento.id_orcamento,
                   orcamento.data_e_horario,
                   orcamento.inf_adicionais,
                   orcamento.cliente_orcamento,
                   orcamento.orcamento_ativo,
                   cliente.nome_cliente             
                   FROM orcamento INNER JOIN cliente ON orcamento.cliente_orcamento=cliente.id_cliente 
                   WHERE orcamento_ativo=1000 AND proposta_aceita!=1";


        if ($_POST['searchPhrase'] != '') {
            $sql .= " AND (
                 id_orcamento LIKE '%{$_POST['searchPhrase']}%' 
                 OR data_e_horario LIKE '%{$_POST['searchPhrase']}%'
                 OR inf_adicionais LIKE '%{$_POST['searchPhrase']}%'
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



    }
} catch (PDOException $exception) {
    echo($exception->getMessage());
}
