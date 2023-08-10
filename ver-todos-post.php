<?php
require_once 'includes/header.php';
require_once 'includes/aside.php';
?>

<div id="principal">
    <h1>Todos los cuentos</h1>

    <?php
    $posteos = obtenerTodosPosteos($bd);
    while ($posteo = mysqli_fetch_assoc($posteos)):
        ?>
        <article class="entradas">
            <h2><a href="posteo.php?id=<?= $posteo['id'] ?>"><?= $posteo['titulo']?></a></h2>
            <span><?= $posteo['nombre']." | ".$posteo['fecha']?></span>
            <p>
                <?=substr($posteo['descripcion'],0,300).'...' ?>
            </p>
        </article>
    <?php endwhile; ?>
</div>
