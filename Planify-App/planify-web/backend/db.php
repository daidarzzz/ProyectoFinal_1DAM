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
function usoApi($pais) {
    $accessKey = 'qKGa0OKFegyQJyBJRorZcArALDdiEvnfHDy7_9yyWKw';
    $url = "https://api.unsplash.com/search/photos?query=" . urlencode($pais) . "&per_page=1&client_id=" . $accessKey;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    // Importante para APIs externas
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 

    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);

    // Devolvemos la URL de la imagen pequeña (thumb) o regular
    return $data['results'][0]['urls']['regular'] ?? 'https://via.placeholder.com/400x200?text=No+Image';
}
