<?php
require "../configurações/segurança.php";
try {
   // include "../seguranca.php";
    require "../configurações/conexao.php";

    $queryServico = $conexao->prepare("SELECT * FROM servico WHERE id=:id");
    $queryServico->bindValue(":id", $_POST['idservico']);
    $queryServico->execute();

    $linhaServico = $queryServico->fetchObject();

    $query = $conexao->prepare("INSERT INTO atendimento_servico (idservico, idatendimento, valor) VALUES (:idservico, :idatendimento, :valor)" );
    $query->bindValue(':idservico', $_POST['idservico']);
    $query->bindValue(':idatendimento', $_POST['idatendimento']);
    $query->bindValue(':valor', $linhaServico->valor);
    $query->execute();

    if ($query->rowCount()==1){
        retornaOK('Inserido com sucesso');
    }else{
        retornaErro('Erro ao inserir');
    }

} catch (Exception $exception ) {
    retornaErro( $exception->getMessage() );
}
