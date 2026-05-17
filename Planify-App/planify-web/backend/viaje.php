<?php 
    session_start(); 
    include 'db.php';
    
    $nombreViaje = $_POST['nombre_viaje'];
    $fechaInicio = $_POST['fecha_inicio'];
    $fechaFin = $_POST['fecha_fin'];
    $estado = $_POST['estado'];
    $pais = $_POST['pais'];
    $idUser = sesion_get('idUsuario');

    if($idUser) {
        $existe = consulta("SELECT nombre FROM VIAJE WHERE idUsuario = '$idUser' AND nombre = '$nombreViaje'");        
        if ($existe) {
            die("Error, ya existe un viaje con ese nombre.");
        }

        $paisId = consulta("SELECT idPais FROM PAIS WHERE nombre = '$pais'");
        if (!$paisId) {
            $sqlPais = "INSERT INTO PAIS (nombre) VALUES ('$pais')";
            ejecutar($sqlPais);
            $paisId = consulta("SELECT idPais FROM PAIS WHERE nombre = '$pais'");
        }

        $idRealPais = $paisId['idPais'] ?? $paisId['idpais'];

        $f1 = new DateTime($fechaInicio);
        $f2 = new DateTime($fechaFin);
        $diasTotales = $f1->diff($f2)->days + 1;

        $sql = "INSERT INTO VIAJE (nombre, fechaInicio, fechaFin, estado, idUsuario, idPais, dias) 
        VALUES ('$nombreViaje', '$fechaInicio', '$fechaFin', '$estado', $idUser, $idRealPais, $diasTotales)";
        
        if(ejecutar($sql)) {
            redirigir("../frontend/home.php");
        } else {
            echo "No se pudo insertar el viaje";
        }
    } else {
        redirigir("../frontend/login.php");
    }
?>