<?php

session_start();
include '../backend/db.php';

$idUsuario = sesion_get('idUsuario');
if (!$idUsuario) {
  redirigir("login.php");
}


if (!isset($_GET['id'])) {
  die("Error: No se ha proporcionado un ID de viaje.");
}

$idViaje = intval($_GET['id']);

$user = consulta("SELECT * FROM USUARIO WHERE idUsuario = '$idUsuario'");
$viaje = consulta("SELECT * FROM VIAJE WHERE idViaje = $idViaje");

if (!$viaje) {
  die("Error: El viaje no existe.");
}

$esPropietario = ($viaje['idUsuario'] == $idUsuario);

$pais = consulta("SELECT * FROM PAIS where idPais =" . $viaje['idPais']);
$foto = usoApi($pais['nombre']);

$actividades = consulta_lista("SELECT * FROM ACTIVIDAD WHERE idViaje = $idViaje ORDER BY dia ASC, hora ASC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Viaje - Planify</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/header.css">
  <link rel="stylesheet" href="./css/fonts.css">

  <link rel="stylesheet" href="./css/buttons.css">
  <link rel="stylesheet" href="./css/detalles_viajes.css">
  <link rel="stylesheet" href="./css/popup.css">

</head>
  <style>
    #user {
      background-color: #ff396e;
    }

    #user a {
      color: #ffffff;
      text-decoration: none;
    }
  </style>
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
    <div class="panel-lateral">
      <h2><?php echo $viaje['nombre'] ?></h2>
      <span class="paisTitle"><?php echo $pais['nombre'] ?></span>

      <div class="infoContenedor">
        <p><strong>Start:</strong> <?php echo $viaje['fechaInicio'] ?></p>
        <p><strong>End:</strong> <?php echo $viaje['fechaFin'] ?></p>
        <p><strong>Duration:</strong> <?php echo $viaje['dias'] ?> days</p>
        <p><strong>Status:</strong> <?php echo $viaje['estado'] ?></p>
        <p><strong>Privacy:</strong> <?php echo ($viaje['publico'] == 1) ? 'Public' : 'Private'; ?></p>

        <?php if ($esPropietario): ?>
          <a id="changeBut" class="buttonPro gray2" style="text-decoration: none;">
            Edit Trip
          </a>
          <a href="../backend/borrarViaje.php?id=<?= $idViaje ?>" class="buttonPro gray gray2"
            onclick="return confirm('Delete this trip?');" style="text-decoration: none;">
            Delete Trip
          </a>

        <?php else: ?>
          <form action="../backend/clonarViaje.php" method="POST">
            <input type="hidden" name="idViajeClon" value="<?php echo $idViaje; ?>">
            <button type="submit" class="buttonPro gradientBlue">Copy Plan</button>
          </form>
        <?php endif; ?>

      </div>
    </div>

    <?php if ($esPropietario): ?>
      <section class="mainContainer">
        <div class="caja2">
          <h1>Edit Travel Plan</h1>
          <p>Please fill in the details to update your travel plan.</p>

          <form action="../backend/changeName.php" method="POST">
            <input type="hidden" name="id_viaje" value="<?php echo $idViaje; ?>">

            <div class="rellenar">
              <label for="nombre_viaje">Trip Name</label>
              <input type="text" id="nombre_viaje" name="nombre_viaje" value="<?php echo $viaje['nombre']; ?>" required>
            </div>

            <div class="rellenar">
              <label for="estado_viaje">Status</label>
              <select id="estado_viaje" name="estado_viaje" required>
                <option value="Pendiente" <?php echo ($viaje['estado'] == 'Pendiente') ? 'selected' : ''; ?>>Pendiente
                </option>
                <option value="En curso" <?php echo ($viaje['estado'] == 'En curso') ? 'selected' : ''; ?>>En curso</option>
                <option value="Finalizado" <?php echo ($viaje['estado'] == 'Finalizado') ? 'selected' : ''; ?>>Finalizado
                </option>
              </select>
            </div>
            <div class="rellenar">
              <label for="publico_viaje">Privacy</label>
              <select id="publico_viaje" name="publico_viaje" required>
                <option value="1" <?php echo ($viaje['publico'] == 1) ? 'selected' : ''; ?>>Public</option>
                <option value="0" <?php echo ($viaje['publico'] == 0) ? 'selected' : ''; ?>>Private</option>
              </select>
            </div>

            <button type="submit" class="buttonPro gradientBlue">Save Changes</button>
            <button type="reset" id="closeCreate" class="buttonPro gray">Close</button>
          </form>
        </div>
      </section>
    <?php endif; ?>


    <?php if ($esPropietario): ?>
      <div class="crearActividad">
        <h2 id="createActivityTitle">Create Activity</h2>
        <section class="formactividad">
          <form action="../backend/actividad.php" method="POST">
            <input type="hidden" name="id_viaje" value="<?php echo $idViaje; ?>">

            <div>
              <label for="nombre_viaje">Name Activity</label>
              <input type="text" name="nombre_viaje" id="nombre_viaje" required>
            </div>
            <div>
              <label for="dia_viaje">Day Number</label>
              <input type="number" name="dia_viaje" id="dia_viaje" min="1" max="<?php echo $viaje['dias']; ?>"
                placeholder="1" required>
            </div>
            <div>
              <label for="hora_actividad">Time</label>
              <input type="time" name="hora_actividad" id="hora_actividad" required>
            </div>
            <div>
              <label for="coste">Cost (€)</label>
              <input type="number" step="0.01" name="coste" id="coste" placeholder="0.00">
            </div>
            <div>
              <label for="descripcion">Description</label>
              <textarea name="descripcion" id="descripcion" rows="4" required></textarea>
            </div>
            <button type="submit" class="buttonPro">Create Activity</button>
          </form>
        </section>
      </div>
    <?php endif; ?>

   <div class="contenido-principal">

      <div class="itinerario">
        <?php 
        for ($i = 1; $i <= $viaje['dias']; $i++): 
            $fechaDia = date('d M', strtotime($viaje['fechaInicio'] . " + " . ($i - 1) . " days"));
        ?>
          
          <div class="dia-caja">
            
            <h2>Día <?= $i ?> - <?= $fechaDia ?></h2>
            
            <div class="actividades-lista">
              <?php 
              $hayPlanes = false;
              foreach ($actividades as $act) {
                  if ($act['dia'] == $i) {
                      $hayPlanes = true;
                      ?>
                      <div class="actividad-item">
                        <p><strong class="hora"><?= $act['hora'] ?></strong>: <?= $act['nombre'] ?></p>
                        <p><?= $act['descripcion'] ?></p>
                        <?= ($act['coste'] > 0) ? "<p>Cost: €" . number_format($act['coste'], 2) . "</p>" : "" ?>
                      </div>
                      <?php
                  }
              }
              if (!$hayPlanes) {
                  echo '<p>No hay planes.</p>';
              }
              ?>
            </div>

          </div>

        <?php endfor; ?>
      </div>

    </div>


  </main>

  <?php if ($esPropietario): ?>
    <script>
      const butAbrir = document.getElementById('changeBut')
      const windowPlanContainer = document.querySelector('.mainContainer')
      const butCerrar = document.getElementById('closeCreate')

      butAbrir.onclick = function () {
        windowPlanContainer.style.display = "flex"
      }

      butCerrar.onclick = function () {
        windowPlanContainer.style.display = "none"
      }
    </script>
  <?php endif; ?>
</body>

</html>