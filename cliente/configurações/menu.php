<?php

$query = $conexao->prepare("SELECT * FROM cliente WHERE id_cliente={$_SESSION['id']}");
$query->execute();

$linha = $query->fetchObject();

?>


<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <h3 class="text-light bg-dark">Sistema de Mudanças <small class="text-light"> </small></h3>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>


    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">

            <li class="nav-item dropdown">
                <a class="nav-link" href="../cliente/perfil_cliente.php">Perfil</a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="//https://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Endereço</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="../endereco/listagem_endereco.php">Listagem</a>
                    <a class="dropdown-item" href="../endereco/cadastro_endereco.php">Cadastro</a>
                </div>

            </li>


            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="//https://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Orçamento</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="../orcamento/listagem_orcamento.php">Listagem</a>
                    <a class="dropdown-item" href="../orcamento/cadastro_orcamento.php">Cadastro</a>
                </div>

            </li>

        </ul>
    </div>
    <h5 class="text-light">Usuário: <?php echo $linha->nome_cliente?> </h5> &nbsp&nbsp&nbsp&nbsp&nbsp

    </ul>
    <span class="navbar-text">

        <?php
       /* echo $_SESSION['motorista'];*/
        ?>
    </span>
    <div>
        <ul class="navbar-nav my-2 my-lg-0">
            <li class="nav-item">
                <a class="nav-link btn btn-outline-secondary" href="../configurações/sair.php">Sair</a>
    </div>
    </li>
    </ul>

</nav>
