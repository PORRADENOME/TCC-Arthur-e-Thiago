<?php



require "../configurações/segurança.php";
try {
    include "../configurações/conexao.php";

    if (!isset($_POST['id'])) {
        die('Acesse através da listagem');
    }

    $query = $conexao->prepare("DELETE FROM area_atuacao WHERE id_area_atuacao=:id_area_atuacao");
    $query->bindParam(':id_area_atuacao', $_POST['id']);
    $query->execute();

    if ($query->rowCount() == 1) {
        retornaOK('Excluido com sucesso');
    } else {
        retornaErro('Erro ao excluir');
    }

} catch (PDOException $exception) {
    echo $exception->getMessage();
}

