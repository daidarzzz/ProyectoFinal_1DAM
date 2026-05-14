<?php
session_start();
include '../backend/db.php';

$id = sesion_get('idUsuario');

if (!$id) {
  redirigir("login.php");
}

$user = consulta("SELECT * FROM USUARIO WHERE idUsuario = '$id'");
$viajes = consulta_lista("SELECT * FROM VIAJE WHERE idUsuario = '$id' ORDER BY fechaInicio ASC");

?>

<!DOCTYPE html>
<html>

<head>
  <title>Home - Planify</title>
  <link rel="stylesheet" href="./css/header.css">
  <link rel="stylesheet" href="./css/fonts.css">
  <link rel="stylesheet" href="./css/home.css">
  <link rel="stylesheet" href="./css/viaje.css">

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

    <main>
      <h1>Welcome, <?php echo $user['nombre']; ?>!</h1>
      <p>Has entrado correctamente a Planify.</p>

      <button id="createPlanBut">Create plan</button>

      <section id="createPlanContainer">
        <div class="caja-formulario">

          <h1>Create your plan</h1>

          <p>
            Rellena la información para crear tu nuevo plan de viaje.
          </p>

          <form action="../backend/viaje.php" method="POST">
            <div class="rellenar-viaje">
              <label for="nombre_viaje">Nombre del viaje</label>
              <input type="text" id="nombre_viaje" name="nombre_viaje" placeholder="Verano en Japón" required>
            </div>
            <div class="rellenar-viaje">
              <label for="pais">País de destino</label>
              <input type="text" id="pais" name="pais" placeholder="Japón" required>
            </div>
            <div class="rellenar-viaje">
              <label for="fecha_inicio">Fecha de inicio</label>
              <input type="date" id="fecha_inicio" name="fecha_inicio" required>
            </div>
            <div class="rellenar-viaje">
              <label for="fecha_fin">Fecha de fin</label>
              <input type="date" id="fecha_fin" name="fecha_fin" required>
            </div>
            <div class="rellenar-viaje">
              <label for="estado">Estado</label>
              <select id="estado" name="estado" required>
                <option value="" disabled selected>Selecciona un estado</option>
                <option value="Finalizado">Finalizado</option>
                <option value="En curso">En curso</option>
                <option value="Pendiente">Pendiente</option>
              </select>
            </div>
            <button type="submit" id="boton-crear-viaje">Crear viaje</button>
            <button type="reset" id="boton-cerrar">Cerrar</button>

          </form>

        </div>
      </section>
  </section>

  <section class="section-viajes">
    <h2>My plans</h2>

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
          $pai    = consulta("SELECT * FROM PAIS WHERE idPais = '$viaje[idPais]'");
        ?>
          <div class="tarjetaViaje">
            <h3><?= $nom ?></h3>
            <h3><?= $pai['nombre'] ?></h3>
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

  <script>
    const butAbrir = document.getElementById('createPlanBut')

    const windowPlanContainer = document.getElementById('createPlanContainer')

    const butCerrar = document.getElementById('boton-cerrar')


    butAbrir.onclick = function() {
      windowPlanContainer.style.display = "flex"
    }


    butCerrar.onclick = function() {
      windowPlanContainer.style.display = "none"
    }
  </script>


</body>

</html>