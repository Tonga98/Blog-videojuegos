<!-- El siguiente es codigo javascript que siempre va dentro de las etiquetas script para indicar que es codigo javascript
 el codigo javascript se ejecuta del lado del cliente, php se ejecuta del lado del servidor-->

<!-- Con   var passwordInput = document.getElementById("password"); obtengo una referncia al input de html con el id
password entonces luego las modificaciones que le hago a la variable tambien se las hago al input del html pero del
lado del cliente-->

<!-- No me aparece el boton porque borre los .css de fontawesome-->
<script>
    function mostrarContrasenia() {
        var passwordInput = document.getElementById("password");
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }
    }
</script>

<script>
    function cambiarEstilo(){

        //Obtengo el select entero
        var editorFuente = document.getElementById("font-select");


        //Obtengo el text-area
        var fuenteActual = document.getElementById("Descripcion");

        if(editorFuente.value !== fuenteActual.style.fontFamily){
            fuenteActual.style.fontFamily = editorFuente.value;
        }
    }
</script>

<?php
function mostrarError($errores, $campo){
    //Este modulo retorna el error del campo recibido
    //$error: Se refiere al arreglo que contiene los errores que hayan surgido
    //$campo: Se refiere al campo en el cual hay que buscar si hay error

    //Declaracion de variables
    $error = '';

    //Asignacion de variables y ejecucion
    if(isset($errores[$campo])){
        $error = "<div class='alerta alerta-error'>".$errores[$campo]."</div>";
    }
    return $error;
}

function borrarErrores(){
    $_SESSION['errores'] = null;
    $_SESSION['completado'] = null;
    $_SESSION['error_login'] = null;
    $_SESSION['error_post'] = null;
    $_SESSION['errores_actualizar'] = null;
    return true;
}

function obtenerCategorias($bd){
    $sql = "SELECT * FROM categorias";
    $categorias = mysqli_query($bd, $sql);
    $resultado = array();

    if($categorias && mysqli_num_rows($categorias) >= 1){
        $resultado = $categorias;
    }
    return $resultado;
}

function obtenerPosteos($bd){
    $sql = "SELECT p.*, c.nombre FROM posteos p ".
           "INNER JOIN categorias c on p.categoria_id = c.id ".
           "ORDER BY fecha DESC LIMIT 4";
    $posteos = mysqli_query($bd,$sql);
    $resultado = array();
    if($posteos && mysqli_num_rows($posteos) >= 1){
        $resultado = $posteos;
    }
    return $resultado;
}
function obtenerTodosPosteos($bd){
    $sql = "SELECT p.*, c.* FROM posteos p ".
        "INNER JOIN categorias c on p.categoria_id = c.id ".
        "ORDER BY fecha DESC";
    $posteos = mysqli_query($bd,$sql);
    $resultado = array();
    if($posteos && mysqli_num_rows($posteos) >= 1){
        $resultado = $posteos;
    }
    return $resultado;
}
function actualizarSesion($bd){
    //Este modulo actualiza los datos de la sesion del usuario cuando se modifican en mis-datos.php

    //Obtengo los datos de la base de datos
    $id_usuario = $_SESSION['usuario'] ['id'];
    $sql = "SELECT * FROM usuarios WHERE id = '$id_usuario'";

    $query = mysqli_query($bd, $sql);

    $datos_usuario = mysqli_fetch_assoc($query);

    $_SESSION['usuario'] = $datos_usuario;
}
function obtenerNombreCategoria($categoria_id, $bd){
    $sql = "SELECT nombre FROM categorias WHERE id = '$categoria_id'";
    $query = mysqli_query($bd, $sql);
    $categoria = mysqli_fetch_assoc($query);
    $nombre = $categoria['nombre'];
    return $nombre;
}
function obtenerPosteosCategoria($categoria_id, $bd){
    $sql = "SELECT p.*, c.nombre FROM posteos p ".
        "INNER JOIN categorias c on p.categoria_id = c.id ".
        "WHERE c.id = $categoria_id ".
        "ORDER BY fecha DESC";
    $posteos = mysqli_query($bd,$sql);
    $resultado = array();
    if($posteos && mysqli_num_rows($posteos) >= 1){
        $resultado = $posteos;
    }
    return $resultado;
}
function obtenerUnPosteo($posteo_id, $bd){
    $sql = "SELECT p.*, c.nombre FROM posteos p ".
        "INNER JOIN categorias c on p.categoria_id = c.id ".
        "WHERE p.id = $posteo_id ";
    $posteos = mysqli_query($bd,$sql);
    $resultado = "";
    if($posteos && mysqli_num_rows($posteos) >= 1){
        $resultado = $posteos;
    }
    return $resultado;
}
function buscarPosteos($bd, $titulo){
    //Este modulo busca los posteos que contengan a titulo

    $titulo_limpio = str_replace(" ", "", $titulo);
    $titulo_limpio = strtolower($titulo_limpio);
    $titulo_limpio = mysqli_real_escape_string($bd, $titulo_limpio);

    $sql = "SELECT p.*, c.nombre FROM posteos p ".
        "INNER JOIN categorias c on p.categoria_id = c.id ".
        "WHERE  LOWER(REPLACE(p.titulo, ' ', '')) LIKE '%$titulo_limpio%'";
    $posteos = mysqli_query($bd,$sql);
    $resultado = "";
    if($posteos && mysqli_num_rows($posteos) >= 1){
        $resultado = $posteos;
    }
    return $resultado;

}

