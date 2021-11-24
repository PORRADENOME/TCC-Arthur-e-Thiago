<?php
require "../configurações/segurança.php";
try {
    include "../configurações/conexao.php";

    if (!isset($_POST['id'])) {
        die('Acesse através da listagem');
    }


    $query = $conexao->prepare("Select
        id_orcamento,
        orcamento_ativo
    From
        orcamento
    Where
        cliente_orcamento=:id_cliente AND 
        orcamento_ativo!=2
        ");
    $query->bindParam(':id_cliente', $_POST['id']);

    $query->execute();
    $linha = $query->fetchAll();

    if($query->rowCount() == 0) {


        $query = $conexao->prepare("UPDATE cliente SET cliente_ativo=2 WHERE id_cliente=:id_cliente ");
        $query->bindParam(':id_cliente', $_POST['id']);

        $query->execute();

        if ($query->rowCount() >= 1) {
            retornaOK('Banido com sucesso');
        } else {
            retornaErro('Erro ao banir');
        }

    }else{
        retornaErro("Erro ao desativar, existem orçamentos vinculados a este cliente");
    }


} catch (PDOException $exception) {
    echo $exception->getMessage();
}
