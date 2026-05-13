<?php
session_start();
include '../backend/db.php';

$id = sesion_get('idUsuario');

if (!$id) {
  redirigir("login.html");
}

$user = consulta("SELECT * FROM USUARIO WHERE idUsuario = '$id'");

?>

<!DOCTYPE html>
<html>

<head>
  <title>Home - Planify</title>
  <link rel="stylesheet" href="./css/header.css">
  <link rel="stylesheet" href="./css/fonts.css">
  <style>
    #user {
    background-color: #ff396e;    
  }
  #user a{
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
  <h1>Bienvenido, <?php echo $user['nombre']; ?>!</h1>
  <p>Has entrado correctamente a Planify.</p>

</body>

</html>