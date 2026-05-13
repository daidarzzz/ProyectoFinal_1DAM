<?php
$host = "db";
$user = "root";
$pass = "root";
$db = "PLANIFY"; //<-- nombre de la bbase de datos
$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

function consulta($sql)
{
    global $conn;
    $res = mysqli_query($conn, $sql);
    return mysqli_fetch_assoc($res);
}

//Para, por ejemplo, devolver todos los viajes de un usuario
//Uso: $viajes = consulta_lista("SELECT * FROM VIAJE WHERE idUsuario = 1");
function consulta_lista($sql)
{
    global $conn;
    $res = mysqli_query($conn, $sql);
    return mysqli_fetch_all($res, MYSQLI_ASSOC);
}

// Para INSERT, UPDATE o DELETE
// Devuelve true si funcionó o false si hubo error
function ejecutar($sql) {
    global $conn;
    return mysqli_query($conn, $sql);
}

// Inicia la sesión si no está ya iniciada
function iniciar_sesion()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

// Guarda algo en la sesión
function sesion_set($clave, $valor)
{
    iniciar_sesion();
    $_SESSION[$clave] = $valor;
}

// Lee algo de la sesión 
function sesion_get($clave)
{
    iniciar_sesion();
    return $_SESSION[$clave] ?? null;
}

// Cierra la sesión
function sesion_borrar()
{
    iniciar_sesion();
    session_destroy();
}

// Envía al usuario a otra página
function redirigir($url) {
    header("Location: $url");
    exit();
}