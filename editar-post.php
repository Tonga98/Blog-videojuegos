<?php require_once 'includes/header.php';
require_once 'includes/aside.php';

$post_id = isset($_GET['id']) ? $_GET['id'] : '';
$datos_posteo = mysqli_fetch_assoc(obtenerUnPosteo($post_id, $bd));
?>

<div id="principal">
    <h1>Editar post</h1>

    <form action="actualizar-post.php" method="post">

        <!-- Agrego un campo oculto para enviar el ID del post -->
        <input type="hidden" name="post_id" value="<?= $post_id ?>">

        <label for="Titulo">  Titulo  </label>
        <input type="text" name="Titulo" id="Titulo" value="<?= $datos_posteo['titulo']?>">

        <label for="Descripcion">  Descripcion  </label>
        <textarea name="Descripcion" id="Descripcion"> <?= $datos_posteo['descripcion']?></textarea>

        <!-- Select de categoria -->
        <div class="selects-container">

            <div class="select-container">
                <label for="select-categoria">Categoría</label>
                <select id="select-categoria" class="select-categoria" name="categoria">
                    <?php
                    $categorias = obtenerCategorias($bd);

                    while($categoria = mysqli_fetch_assoc($categorias)):
                        ?>
                        <option value="<?=$categoria['id']?>">
                            <?=$categoria['nombre'];?>
                        </option>
                    <?php endwhile;?>
                </select>
            </div>

            <!-- select de fuente -->
            <div class="select-container">
                <label for="font-select">Fuente</label>
                <select id="font-select" onclick="cambiarEstilo()" class="select-fuente">
                    <option value="Arial">Arial</option>
                    <option value="Times New Roman">Times New Roman</option>
                    <option value="Georgia">Georgia</option>
                </select>
            </div>
        </div>



        <input type="submit" value="Actualizar post" id="crear-post">

    </form>

</div>
