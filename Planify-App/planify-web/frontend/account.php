<?php
    include('../backend/db.php');
    $id = sesion_get('idUsuario');
    if (!$id) {
        redirigir("login.php");
    }
    $user = consulta("SELECT * FROM USUARIO WHERE idUsuario = '$id'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account - Planify</title>
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/fonts.css">
    <link rel="stylesheet" href="./css/account.css">
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
                    <a href="./communityPlans.php">Community plans</a>
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

    <main class="cambioContrasenia">
        <h1>Change Password</h1>
        <form action="../backend/changePassword.php" method="POST">
            <label for="currentPassword">Current Password:</label>
            <input type="password" id="currentPassword" name="currentPassword" required>

            <label for="newPassword">New Password:</label>
            <input type="password" id="newPassword" name="newPassword" required>
            <label for="confirmPassword">Confirm New Password:</label>
            <input type="password" id="confirmPassword" name="confirmPassword" required>

            <button type="submit">Change Password</button>
        </form>

    </main>
</body>
</html>