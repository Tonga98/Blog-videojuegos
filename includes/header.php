<?php
require_once 'conexion.php';
require_once 'helpers.php';
?>
<!DOCTYPE HTML>
<HTML lang = 'es'>
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Blog de videojuegos</title>
    <link rel="stylesheet" type="text/css" href="./assets/css/style.css"/>
</head>
<body>
<!--CABECERA-->
<header id="cabecera">
    <!--LOGO-->
    <div id="logo">
        <a href="index.php">
            Blog de videojuegos
        </a>
    </div>

    <!--MENU-->
    <nav id="menu">
        <ul>
            <li><a href="index.php" target="_self">Inicio</a> </li>
            <?php
            //Obtengo la tabla categorias
                $categorias = obtenerCategorias($bd);
                //La recorro
                while($categoria = mysqli_fetch_assoc($categorias)):
            ?>
                <li><a href="categoria.php?id=<?=$categoria['id']?>" target="_self"> <?=$categoria['nombre']?> </a> </li>

            <?php endwhile; ?>
            <li><a href="index.php" target="_self">Sobre mi</a> </li>
            <li><a href="index.php" target="_self">Contacto</a> </li>
        </ul>
    </nav>
    <div class="clearfix"></div>
</header>
<div id="contenedor">