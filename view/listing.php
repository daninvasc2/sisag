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
    <link rel="icon" href=<?php echo '"' . GlobalConfig::$DEFAULT_DIR . '/' . GlobalConfig::$ASSETS_DIR . '/' . 'favico.ico"'; ?>>

    <!-- CSS Global -->
    <link rel="stylesheet" href=<?php echo '"' . GlobalConfig::$DEFAULT_DIR . '/' . GlobalConfig::$DEFAULT_CSS_DIR . '/' . 'global.css"' ?>>

    <!-- Bootstrap CDN CSS -->
    <?php echo GlobalConfig::$BOOTSTRAP_CSS_CDN ?>

    <title>Sistema de Agenda de Contatos</title>
</head>

<body>
    <header>
        <!-- Header include -->
        <?php include_once './header.php' ?>
    </header>

    <main class="container-fluid" id="main-container">
        <table class="table" id="table-products" hidden>
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </main>

    <!-- Modal Aguardar -->
    <?php include_once './ModalAguardar.php' ?>

    <!-- Footer include -->
    <?php include_once './footer.php' ?>

    <!-- JS Listagem de contatos -->
    <script src=<?php echo '"' . GlobalConfig::$DEFAULT_DIR . '/' . GlobalConfig::$DEFAULT_JS_DIR . '/' . 'listagem-contatos.js"' ?>>
    </script>
</body>

</html>