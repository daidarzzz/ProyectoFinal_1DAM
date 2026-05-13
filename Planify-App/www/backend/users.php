<?php 
    include 'db.php';
    session_start();
    $accion = $_POST['accion']; 
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    if ($accion == 'registro') {
        $nombre = $_POST['name'];

        $sql = "INSERT INTO USUARIO (nombre, email, contrasenia) VALUES ('$nombre', '$email', '$pass')";

        if (ejecutar($sql)) {
            redirigir("../frontend/login.html");
        } else {
            echo "Error al registrarte... " . mysqli_error($conn);
        }
    }

    if ($accion == 'login') {

        $user = consulta("SELECT * FROM USUARIO WHERE email = '$email' AND contrasenia = '$pass'");

        if ($user) {
            sesion_set('idUsuario', $user['idUsuario']);
            redirigir("../frontend/home.php");
        } else {
            echo "Email o contraseña incorrectos";
        }
    }
?>