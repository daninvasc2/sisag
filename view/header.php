<div class="container-fluid d-flex justify-content-center bg-secondary">
            <h2 class="text-white">Sistema Simples de Cadastro de Produtos</h2>
        </div>

        <div class="container-fluid" id="container-nav">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href=<?php echo '"'.GlobalConfig::$DEFAULT_DIR.'/index.php'.'"';?>>SisProd</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">                        
                            <a class="nav-link" href=<?php echo '"'.GlobalConfig::$DEFAULT_DIR.'/view/form-cad.php'.'"';?>>Cadastrar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href=<?php echo '"'.GlobalConfig::$DEFAULT_DIR.'/view/listing.php'.'"';?>>Listar</a>
                        </li>
                    </ul>
                </div>
            </nav>    
        </div>
