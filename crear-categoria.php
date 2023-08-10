<?php
require_once 'includes/header.php';
require_once 'includes/aside.php';
require_once 'includes/redireccion.php';
?>

<div id="principal">
    <h1>Crear Categoria</h1>
    <form method="post" action="guardar-categoria.php">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" pattern="[a-zA-Z]+">
        <input type="submit" value="Guardar">
    </form>
</div>
<?php require_once 'includes/footer.php';