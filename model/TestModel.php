<?php
include_once 'Contato.class.php';
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
    //$pIdContato, $pNome, $pCategoria, $pQuantidade
    echo "<div>";
    $model = new Contato(1, 'Maçã', 'ALIMENTOS', 48);
    echo $model;
    echo "</div>";
    ?>
</body>

</html>