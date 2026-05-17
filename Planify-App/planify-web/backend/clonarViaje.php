<?php
session_start();
include 'db.php'; 

$idUsuario = sesion_get('idUsuario');
$idViajeClon = intval($_POST['idViajeClon']);

if (!$idUsuario || !$idViajeClon) {
    redirigir("../frontend/home.php");
}

$viajeOriginal = consulta("SELECT * FROM VIAJE WHERE idViaje = $idViajeClon");
$actividadCopia = consulta_lista("SELECT * FROM ACTIVIDAD WHERE idViaje = $idViajeClon");

if ($viajeOriginal) {
    $nombre = $viajeOriginal['nombre'];
    $fechaInicio = $viajeOriginal['fechaInicio'];
    $fechaFin = $viajeOriginal['fechaFin'];
    $idPais = $viajeOriginal['idPais'];
    $dias = intval($viajeOriginal['dias']); 

    $existe = consulta("SELECT nombre FROM VIAJE WHERE idUsuario = '$idUsuario' AND nombre = '$nombre'");        
        if ($existe) {
            die("Error, ya existe un viaje con ese nombre.");
        }

    ejecutar("INSERT INTO VIAJE (idUsuario, fechaInicio, fechaFin, nombre, estado, idPais, dias, publico) 
              VALUES ('$idUsuario', '$fechaInicio', '$fechaFin', '$nombre', 'Pendiente', '$idPais', '$dias', 0)");
              
}

$resultadoViaje = consulta("SELECT idViaje FROM VIAJE WHERE idUsuario = $idUsuario ORDER BY idViaje DESC LIMIT 1");

if ($resultadoViaje) {
    $idViajeActual = $resultadoViaje['idViaje'];
    foreach ($actividadCopia as $act) {
        $nombreAct = $act['nombre'];
        $coste = isset($act['coste']) ? floatval($act['coste']) : 0.00;
        $hora = $act['hora'];
        $descripcion = $act['descripcion'];
        $diaAct = intval($act['dia']);
        ejecutar("INSERT INTO ACTIVIDAD (idViaje, dia, hora, nombre, descripcion, coste)
                  VALUES ('$idViajeActual', '$diaAct', '$hora', '$nombreAct', '$descripcion', '$coste')");
    }
}

redirigir("../frontend/home.php");
?>