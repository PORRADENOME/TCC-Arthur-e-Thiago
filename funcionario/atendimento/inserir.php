<?php
require "../configurações/segurança.php";
try {
   // include "../seguranca.php";
    require "../configurações/conexao.php";


    $query = $conexao->prepare("INSERT INTO atendimento (idatendente, idcliente, data) VALUES (:idatendente, :idcliente, NOW() )" );
    $query->bindValue(':idatendente', $_POST['idatendente']);
    $query->bindValue(':idcliente', $_POST['idcliente']);
    $query->execute();

    if ($query->rowCount()==1){
        $retorno['status'] = true;
        $retorno['mensagem'] = 'Inserido com sucesso';
        $retorno['id'] = $conexao->lastInsertId();

        echo json_encode($retorno);
        exit;
    }else{
        retornaErro('Erro ao inserir');
    }

} catch (Exception $exception ) {
    retornaErro( $exception->getMessage() );
}
