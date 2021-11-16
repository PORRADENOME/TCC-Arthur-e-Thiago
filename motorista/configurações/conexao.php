<?php

try {

    // Computador do lab3
	// $conexao = new PDO(  'mysql:host=localhost;dbname=mudanca_bd', 'root', 'root' );

	// Computador de casa
	$conexao = new PDO(  'mysql:host=localhost;dbname=mudanca_bd', 'root', 'root' );

    // Computador do cpd computador 10
	//$conexao = new PDO(  'mysql:host=localhost;dbname=mudanca_bd', 'root2', 'root' );

    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexao->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
} catch (PDOException $error) {
    echo "Codigo " . $error->getCode();
    echo "Mensagem " . $error->getMessage();
    echo "linha " . $error->getLine();
}

function retornaErro($mensagem)
{
    $retorno['status'] = false;
    $retorno['mensagem'] = $mensagem;

    echo json_encode($retorno);
    exit();
}

function retornaOK($mensagem)
{
    $retorno['status'] = true;
    $retorno['mensagem'] = $mensagem;

    echo json_encode($retorno);
    exit();
}

function validaCPF ($cpf){
    // Extrai somente os números
    $cpf = preg_replace( '/[^0-9]/is', '', $cpf );

    // Verifica se foi informado todos os digitos corretamente
    if (strlen($cpf) != 11) {
        return false;
    }

    // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    // Faz o calculo para validar o CPF
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
    }
    return true;
}
function validaTelefone($telefone)
{
    $regex = '/^(?:(?:\+|00)?(55)\s?)?(?:\(?([1-9][0-9])\)?\s?)?(?:((?:9\d|[2-9])\d{3})\-?(\d{4}))$/';

    if (preg_match($regex, $telefone) == false) {

        // O número não foi validado.
        return false;
    } else {

        // Telefone válido.
        return true;
    }
}

function validaEmail($email){
    //verifica se e-mail esta no formato correto de escrita
    if (!preg_match('^([a-zA-Z0-9.-_])*([@])([a-z0-9]).([a-z]{2,3})^',$email)){

        return false;
    }
    else{
        //Valida o dominio
        $dominio=explode('@',$email);
        if(!checkdnsrr($dominio[1],'A')){

            return false;
        }
        else{return true;} // Retorno true para indicar que o e-mail é valido
    }
}
