<?php
session_start();
include '../backend/db.php';

$id = sesion_get('idUsuario');

if (!$id) {
  redirigir("login.php");
}

$user = consulta("SELECT * FROM USUARIO WHERE idUsuario = '$id'");
$viajes = consulta_lista("SELECT * FROM VIAJE WHERE idUsuario != '$id' ORDER BY fechaInicio ASC");

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/fonts.css">
</head>

<body>
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
                    <button class="but-login"><a href="./login.html">Log in</a></button>
                    <button class="but-signup"><a href="./register.html">Sign up</a></button>
                </div>
            </div>
        </nav>
    </header>
    <main>

        <h1>Community Plans</h1>
  <section class="section-viajes">
    <h2>Mis viajes</h2>

    <div class="contenedorViajes">

      <?php if (empty($viajes)): ?>
        <p>You haven't created any trips yet. Start by creating one!</p>
      <?php else: ?>
        <?php foreach ($viajes as $viaje):
          $idV    = $viaje['idViaje'];
          $nom    = $viaje['nombre'];
          $ini    = $viaje['fechaInicio'];
          $fin    = $viaje['fechaFin'];
          $est    = $viaje['estado'];
        ?>
          <div class="tarjetaViaje">
            <h3><?= $nom ?></h3>
            <p>Desde: <?= $ini ?></p>
            <p>Hasta: <?= $fin ?></p>
            <p>Estado: <?= $est ?></p>
            <a href="#">Ver detalles</a>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>



  </section>

    </main>
</body>

</html>