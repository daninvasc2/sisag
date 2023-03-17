<?php
    // configuracoes globais
    include_once '../config/GlobalConfig.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon -->
    <link rel="icon" href=<?php echo '"'.GlobalConfig::$DEFAULT_DIR.'/'.GlobalConfig::$ASSETS_DIR.'/'.'favico.ico"'; ?> >   

    <!-- CSS Global -->
    <link rel="stylesheet" href=<?php echo '"'.GlobalConfig::$DEFAULT_DIR.'/'.GlobalConfig::$DEFAULT_CSS_DIR.'/'.'global.css"' ?> >    

    <!-- Bootstrap CDN CSS -->    
    <?php echo GlobalConfig::$BOOTSTRAP_CSS_CDN ?>

    <title>Sistema de Agenda de Contatos - Login</title>
</head>
<body>
    <header>
        <!-- Header include -->
        <?php include_once './header.php'?>
        <script src = <?php echo '"'.GlobalConfig::$DEFAULT_DIR.'/'.GlobalConfig::$DEFAULT_JS_DIR.'/'.'login.js"' ?>></script>
    </header>
    <div class="content flex-center mt-2">
        <form class="p-2 bordered">
            <div class="form-group">
                <label for="login">Login</label>
                <input type="text" autocomplete="login" class="form-control" name="login" id="login" placeholder="Login">
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" autocomplete="current-password" class="form-control" name="senha" id="senha" placeholder="Senha">
            </div>
            <button onclick="fazerLogin()" id="btnEntrar" type="button" class="btn btn-block btn-primary">Entrar</button>
            <button onclick="preparaCadastro()" id="btnCadastrar" type="button" class="btn btn-block btn-secondary">Cadastre-se</button>
        </form>
    </div>

    <!-- Footer include -->
    <?php include_once  './footer.php'?>
</body>