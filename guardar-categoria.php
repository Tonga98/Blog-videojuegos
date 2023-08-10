<?php
if((isset($_POST))) {
    //Conexion a la bd
    require_once 'includes/conexion.php';

    // mysqli_real_escape_string = Para limpiar caracteres raros y evitar inyecciones de sql en la consulta
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($bd,$_POST['nombre']):false;

    //Array de errores
    $errores = array();

    //Validar los datos antes de guardarlos en la base de datos

    //Valido el nombre
    if(!empty($nombre) && !is_numeric($nombre) && !preg_match("[0-9]",$nombre)){

        //Inserto la categoria nueva
        $sql = "INSERT INTO categorias VALUES(NULL,'$nombre')";
        $query = mysqli_query($bd, $sql);

    }else{
        $errores['nombre'] = 'El nombre no es valido';
    }
}
header('Location: index.php');
?>
