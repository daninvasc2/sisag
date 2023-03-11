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

    <title>SisProd - Sistema Simples de Cadastro de Produto</title>
</head>
<body>
    <header>
        <!-- Header include -->
        <?php include_once './header.php'?>
    </header>

    <main class="container-fluid" id="main-container">        
        <form id="form-cad-prod">
                <div class="form-group">
                    <label for="input-name">Nome produto</label>
                    <input type="text" class="form-control" id="input-name" name="nome" required placeholder="Informe o nome do produto">                
                </div>
                <div class="form-group">
                    <label for="input-category">Categoria</label>
                    <select class="form-control" id="select-category" name="categoria">
                        <option value="selecione" selected>SELECIONE</option>
                        <option value="ALIMENTOS">ALIMENTOS</option>
                        <option value="BEBIDAS">BEBIDAS</option>
                        <option value="HIGIENE">HIGIENE</option>
                        <option value="LIMPEZA">LIMPEZA</option>
                        <option value="OUTROS">OUTROS</option>
                    </select>                
                </div>
                <div class="form-group">
                    <label for="input-quantity">Quantidade</label>
                    <input type="text" class="form-control" id="input-quantity" required name="quantidade" placeholder="Informe a quantidade" onkeypress="return isNumber(event)">
                </div>
                <button type="submit" class="btn btn-primary">Cadastrar</button>
                <input hidden type="text" name="_acao" value="cadastrar">
            </form>
    </main>      
    <!-- Modal Result -->
    <?php include_once './ModalResult.php'?>

    <!-- Modal Aguardar -->
    <?php include_once './ModalAguardar.php'?>
    
    <!-- Footer include -->
    <?php include_once  './footer.php'?>
    <!-- JS Cadastro de Produtos -->
    <script src = <?php echo '"'.GlobalConfig::$DEFAULT_DIR.'/'.GlobalConfig::$DEFAULT_JS_DIR.'/'.'cadastro-produtos.js"' ?>></script>

</body>
</html>


