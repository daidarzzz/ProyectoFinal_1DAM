<?php
session_start();
include 'db.php';

$idViaje = intval($_GET['id']);

ejecutar("DELETE FROM ACTIVIDAD WHERE idViaje = $idViaje");

ejecutar("DELETE FROM VIAJE WHERE idViaje = $idViaje");

redirigir("../frontend/home.php");
?>