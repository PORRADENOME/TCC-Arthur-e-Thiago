<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>Login - Administrador e Funcionário</title>
    <?php include "../configurações/conexao.php";
    include "../configurações/bootstrap.php";
    ?>
    <style>
        .form-signin {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: auto;
    </style>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/sign-in/">



    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Custom styles for this template -->
</head>
<body class="text-center">
<form class="jsonForm form-signin" action="VerificaSenha.php" method="post">
    <h1 class="h3 mb-3 font-weight-normal">Login - Administrador e Funcionário</h1>
    <label for="email_funcionario" class="sr-only">Email</label>
    <input type="text" id="email_funcionario" name="email_funcionario" class="form-control" placeholder="Email" required autofocus>
    <label for="senha_funcionario" class="sr-only">Senha</label>
    <input type="password" id="senha_funcionario" class="form-control" name="senha_funcionario" placeholder="Senha" required>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Acessar</button>

    <p></p>
</form>

<script>
    $(document).ready(function () {
        $(' .jsonForm ').ajaxForm({
            dataType: 'json',
            success: function (data) {
                if (data.status==true){
                    iziToast.success({
                        message: data.mensagem,
                        timeout: 1000,
                        onClosing: function(){

                                window.location.assign("http://localhost:85/perfil/perfil_funcionario.php");

                        }
                    });
                    $('.jsonForm').trigger('reset');
                }else{
                    iziToast.error({
                        message: data.mensagem
                    });
                }
            },
            error: function (data) {
                iziToast.error({
                    message: 'Servidor retornou erro'
                });
            }
        });
    });
</script>

</body>
</html>
