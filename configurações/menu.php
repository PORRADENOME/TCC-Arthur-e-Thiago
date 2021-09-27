<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a class="navbar-brand" href="../produto/listagem.php">Sistema de vendas</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">


            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="https://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Produtos</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="../produto/cadastro_produto.php">Cadastrar</a>
                    <a class="dropdown-item" href="../produto/listagem_produto.php">Listagem</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="https://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Motorista</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="../motorista/cadastro_motorista.php">Cadastrar</a>
                    <a class="dropdown-item" href="../motorista/listagem_motorista.php">Listagem</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="https://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Clientes</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="../cliente/cadastro_cliente.php">Cadastrar</a>
                    <a class="dropdown-item" href="../cliente/listagem_cliente.php">Listagem</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="https://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Serviços</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="../servico/cadastro_servico.php">Cadastrar</a>
                    <a class="dropdown-item" href="../servico/listagem_servico.php">Listagem</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="https://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Atendente</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="../atendente/cadastro_atendente.php">Cadastrar</a>
                    <a class="dropdown-item" href="../atendente/listagem_atendente.php">Listagem</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="https://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">atendimento</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="../atendimento/formCadastrar.php">Cadastrar</a>
                    <a class="dropdown-item" href="../atendimento/index.php">Listagem</a>
                </div>
            </li>
        </ul>
    </div>

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
