<?php

if(isset($_POST)){

    require_once 'includes/conexion.php';

    // mysqli_real_escape_string = Para limpiar caracteres raros y evitar inyecciones de sql en la consulta
     $titulo = isset($_POST['Titulo']) ? mysqli_real_escape_string($bd,$_POST['Titulo']) : false;
     $descripcion = isset($_POST['Descripcion']) ? mysqli_real_escape_string($bd, $_POST['Descripcion']) : false;
     $categoria_id = isset($_POST['categoria']) ? (int)$_POST['categoria'] : false;


    //Guardo los valores en la base de datos
    if(!empty($titulo) && !empty($descripcion)){
        //Obtengo id del usuario
        $id_usuario = $_SESSION['usuario']['id'];

        //Guardo el post
        $sql = "INSERT INTO posteos VALUES(null, $id_usuario, $categoria_id, '$titulo', '$descripcion', CURDATE())";
        $query = mysqli_query($bd, $sql);

        //To do bien entonces redirecciono
        header('Location: index.php');
    }else{
        $_SESSION['error_post'] = "Titulo o Descripcion invalidos";
        header('Location: crear-post.php');
        die();
    }
}

