<?php

session_start();
include '../backend/db.php';

$idUsuario = sesion_get('idUsuario');
if(!$idUsuario){
    redirigir("login.php");
}


if (!isset($_GET['id'])) {
    die("Error: No se proporcionó un ID de viaje.");
}

$idViaje = intval($_GET['id']);

$user = consulta("SELECT * FROM USUARIO WHERE idUsuario = '$idUsuario'");
$viaje = consulta("SELECT * FROM VIAJE WHERE idViaje = $idViaje");

if (!$viaje) {
    die("Error: El viaje no existe.");
}

$pais = consulta("SELECT * FROM PAIS where idPais =" . $viaje['idPais']);
$foto = usoApi($pais['nombre']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Viaje - Planify</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/fonts.css">
    <link rel="stylesheet" href="./css/popup.css">
    <link rel="stylesheet" href="./css/buttons.css">
    <link rel="stylesheet" href="./css/detalles_viajes.css">
      <style>
    #user {
      background-color: #ff396e;
    }

    #user a {
      color: #ffffff;
      text-decoration: none;
    }
  </style>
</head>
<body>
      <section class="fondo_imagen">
    <header>
      <nav>
        <div class="logo">
          <h3>PLANIFY</h3>
        </div>
        <div class="links-buttons">
          <div class="links">
            <a href="./home.php">Home</a>
            <a href="./communityPlans.php">Community plans</a>
            <a href="./landing.html">Landing</a>
          </div>
          <div class="buttons-nav">
            <button class="but-login" id="user"><a href="./account.php"><?php echo $user['nombre']; ?></a></button>
            <button class="but-login logout">
              <a href="../backend/logout.php" style="text-decoration: none; color: inherit;">Log out</a>
            </button>

          </div>
        </div>
      </nav>
    </header>
  </section>
    <section class="datos_viaje">
        <h1><?php echo $viaje['nombre'] ?></h1>
        
        <div class="fechas">
        
        <h2><?php echo $viaje['fechaInicio'] ?></h1>

        <p>Hasta</p>

        <h2><?php echo $viaje['fechaFin'] ?></h1>

        </div>

    </section>

    <section class="formactividad">
    

    </section>

</body>
</html>