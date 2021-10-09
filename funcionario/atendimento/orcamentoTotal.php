<?php
// require "../seguranca.php";
require "../configurações/segurança.php";
try {
    include "../configurações/conexao.php";

    if (!isset($_GET['id'])){
        die('Acesse através da listagem');
    }

    $query = $conexao->prepare("SELECT * FROM atendimento WHERE id=:id");
    $query->bindValue(":id", $_GET['id']);
    $query->execute();

    $linha = $query->fetchObject();

    $ret['valortotal'] = $linha->valortotal;

    echo json_encode($ret);




} catch (PDOException $exception ) {
    echo $exception->getMessage();
}
