<link rel="stylesheet" href=<?php echo '"'.GlobalConfig::$DEFAULT_DIR.'/'.GlobalConfig::$DEFAULT_CSS_DIR.'/'.'header.css"' ?> >
<script src = <?php echo '"'.GlobalConfig::$DEFAULT_DIR.'/'.GlobalConfig::$DEFAULT_JS_DIR.'/'.'login.js"' ?>></script>
<div class="container-fluid d-flex justify-content-center bg-secondary position-relative">
    <h2 class="text-white">Sistema de Agenda de Contatos</h2>
    <?php
        session_start();
        if (isset($_SESSION['usuario'])) {
            $usuario = (object) $_SESSION['usuario'];
            echo '<div class="position-absolute top-0 right-0 d-flex">
                    <img src="../' . $usuario->caminho_foto . '" alt="Foto de perfil" class="img-perfil">
                    <span class="text-white align-self-center mr-2">' . $usuario->nome . '</span>
                    <button type="button" onclick="sairDoSistema()" class="btn btn-danger btn-sair-sistema">Sair do sistema</button>
                </div>';
        }
    ?>
</div>
