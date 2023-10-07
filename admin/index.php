<?php session_start();
//archivo index del admin

require 'config.php';
require '../functions.php';

$conexion = conexion($bd_config);

ComprobarSession();

if (!$conexion){
    header('loaction:../error.php');
}

$posts = obtener_post($blog_config['post_por_pagina'], $conexion);

require '../views/admin_index.view.php'
?>