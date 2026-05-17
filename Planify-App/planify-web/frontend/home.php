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
  <link rel="stylesheet" href="./css/popup.css">
  <link rel="stylesheet" href="./css/buttons.css">

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
      <h1>Welcome, <?php echo $user['nombre']; ?>!</h1>
      <p>You have successfully logged in to Planify.</p>

      <button class="buttonPro" id="createConfirm">Create plan</button>

      <section class="mainContainer">
        <div class="caja2">

          <h1>Create your plan</h1>

          <p>
            Please fill in the details to create your new travel plan.
          </p>

          <form action="../backend/viaje.php" method="POST">
            <div class="rellenar">
              <label for="nombre_viaje">Name of the trip</label>
              <input type="text" id="nombre_viaje" name="nombre_viaje" placeholder="Verano en Japón" required>
            </div>
            <div class="rellenar">
              <label for="pais">Country</label>
              <input type="text" id="pais" name="pais" placeholder="Japón" required>
            </div>
            <div class="rellenar">
              <label for="fecha_inicio">Start date</label>
              <input type="date" id="fecha_inicio" name="fecha_inicio" required>
            </div>
            <div class="rellenar">
              <label for="fecha_fin">End date</label>
              <input type="date" id="fecha_fin" name="fecha_fin" required>
            </div>
            <div class="rellenar">
              <label for="estado">Status</label>
              <select id="estado" name="estado" required>
                <option value="" disabled selected>Select status</option>
                <option value="Finalizado">Completed</option>
                <option value="En curso">In progress</option>
                <option value="Pendiente">Pending</option>
              </select>
            </div>
            <div class="rellenar">
              <label for="publico">Privacy</label>
              <select id="publico" name="publico" required>
                <option value="1">Public (Visible to community)</option>
                <option value="0" selected>Private (Only me)</option>
              </select>
            </div>
            <button type="submit" class="buttonPro gradientBlue">Create a trip</button>
            <button type="reset" id="closeCreate" class="buttonPro gray">Close</button>

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
          $claseEstado = strtolower(str_replace(' ', '-', $est));
          
          $pai = consulta("SELECT * FROM PAIS WHERE idPais = " . $viaje['idPais']); 
          $urlFoto = usoApi($pai['nombre']);      ?>
          <div class="tarjetaViaje">
            <div class="fotoDestino" style="height: 150px; overflow: hidden;">
            <img src="<?= $urlFoto ?>" alt="Foto de <?= $pai['nombre'] ?>" >
          </div>
            <button class="title"><?= $nom ?></button>
           
            <p class="estado-texto">Estado: <span class="color_estado <?= $claseEstado ?>"><?= $est ?></span></p>
            <button class="details"><a href="./detalles_viajes.php?id=<?php echo $viaje['idViaje']; ?>">View details</a></button>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>



  </section>


  </main>

  <script>
    const butAbrir = document.getElementById('createConfirm')

    const windowPlanContainer = document.querySelector('.mainContainer')

    const butCerrar = document.getElementById('closeCreate')

    butAbrir.onclick = function() {
      windowPlanContainer.style.display = "flex"
    }


    butCerrar.onclick = function() {
      windowPlanContainer.style.display = "none"
    }
  </script>


</body>

</html>