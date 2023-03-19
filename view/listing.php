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
    <link rel="stylesheet" href=<?php echo '"' . GlobalConfig::$DEFAULT_DIR . '/' . GlobalConfig::$DEFAULT_CSS_DIR . '/' . 'listing.css"' ?>>

    <!-- Bootstrap CDN CSS -->
    <?php echo GlobalConfig::$BOOTSTRAP_CSS_CDN ?>

    <title>Sistema de Agenda de Contatos</title>
</head>

<body>
    <header>
        <!-- Header include -->
        <?php include_once './header.php' ?>
        <div class="sub-header d-flex space-around">
            <h4>Contatos</h4>
            <a href="form-cad.php">
                <button type="button" class="btn btn-primary" id="btn-novo-contato">
                    <i class="fas fa-plus"></i> Cadastrar
                </button>
            </a>
        </div>
    </header>

    <main class="container-fluid" id="main-container">
        <table class="table" id="table-contatos" hidden>
            <thead>
                <tr>
                    <th scope="col">Foto de perfil</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Email</th>
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