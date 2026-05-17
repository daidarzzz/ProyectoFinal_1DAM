<?php
session_start();
include 'db.php'; 

$idUsuario = sesion_get('idUsuario');
$idViajeClon = intval($_POST['idViajeClon']);

if (!$idUsuario || !$idViajeClon) {
    redirigir("../frontend/home.php");
}

$viajeOriginal = consulta("SELECT * FROM VIAJE WHERE idViaje = $idViajeClon");

if ($viajeOriginal) {
    $nombre = $viajeOriginal['nombre'];
    $fechaInicio = $viajeOriginal['fechaInicio'];
    $fechaFin = $viajeOriginal['fechaFin'];
    $idPais = $viajeOriginal['idPais'];
    $dias = intval($viajeOriginal['dias']); 

    ejecutar("INSERT INTO VIAJE (idUsuario, fechaInicio, fechaFin, nombre, estado, idPais, dias) 
              VALUES ('$idUsuario', '$fechaInicio', '$fechaFin', '$nombre', 'Pendiente', '$idPais', $dias)");
}

redirigir("../frontend/home.php");
?>