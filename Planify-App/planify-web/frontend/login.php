<?php
include '../backend/db.php';

if (sesion_get('idUsuario')) {
    redirigir("home.php");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login to Planify</title>
    <link rel="stylesheet" href="./css/sign.css">

    
</head>

<body id="bodylogin">
        <main>

        <section class="main-container">
            <div class="left-container">
                <h2>PLANIFY</h2>
                <h3>Get access to all your plans, anytime, anywhere</h3>
            </div>
            <div class="right-container">
                <form action="../backend/users.php" method="POST">
                    <input type="hidden" name="accion" value="login">
                    <h2>Log In</h2>
                    <label for="email">Your email</label><br>
                    <input type="email" name="email" id="email" placeholder="example@email.com" required><br>
                    <label for="pass">Password</label><br>
                    <input type="password" name="pass" id="pass" placeholder="example123" required><br>
                    <button id="login" type="submit">Log in</button>
                    <a class="small-link" href="./register.html">Don't have an account yet?</a>

                </form>
            </div>
        </section>

    </main>


</body>

</html>