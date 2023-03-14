<div class="container-fluid d-flex justify-content-center bg-secondary position-relative">
    <h2 class="text-white">Sistema de Agenda de Contatos</h2>
    <?php
        if (isset($_SESSION['usuario'])) {
            echo '<div class="position-absolute top-0 end-0">
                    <button type="button" onclick="sairDoSistema()" class="btn btn-danger btn-sair-sistema">Sair do sistema</button>
                </div>';
        }
    ?>
</div>
