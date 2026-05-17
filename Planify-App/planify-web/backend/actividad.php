<?php
session_start();
include 'db.php';

$idViaje   = intval($_POST['id_viaje']);
$nombre    = $_POST['nombre_viaje'];
$dia       = intval($_POST['dia_viaje']);
$hora      = $_POST['hora_actividad'];
$desc      = $_POST['descripcion'];
$coste     = !empty($_POST['coste']) ? floatval($_POST['coste']) : "NULL";

ejecutar("INSERT INTO ACTIVIDAD (idViaje, dia, hora, nombre, descripcion, coste) 
          VALUES ($idViaje, $dia, '$hora', '$nombre', '$desc', $coste)");

redirigir("../frontend/detalles_viajes.php?id=" . $idViaje);
?>