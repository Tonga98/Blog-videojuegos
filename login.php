<?php
if(isset($_POST)){

    //Conecto a la bd e inicio sesion
    require_once ('includes/conexion.php');

    //Traigo la variable q hice global de la conexion
    global $bd;

    //Guardo los datos en las variables con trim para sacar espacios
    $password = isset($_POST['password']) ? trim($_POST['password']) : false;
    $mail = isset($_POST['email']) ? trim($_POST['email']) : false;

    //Consulta para verificar las credenciales del usuario
    $sql = "SELECT * FROM usuarios WHERE email = '$mail'";
    $login = mysqli_query($bd, $sql);

    if($login && mysqli_num_rows($login) == 1){

        //$usuario ahora es un array asociativo con los datos del usuario
        $usuario = mysqli_fetch_assoc($login);

        //Compruebo la password
        if(password_verify($password,$usuario['password'])){

            //Guardo los datos del usuario en una sesion
            $_SESSION['usuario'] = $usuario;

        }else{
            $_SESSION['error_login'] = 'Login incorrecto!';
        }
    }else
        $_SESSION['error_login'] = 'Login incorrecto!';
}
header('Location: index.php');