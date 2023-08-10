<?php

if(isset($_POST)){

    require_once 'includes/conexion.php';

    // mysqli_real_escape_string = Para limpiar caracteres raros y evitar inyecciones de sql en la consulta
    $titulo = isset($_POST['Titulo']) ? mysqli_real_escape_string($bd,$_POST['Titulo']) : false;
    $descripcion = isset($_POST['Descripcion']) ? mysqli_real_escape_string($bd, $_POST['Descripcion']) : false;
    $categoria_id = isset($_POST['categoria']) ? (int)$_POST['categoria'] : false;
    $post_id = isset($_POST['post_id']) ? (int)$_POST['post_id'] : false;

    $usuario_id = $_SESSION['usuario']['id'];

    //Guardo los valores en la base de datos
    if(!empty($titulo) && !empty($descripcion)){

        //Actualizo el post
        $sql = "UPDATE posteos ".
               "SET categoria_id=$categoria_id, descripcion='$descripcion', titulo='$titulo'".
               " WHERE id=$post_id AND usuario_id=$usuario_id";
        $query = mysqli_query($bd, $sql);

        //To do bien entonces redirecciono
        header('Location: Posteo.php?id='.$post_id);
    }else{
        $_SESSION['error_post'] = "Titulo o Descripcion invalidos";
        header('Location: editar-post.php?id='.$post_id);
    }
}

