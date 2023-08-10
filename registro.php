<?php

if(isset($_POST)){

    //Conexion a la bd e inicio de session
    require_once ('includes/conexion.php');

    global $bd; //Hice global bd porque sino no me la tomaba en la query linea 63


    //Guardo los datos en variables
    //Uso  mysqli_real_escape_string() por si al poner un string, me ponen una comilla o apostrofe para tratar de
    //hacer una consulta al registrarse o lo pueden hackear
    //Uso trim al guardar el mail para que se guarde sin espacios y la password tambien
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($bd,$_POST['nombre']): false;
    $apellido = isset($_POST['apellido']) ?  mysqli_real_escape_string($bd,$_POST['apellido']): false;
    $email = isset($_POST['email']) ?  mysqli_real_escape_string($bd,trim($_POST['email'])): false;
    $password = isset($_POST['password']) ?  mysqli_real_escape_string($bd,trim($_POST['password'])): false;

    //Array de errores
    $errores = array();

    //Validar los datos antes de guardarlos en la base de datos

    //Valido el nombre
    if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/",$nombre)){
        $nombre_validado = true;
    }else{
        $nombre_validado = false;
        $errores['nombre'] = 'El nombre no es valido';
    }

    //Valido el apellido
    if(!empty($apellido) && !is_numeric($apellido) && !preg_match("/[0-9]/",$apellido)){
        $apellido_validado = true;
    }else{
        $apellido_validado = false;
        $errores['apellido'] = 'El apellido no es valido';
    }

    //Valido el email
    if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
        $email_validado = true;
    }else{
        $email_validado = false;
        $errores['email'] = 'El email no es valido';
    }

    //Valido la password
    if(!empty($password)){
        $password_validado = true;
    }else{
        $password_validado = false;
        $errores['password'] = 'El password no es valido';
    }

    $guardar_usuario = false;

    //Si no tengo errores ingreso los datos
    if(count($errores) == 0){
        $guardar_usuario = true;

        //Cifrar la contraseña del usuario antes de guardarla en la bd
        $password_segura = password_hash($password,PASSWORD_BCRYPT,['cost' => 4]);

        //Insertar el usuario en la bd
        $sql = "INSERT INTO usuarios VALUES (NULL, '$nombre', '$apellido', '$email', '$password_segura', CURDATE())";
        $query = mysqli_query($bd, $sql);

        //Esto lo hago despues de to-do porque quiero registrar un usuario pero me da error y no se porque
        // var_dump(mysqli_error($bd));
        // die();

        if($query){
            $_SESSION['completado'] = "El usuario se registro con exito";
        }else{
            $_SESSION['errores']['general'] = "Error al registrar el usuario";
        }
    }else{
        $_SESSION['errores'] = $errores;
    }
}
header('Location: index.php');