<?php
try {

    require "../configurações/segurança.php";
    include "../configurações/conexao.php";

    if (!isset($_POST['id'])){
        die('Acesse através da listagem');
    }

//    $query = $conexao->prepare("DELETE FROM orcamento_itens WHERE idorcamento=:id");
//    $query->bindParam(':id', $_POST['id']);
//    $query->execute();
//
    $query = $conexao->prepare("DELETE FROM atendimento WHERE id=:id");
    $query->bindParam(':id', $_POST['id']);
    $query->execute();

    if ($query->rowCount()==1){
        retornaOK('Excluído com sucesso. ');
    }else{
        retornaErro('Nenhum registro excluído.');
    }

} catch (PDOException $exception ) {
    retornaErro( $exception->getMessage() );
}
