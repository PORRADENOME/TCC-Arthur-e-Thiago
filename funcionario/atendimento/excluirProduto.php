<?php
try {
    //include "../seguranca.php";
    include "../configurações/conexao.php";

    require "../configurações/segurança.php";

    if (!isset($_POST['id'])){
        die('Acesse através da listagem');
    }

    $query = $conexao->prepare("DELETE FROM atendimento_produto WHERE id=:id");
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
