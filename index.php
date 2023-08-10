<?php require_once 'includes/header.php';
require_once 'includes/aside.php'; ?>

    <!--CAJA PRINCIPAL-->
    <div id="principal">
        <h1>Ultimos post</h1>

        <?php
            $posteos = obtenerPosteos($bd);
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

        <div id="ver-todas">
            <a href="ver-todos-post.php">Ver todos los post</a>
        </div>

    </div> <!--Fin principal-->

    <!--PIE DE PAGINA-->
<?php require_once 'includes/footer.php'; ?>