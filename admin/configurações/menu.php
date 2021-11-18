<?php

$query = $conexao->prepare("SELECT * FROM funcionario WHERE id_funcionario={$_SESSION['id']}");
$query->execute();

$linha = $query->fetchObject();

?>


<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <h3 class="text-light bg-dark">Sistema de Mudanças</h3>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <?php
            if ($_SESSION['valor_admin']==1):
                ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="https://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Funcionários</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown01">
                        <a class="dropdown-item" href="../funcionario/cadastro_funcionario.php">Cadastrar</a>
                        <a class="dropdown-item" href="../funcionario/listagem_funcionario.php">Ativos</a>
                        <a class="dropdown-item" href="../funcionario/funcionarios_banidos.php">Banidos</a>
                    </div>
                </li>
            <?php
            endif;
            ?>

            <?php
            if ($_SESSION['valor_admin']==0):
                ?>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="../perfil/perfil_funcionario.php">Perfil</a>
                </li>
            <?php
            endif;
            ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="https://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Motoristas</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">

                    <a class="dropdown-item" href="../motorista/listagem_motorista.php">Ativos</a>
                    <a class="dropdown-item" href="../motorista/motorista_banido.php">Banidos</a>
                    <a class="dropdown-item" href="../motorista/validar_motorista.php">Validar</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="//https://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Clientes</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="../cliente/listagem_cliente.php">Ativos</a>
                    <a class="dropdown-item" href="../cliente/cliente_banido.php">Banidos</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="https://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Estados</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="../estado/cadastro_estado.php">Cadastrar</a>
                    <a class="dropdown-item" href="../estado/listagem_estado.php">Listagem</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="https://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Cidades</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="../cidade/cadastro_cidade.php">Cadastrar</a>
                    <a class="dropdown-item" href="../cidade/listagem_cidade.php">Listagem</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" href="../orcamento/listagem_orcamento.php">Orçamentos</a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link" href="../proposta/listagem_proposta_orcamento.php" >Propostas</a>

            </li>
        </ul>
    </div>
    <h5 class="text-light">Usuário: <?php echo $linha->nome_funcionario?> </h5> &nbsp&nbsp&nbsp&nbsp&nbsp
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
