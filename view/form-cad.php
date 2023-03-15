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
        <form id="form-cad-prod">
            <div class="form-group">
                <label for="input-name">Nome</label>
                <input type="text" class="form-control" id="input-name" name="nome" required
                    placeholder="Informe o nome">
            </div>
            <div class="form-group">
                <label for="input-phone">Telefone</label>
                <input type="text" class="form-control" id="input-phone" required name="telefone"
                    placeholder="Informe o telefone" onkeypress="return isNumber(event)">
            </div>
            <div>
                <label for="input-email">Email</label>
                <input type="text" class="form-control" id="input-email" required name="email"
                    placeholder="Informe o email">
            </div>
            <div>
                <label for="input-image">Foto</label>
                <input type="file" class="form-control" id="input-image" required name="foto"
                    placeholder="Selecione a foto" accept="image/png, image/jpeg, image/jpg, image/webp">
            </div>
            <button type="submit" class="btn btn-primary mt-2">Cadastrar</button>
            <input hidden type="text" name="_acao" value="cadastrar">
        </form>
    </main>
    <!-- Modal Result -->
    <?php include_once './ModalResult.php' ?>

    <!-- Modal Aguardar -->
    <?php include_once './ModalAguardar.php' ?>

    <!-- Footer include -->
    <?php include_once './footer.php' ?>
    <!-- JS Cadastro de Contatos -->
    <script src=<?php echo '"' . GlobalConfig::$DEFAULT_DIR . '/' . GlobalConfig::$DEFAULT_JS_DIR . '/' . 'cadastro-contatos.js"' ?>>
    </script>

</body>

</html>