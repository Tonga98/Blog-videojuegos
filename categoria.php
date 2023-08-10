<?php require_once 'includes/header.php';
require_once 'includes/aside.php';

$categoria_id = isset($_GET['id']) ? $_GET['id'] : '';

$categoria_nombre = obtenerNombreCategoria($categoria_id, $bd);?>

<div id="principal">
    <h1><?= $categoria_nombre ?> </h1>

<?php
    $obtener_posteos = obtenerPosteosCategoria($categoria_id, $bd);

    if(!empty($obtener_posteos)):
        while ($posteo = mysqli_fetch_assoc($obtener_posteos)):?>

        <article class="entradas">
            <h2><a href="posteo.php?id=<?= $posteo['id'] ?>"><?= $posteo['titulo']?></a></h2>
            <span><?= $posteo['nombre']." | ".$posteo['fecha']?></span>
            <p>
                <?=substr($posteo['descripcion'],0,300).'...' ?>
            </p>
        </article>

        <?php endwhile; ?>
    <?php else:?>
    <h2 class="sin-posteos"> <?= "Todavia sin posteos!" ?></h2>
    <?php endif;?>

</div>