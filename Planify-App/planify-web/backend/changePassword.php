<?php
include '../backend/db.php';
$current = $_POST['currentPassword'];
$pass1 = $_POST['newPassword'];
$pass2 = $_POST['confirmPassword'];
$id = sesion_get('idUsuario');

if (!$id) {
    redirigir("login.php");
}

if ($pass1 !== $pass2) {
    echo "New passwords do not match.";
    exit;
}

$user = consulta("SELECT * FROM USUARIO WHERE idUsuario = '$id'");

if ($user['contrasenia'] !== $current) {
    echo "Current password is incorrect.";
    exit;
}

$sql = "UPDATE USUARIO SET contrasenia = '$pass1' WHERE idUsuario = '$id'";
ejecutar($sql);
echo "Password changed successfully.";