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

    <title>Sistema de Agenda de Contatos - Cadastro</title>
</head>
<body>
    <header>
        <!-- Header include -->
        <?php include_once './header.php'?>
        <script src = <?php echo '"'.GlobalConfig::$DEFAULT_DIR.'/'.GlobalConfig::$DEFAULT_JS_DIR.'/'.'login.js"' ?>></script>
    </header>
    <div class="content flex-center mt-2">
        <form class="p-2 bordered" id="formCadastro">
            <div id="nomeContainer" class="form-group">
                <label for="nomeCadastro">Nome</label>
                <input type="text" class="form-control" name="nomeCadastro" id="nomeCadastro" placeholder="Nome">
            </div>
            <div class="form-group">
                <label for="loginCadastro">Login</label>
                <input type="text" autocomplete="login" class="form-control" name="loginCadastro" id="loginCadastro" placeholder="Login">
            </div>
            <div class="form-group">
                <label for="senhaCadastro">Senha</label>
                <input type="password" autocomplete="new-password" class="form-control" name="senhaCadastro" id="senhaCadastro" placeholder="Senha">
            </div>
            <div class="form-group">
                <label for="confirmarSenha">Confirmar Senha</label>
                <input type="password" class="form-control" autocomplete="" name="confirmarSenha" id="confirmarSenha" placeholder="Confirmar Senha">
            </div>
            <div class="form-group" id="fotoContainer">
                <label for="fotoCadastro">Foto</label>
                <input type="file" class="form-control" id="fotoCadastro" name="fotoCadastro" placeholder="Selecione a foto" accept="image/png, image/jpeg, image/jpg, image/webp">
            </div>
            <button onclick="fazerCadastro()" id="btnEntrar" type="button" class="btn btn-block btn-primary">Cadastrar</button>
            <input type="hidden" name="_acao" value="cadastrar">
            <span>Já possui uma conta? <a href=<?php echo '"'.GlobalConfig::$DEFAULT_DIR.'/view/login.php"' ?>>Faça login</a></span>
        </form>
    </div>

    <!-- Footer include -->
    <?php include_once  './footer.php'?>
</body>