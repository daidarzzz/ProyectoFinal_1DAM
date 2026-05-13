<?php
session_start();
include '../backend/db.php';

$id = sesion_get('idUsuario');

if (!$id) {
  redirigir("login.php");
}

$user = consulta("SELECT * FROM USUARIO WHERE idUsuario = '$id'");

?>

<!DOCTYPE html>
<html>

<head>
  <title>Home - Planify</title>
  <link rel="stylesheet" href="./css/header.css">
  <link rel="stylesheet" href="./css/fonts.css">
  <link rel="stylesheet" href="./css/home.css">

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
          <a href="./communityPlans.html">Community plans</a>
          <a href="./landing.html">Landing</a>
        </div>
        <div class="buttons-nav">
          <button class="but-login" id="user"><a href=""><?php echo $user['nombre']; ?></a></button>
          <button class="but-login logout">
            <a href="../backend/logout.php" style="text-decoration: none; color: inherit;">Log out</a>
          </button>

        </div>
      </div>
    </nav>
  </header>

  <main>
    <h1>Bienvenido, <?php echo $user['nombre']; ?>!</h1>
    <p>Has entrado correctamente a Planify.</p>

    <button id="createPlanBut">Create plan</button>

    <section id="createPlanContainer">
      <div class="caja-formulario">

        <h1>Crea tu viaje</h1>

        <p>
          Rellena la información para crear tu nuevo plan de viaje.
        </p>

        <form action="guardar-viaje.php" method="POST">
          <div class="rellenar-viaje">
            <label for="nombre_viaje">Nombre del viaje</label>
            <input type="text" id="nombre_viaje" name="nombre_viaje" placeholder="Verano en Japón" required>
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
            <label for="pais">País</label>
            <input type="text" id="pais" name="pais" placeholder="Japón" required>
          </div>
          <button type="submit" id="boton-crear-viaje">Crear viaje</button>
          <button type="reset" id="boton-cerrar">Cerrar</button>

        </form>

      </div>
    </section>

  </main>

  <script>
    const butAbrir = document.getElementById('createPlanBut')
    const windowPlanContainer = document.getElementById('createPlanContainer')
    const butCerrar = document.getElementById('boton-cerrar')

    butAbrir.onclick = function() {
      windowPlanContainer.style.visibility = "visible"
    }

    butCerrar.onclick = function() {
      windowPlanContainer.style.visibility = "hidden"

    }

  </script>

</body>

</html>