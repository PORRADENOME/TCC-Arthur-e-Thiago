<?php


require "../configurações/segurança.php";
try {

    require '../configurações/conexao.php';

    $pagina = $_POST ['current'];
    $quantidade = $_POST ['rowCount'];
    $inicio = ($pagina - 1) * $quantidade;


    $sql = "SELECT endereco.id_endereco, 
	   endereco.nome_endereco, 
       endereco.pais, 
       endereco.bairro, 
       endereco.rua, 
       endereco.numero, 
       endereco.complemento, 
       cidade.nome_cidade, 
       estado.nome_estado 
	FROM 
	   endereco 
	INNER JOIN 
		cidade 
	ON 
		endereco.cidade=cidade.id_cidade 
	INNER JOIN 
		estado 
	ON 
		endereco.estado=estado.id_estado WHERE cliente_endereco={$_SESSION['id']}";


    if ($_POST['searchPhrase'] != '') {
        $sql .= " AND (
                 OR endereco.pais LIKE '%{$_POST['searchPhrase']}%'
                 OR estado.nome_estado LIKE '%{$_POST['searchPhrase']}%'
                 OR cidade.nome_cidade LIKE '%{$_POST['searchPhrase']}%'
                 OR endereco.bairro LIKE '%{$_POST['searchPhrase']}%'
                 OR endereco.rua LIKE '%{$_POST['searchPhrase']}%'
                 OR endereco.numero LIKE '%{$_POST['searchPhrase']}%'
                 OR endereco.complemento LIKE '%{$_POST['searchPhrase']}%'
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
