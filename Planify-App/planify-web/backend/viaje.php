<?php 
    include 'db.php';
    
    $nombreViaje = $_POST['nombre_viaje'];
    $fechaInicio = $_POST['fecha_inicio'];
    $fechaFin = $_POST['fecha_fin'];
    $estado = $_POST['estado'];

    $idUser = sesion_get('idUsuario');

    if($idUser) {

        $existe = consulta("SELECT nombre FROM VIAJE WHERE idUsuario = '$idUser' AND nombre = '$nombreViaje'");        
        if ($existe) {
            die("Error, ya existe un viaje con ese nombre.");
        }


        $sql = "INSERT INTO VIAJE (nombre, fechaInicio, fechaFin, estado, idUsuario) 
        VALUES ('$nombreViaje', '$fechaInicio', '$fechaFin', '$estado', $idUser)";
        
        if(ejecutar($sql)) {
            redirigir("../frontend/home.php");
        } else {
            echo "No se pudo insertar el viaje";
        }




    } else {
        redirigir("../frontend/login.php");
    }

    
?>