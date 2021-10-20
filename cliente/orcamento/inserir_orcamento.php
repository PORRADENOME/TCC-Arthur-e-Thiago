<?php


require "../configurações/segurança.php";
try {

    include "../configurações/conexao.php";

    if ($_POST['senha'] != $_POST['confsenha']) {
        retornaErro('senhas diferentes');
    }

    $senhaCriptografada = sha1($_POST['senha']);

    /*
     $query = $conexao->prepare("SELECT * FROM funcionario WHERE funcionario=:funcionario");
     $query->bindValue(':funcionario',$_POST['funcionario']);
     $query->execute();
     if ($query->rowCount() == 1) {
         retornaErro('funcionario ja em uso');
     }
    */



    $query = $conexao->prepare("INSERT INTO orcamento (data_e_horario_orcamento,inf_adicionais_orcamento ) VALUES (:data_e_horario,:inf_adicionais) ");
    $query->bindValue(':data_e_horario', $_POST['data_e_horario']);
    $query->bindValue(':inf_adicionais', $_POST['inf_adicionais']);

    $query->execute();

    if ($query->rowCount() == 1) {
        retornaOK('Inserido com sucesso ');
    } else {
        retornaErro('Erro ao inserir');
    }

} catch (Exception $exception) {
    retornaErro($exception->getMessage());
}

