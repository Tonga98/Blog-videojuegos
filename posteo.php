<?php require_once 'includes/header.php';
require_once 'includes/aside.php';

$post_id = isset($_GET['id']) ? $_GET['id'] : '';
$datos_posteo = mysqli_fetch_assoc(obtenerUnPosteo($post_id, $bd));

?>


<div id="principal">
    <h1> <?= $datos_posteo['titulo'] ?> </h1>

        <article class="entradas-unitaria">
            <span><?= $datos_posteo['nombre']." | ".$datos_posteo['fecha']?></span>
            <p>
                <?= $datos_posteo['descripcion'] ?>
            </p>
        </article>

    <?php if($datos_posteo['usuario_id'] == $_SESSION['usuario']['id']): ?>
        <a class="editar-post" href="editar-post.php?id=<?= $datos_posteo['id'] ?>">Editar Post</a>
        <a class="editar-post" href="borrar-post.php?id=<?= $datos_posteo['id'] ?>">Eliminar Post</a>
    <?php endif; ?>
</div>

