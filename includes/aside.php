<?php require_once 'helpers.php'; ?>

<!--BARRA LATERAL-->
<aside id="sidebar">

    <div id="buscador" class="bloque">
        <h3>Buscar</h3>

        <form action="./buscar.php" method="POST">

            <input type="text" id="busqueda" name="busqueda" >

            <input type="submit" value="Buscar">
        </form>

    </div>

    <?php if(isset($_SESSION['usuario'])): ?>
    <div class="bloque" id="login_correcto">
        <h3> <?= $_SESSION['usuario']['nombre'].' '. $_SESSION['usuario']['apellido']?> </h3>
        <!--BOTONES-->
         <a href="cerrar.php" class="boton">Cerrar sesion</a>
         <a href="crear-post.php" class="boton">Crear post</a>
         <a href="crear-categoria.php" class="boton">Crear categoria</a>
         <a href="mis-datos.php" class="boton">Mis datos</a>

    </div>
    <?php endif; ?>

    <?php if(!isset($_SESSION['usuario'])): ?>
    <div id="login" class="bloque">
        <h3>Identificate</h3>
        <form action="./login.php" method="post">

            <label for="email">Email</label>
            <input type="email" id="email" name="email" >

            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" >

            <!-- Agrega un botón o un icono para mostrar/ocultar la contraseña -->
            <span class="mostrar-contrasenia" onclick="mostrarContrasenia()">
                <i class="fad fa-eye-slash"></i>
            </span>

            <?php if(isset($_SESSION['error_login'])): ?>
            <div class="alerta">
            <?= $_SESSION['error_login']?>
            </div>
            <?php endif; ?>

            <input type="submit" value="Entrar">
        </form>

    </div>

    <div id="register" class="bloque">
        <h3>Registrate</h3>

        <!--Muestro error si no se pudo registrar el usuario o completado si todo ok -->
        <?php if(isset($_SESSION['completado'])): ?>
        <div class="alerta alerta-exito">
            <?= $_SESSION['completado'] ?>
        </div>
        <?php elseif(isset($_SESSION['errores']['general'])): ?>
        <div class="alerta alerta-error">
            <?= $_SESSION['errores']['general']?>
        </div>
        <?php endif; ?>

        <form action="./registro.php" method="post">

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required="required">

            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" pattern="^[A-Za-z]+$">
            <?= isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'nombre') :'' ?>

            <label for="apellido">Apellido</label>
            <input type="text" id="apellido" name="apellido" required="required" pattern="^[A-Za-z]+$">
            <?= isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'apellido') : ''?>

            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required="required" minlength="6">
            <?= isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'],'password') : '' ?>

            <input type="submit" value="Registrar" name="submit">
        </form>

    </div>
    <?php endif; ?>

    <!-- Si tengo error al guardar un post -->
    <?php if(isset($_SESSION['error_post'])): ?>
    <div class="alerta">
        <?= $_SESSION['error_post'] ?>
    </div>
    <?php endif; ?>

    <!-- Si tengo error al actualizar mis datos  -->
    <?php if(!isset($_SESSION['errores_actualizar'])): ?>
     <?php borrarErrores(); endif;  ;?>

</aside>