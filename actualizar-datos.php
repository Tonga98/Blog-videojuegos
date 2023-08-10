<?php
session_start();
require_once 'includes/redireccion.php';
if(isset($_POST)){

    //Conexion a la base de datos
    require_once 'includes/conexion.php';
    require_once 'includes/helpers.php';

    //Recibo los datos del formulario
    $nombre = !empty($_POST['nombre']) ? mysqli_real_escape_string($bd, $_POST['nombre']):null;
    $email = !empty($_POST['email']) ? mysqli_real_escape_string($bd, $_POST['email']):null;
    $apellido = !empty($_POST['apellido']) ? mysqli_real_escape_string($bd, $_POST['apellido']):null;

    //Creo array de errores
    $errores = array();

    //Obtengo id del usuario
    $id_usuario =  $_SESSION['usuario'] ['id'];

    //Actualizo email, 274 es filter_validate_email
    if(isset($email) && filter_var($email, 274)) {

        //Verifico si el email no esta registrado
        $sql = "SELECT email FROM usuarios WHERE email = '$email'";
        $query = mysqli_query($bd, $sql);

        if (mysqli_num_rows($query) == 0  || $email == $_SESSION['usuario']['email']) {
            $sql = "UPDATE usuarios SET email = '$email' WHERE id = $id_usuario";
            $query = mysqli_query($bd, $sql);
        }else{
            $errores['email'] = 'Error al actualizar el email';
        }
    }else{
        $errores['email'] = 'Error al actualizar el email';
    }

    //Actualizo Nombre
    if(isset($nombre) && !is_numeric($nombre)){

        //Actualizo el nombre en la base de datos
        $sql = "UPDATE usuarios SET nombre = '$nombre' WHERE id = $id_usuario";
        $query = mysqli_query($bd, $sql);

    }else{
        $errores['nombre'] = 'Error al actualizar el nombre';
    }

    //Actualizo Apellido
    if(isset($apellido) && !is_numeric($apellido)){

        $sql = "UPDATE usuarios SET apellido = '$apellido' WHERE id = $id_usuario";
        $query = mysqli_query($bd, $sql);

    }else{
        $errores['apellido'] = 'Error al actualizar el apellido';
    }

   if(count($errores) > 0){
       $_SESSION['errores_actualizar'] = $errores;
       header('Location: mis-datos.php');
   }else{
       actualizarSesion($bd);
       header('Location: index.php');
   }
}
