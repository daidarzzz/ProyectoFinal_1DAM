<?php
session_start();
include '../backend/db.php';

$id = sesion_get('idUsuario');

if (!$id) {
  redirigir("login.php");
}

$user = consulta("SELECT * FROM USUARIO WHERE idUsuario = '$id'");
$viajes = consulta_lista("SELECT * FROM VIAJE WHERE idUsuario != '$id' AND publico = 1 ORDER BY fechaInicio ASC");
?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="./css/header.css">
  <link rel="stylesheet" href="./css/fonts.css">
  <link rel="stylesheet" href="./css/home.css">
  <link rel="stylesheet" href="./css/viaje.css">
  <link rel="stylesheet" href="./css/community.css">

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
  <header>
    <nav>
      <div class="logo">
        <h3>PLANIFY</h3>
      </div>
      <div class="links-buttons">
        <div class="links">
          <a href="./home.php">Home</a>
          <a href="./communityPlans.php">Community plans</a>
          <a href="./landing.php">Landing</a>
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
  <main>

    <h1>Community Plans</h1>
    <section class="section-viajes">
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
          $autor  = consulta("SELECT * FROM USUARIO WHERE idUsuario = " . $viaje['idUsuario']);
          $claseEstado = strtolower(str_replace(' ', '-', $est));
          
          $pai = consulta("SELECT * FROM PAIS WHERE idPais = " . $viaje['idPais']); 
          $urlFoto = usoApi($pai['nombre']);      ?>
          <div class="tarjetaViaje">
            <div class="fotoDestino" style="height: 150px; overflow: hidden;">
            <img src="<?= $urlFoto ?>" alt="Foto de <?= $pai['nombre'] ?>" >
          </div>
            <button class="title"><?= $nom ?></button>
            <p>Autor: <?= $autor['nombre'] ?></p>
            <button class="details"><a href="./detalles_viajes.php?id=<?php echo $viaje['idViaje']; ?>">View details</a></button>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>



    </section>

  </main>
</body>

</html>