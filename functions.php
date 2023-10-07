<?php

function conexion($bd_config){
	try {
	$conexion = new PDO('mysql:host=localhost;dbname='.$bd_config['basedatos'], $bd_config['usuario'], $bd_config['pass']);

		return $conexion;

	} catch (PDOException $e) {
		return false;		
	}
}

    function limpiarDatos($datos){
        $datos = trim($datos);
        $datos = stripslashes($datos);
        $datos = htmlspecialchars($datos);
        return $datos;
    };

    function pagina_actual(){
        return isset($_GET['p']) ? (int)$_GET['p'] : 1;
    }

    function obtener_post($post_por_pagina, $conexion){
        //1.- Obtenemos la pagina actual
        // $pagina_actual = isset($_GET['p']) ? (int)$_GET['p']: 1;
        // Para reutilizar el codigo creamos una funcion que nos dice la pagina actual.
    
        //2.- Determinamos desde que post se mostrara en pantalla
        $inicio = (pagina_actual() > 1) ? (pagina_actual() * $post_por_pagina - $post_por_pagina) : 0;
    
        //3.- Preparamos nuestra consulta trayendo la informacion e indicandole desde donde y cuantas filas.
        // Ademas le pedimos que nos cuente cuantas filas tenemos.
        $sentencia = $conexion->prepare("SELECT SQL_CALC_FOUND_ROWS * FROM articulos LIMIT {$inicio}, {$post_por_pagina}");
    
        $sentencia->execute();
        return $sentencia->fetchAll();
    }

    function numero_paginas($post_por_pagina, $conexion){
        //4.- Calculamos el numero de filas / articulos que nos devuelve nuestra consulta
        $total_post = $conexion->prepare('SELECT FOUND_ROWS() as total');
        $total_post->execute();
        $total_post = $total_post->fetch()['total'];
    
        //5. Calculamos el numero de paginas que habra en la paginacion
        $numero_paginas = ceil($total_post / $post_por_pagina);
        return $numero_paginas;
    }

    function id_articulo($id){
        return (int)limpiarDatos($id);
    }

    function obtener_post_por_id($conexion, $id){
        $resultado = $conexion->query("SELECT * FROM articulos WHERE id = $id LIMIT 1");
        $resultado = $resultado->fetchAll();
        return ($resultado) ? $resultado : false;
    }

    function fecha($fecha){
        $timestamp = strtotime($fecha);
        $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    
        $dia = date('d', $timestamp);
    
        // -1 porque los meses en la funcion date empiezan desde el 1
        $mes = date('m', $timestamp) - 1;
        $year = date('Y', $timestamp);
    
        $fecha = $dia . ' de ' . $meses[$mes] . ' del ' . $year;
        return $fecha;
    }

    function ComprobarSession(){
        if(!isset($_SESSION['admin'])){
            header('Location:' . RUTA);
        }
    }




  

?>