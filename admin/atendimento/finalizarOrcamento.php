<?php

try {
   // include "../configurações/seguranca.php";
    require "../configurações/conexao.php";
    require "../configurações/segurança.php";
   # if (!isset($_POST['idatendimento'])){
   #     die('Acesse através do orçamento');
   # }

    $query = $conexao->prepare("UPDATE atendimento SET desconto=:desconto, valortotal=:valor_final, formapagamento=:pagamento WHERE id=:id" );
    $query->bindValue(':pagamento', $_POST['pagamento']);
    $query->bindValue(':desconto', $_POST['desconto']);
    $query->bindValue(':valor_final', $_POST['valor_final']);
    $query->bindValue(':id', $_POST['idatendimento']);
    $query->execute();

    header("Location: exibirOrcamento.php?id={$_POST['idatendimento']}");

} catch (Exception $exception ) {
    retornaErro( $exception->getMessage() );
}
