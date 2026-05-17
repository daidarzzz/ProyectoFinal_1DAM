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
    <link rel="stylesheet" href="./css/popup.css">
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
                    <button class="but-login" id="user"><a href=""><?php echo $user['nombre']; ?></a></button>
                    <button class="but-login logout">
                        <a href="../backend/logout.php" style="text-decoration: none; color: inherit;">Log out</a>
                    </button>

                </div>
            </div>
        </nav>
    </header>

    <main>

        <section class="accountDetails">

            <h1>Account details</h1>

            <div><b class="negrita">Username:</b> <?php echo $user['nombre']; ?></div>
            <div><b class="negrita">Email:</b> <?php echo $user['email']; ?></div>
            <button class="detailsChange">Change password</button>

        </section>


        <section class="mainContainer">
            <div class="caja2">
                <h1>Change Password</h1>
                <form action="../backend/changePassword.php" method="POST">
                    <div class="rellenar">
                        <label for="currentPassword">Current Password:</label>
                        <input type="password" id="currentPassword" name="currentPassword" required>

                    </div>

                    <div class="rellenar">
                        <label for="newPassword">New Password:</label>
                        <input type="password" id="newPassword" name="newPassword" required>
                    </div>


                    <div class="rellenar">
                        <label for="confirmPassword">Confirm New Password:</label>
                        <input type="password" id="confirmPassword" name="confirmPassword" required>
                    </div>


                    <button type="submit">Change Password</button>
                    <button type="reset" id="button-cerrar">Cerrar</button>
                </form>
            </div>

        </section>


    </main>

    <script>
        const butAbrir = document.querySelector('.detailsChange')
        const windowChangePassword = document.querySelector('.mainContainer')

        const butCerrar = document.getElementById('button-cerrar')

        butAbrir.onclick = function() {
            windowChangePassword.style.display = "flex"
        }


        butCerrar.onclick = function() {
            windowChangePassword.style.display = "none"
        }
    </script>
</body>

</html>