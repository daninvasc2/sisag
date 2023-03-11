<?php
    // configuracoes globais
    include_once './config/GlobalConfig.php';
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
    <style>
        main {
            background-image: url(<?php echo '"./'.GlobalConfig::$ASSETS_DIR.'/'.'bg-main-index.jpg"' ?>);            
            background-size: contain;
            background-repeat: no-repeat;
            min-height: 800px;             
        }
        @media screen and (min-width: 1024px) {
            main {
                background-image: url(<?php echo '"./'.GlobalConfig::$ASSETS_DIR.'/'.'bg-main-index.jpg"' ?>);
                background-size: cover;
                background-repeat: no-repeat;
            }
        }
    </style>

    <title>SisProd - Sistema Simples de Cadastro de Produtos</title>
</head>
<body>
    <header>
        <!-- Header include -->
        <?php include_once './view/header.php'?>
    </header>

    <main class="container-fluid" id="main-container">                
    </main>      

    <!-- Footer include -->
    <?php include_once './view/footer.php'?>
</body>
</html>