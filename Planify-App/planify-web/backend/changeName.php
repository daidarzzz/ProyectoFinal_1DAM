<?php
session_start();
include 'db.php';

$idUser = sesion_get('idUsuario');

if($idUser) {
    $idViaje = intval($_POST['id_viaje']);
    $nuevoNombre = $_POST['nombre_viaje'];
    $nuevoEstado = $_POST['estado_viaje']; 

    $sql = "UPDATE VIAJE 
            SET nombre = '$nuevoNombre', estado = '$nuevoEstado' 
            WHERE idViaje = $idViaje AND idUsuario = '$idUser'";
    
    if(ejecutar($sql)) {
        redirigir("../frontend/detalles_viajes.php?id=" . $idViaje);
    } else {
        echo "No se pudieron guardar los cambios del viaje.";
    }
} else {
    redirigir("../frontend/login.php");
}
?>