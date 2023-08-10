<?php
require_once 'includes/header.php';
require_once 'includes/aside.php';
require_once 'includes/redireccion.php';

$nombre = $_SESSION['usuario']['nombre'];
$apellido = $_SESSION['usuario']['apellido'];
$email = $_SESSION['usuario']['email'];
$password = $_SESSION['usuario']['password'];
?>

<div id="principal">
    <h1> Mis datos </h1>

    <form action="./actualizar-datos" method="post" >

        <label for="email" class="mis-datos">Email</label>
        <input type="email" id="email" name="email" value="<?= $_SESSION['usuario']['email']?>">
        <?= isset($_SESSION['errores_actualizar']) ? mostrarError($_SESSION['errores_actualizar'],'email') :'' ?>

        <label for="nombre" class="mis-datos">Nombre</label>
        <input type="text" id="nombre" name="nombre" pattern="^[A-Za-z]+$"  value="<?= $_SESSION['usuario']['nombre']?>">
        <?= isset($_SESSION['errores_actualizar']) ? mostrarError($_SESSION['errores_actualizar'],'nombre') :'' ?>

        <label for="apellido" class="mis-datos">Apellido</label>
        <input type="text" id="apellido" name="apellido" pattern="^[A-Za-z]+$"  value="<?= $_SESSION['usuario']['apellido']?>">
        <?= isset($_SESSION['errores_actualizar']) ? mostrarError($_SESSION['errores_actualizar'],'apellido') : ''?>

        <input type="submit" value="Actualizar datos" name="submit">
    </form>

</div>

<?php borrarErrores(); ?>

    <!--PIE DE PAGINA-->
<?php require_once 'includes/footer.php'; ?>