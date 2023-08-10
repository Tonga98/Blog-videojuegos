<?php
if(empty($_POST['busqueda'])){
    header('Location: index.php');
}
require_once 'includes/header.php';
require_once 'includes/aside.php';


$posteos = buscarPosteos($bd, $_POST['busqueda']);?>

<div id="principal">
    <h1><?= 'Busqueda: '.$_POST['busqueda']  ?> </h1>

    <?php

    if(!empty($posteos)):
        while ($posteo = mysqli_fetch_assoc($posteos)):?>
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
