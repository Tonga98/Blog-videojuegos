<?php
session_start();
require_once 'includes/redireccion.php';
require_once 'includes/conexion.php';

$post_id = !empty($_GET['id']) ? $_GET['id']:null;
$usuario_id = $_SESSION['usuario']['id'];

if (isset($post_id)){
    $sql = "DELETE FROM posteos WHERE id=$post_id AND usuario_id=$usuario_id";
    $query = mysqli_query($bd, $sql);
    header('Location: index.php');
}