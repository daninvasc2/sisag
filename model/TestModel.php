<?php
    include_once 'Produto.class.php';    
?>
<html> 
    <head>
        <title>Home Page</title>
        <style>
            div {
                font-family: Arial, Helvetica, Sans-Serif;
                line-height: 1.5em;
                width: 500px;
                border: 1px solid gray;
                margin: 0 auto;
                padding: 20px;
            }
        </style>
    </head>
    <body>
        <?php
            //$pIdProduto, $pNome, $pCategoria, $pQuantidade            
            echo "<div>";
                $model = new Produto(1, 'Maçã', 'ALIMENTOS', 48);                
                echo $model;                
            echo "</div>";
        ?>
    </body>
</html>