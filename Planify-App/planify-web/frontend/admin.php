<?php
session_start();
include '../backend/db.php';

$id = sesion_get('idUsuario');

if (!$id) {
    redirigir("login.php");
}
$user = consulta("SELECT * FROM USUARIO WHERE idUsuario = '$id'");
$users = consulta_lista("SELECT * FROM USUARIO");

if ($user['nombre'] != "admin") {
    redirigir("home.php");
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/fonts.css">
    <style>
        .usersTarjeta {
            padding: 20px;
            box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.2);
            width: 30%;
            border-radius: 30px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <h1>Welcome to the admin panel</h1>

    <section class="section-viajes">
        <h2>Users</h2>

        <div class="contenedorViajes">

            <?php if (empty($users)): ?>
                <p>There is not users!</p>
            <?php else: ?>
                <?php foreach ($users as $usuario):

                    $nomUser = $usuario['nombre'];
                    $emailUser = $usuario['email'];
                    $idU = $usuario['idUsuario'];


                    if ($nomUser == "admin") {
                        continue;
                    }

                    $contar = consulta("SELECT COUNT(*) as total FROM VIAJE WHERE idUsuario = " . $idU);
                    $numViajes = $contar['total'];
                ?>
                    <div class="usersTarjeta">

                        <h3>User: <?= $nomUser ?></h3>
                        <p>Email: <?= $emailUser ?></p>
                        <p>Trips created: <?= $numViajes ?></p>
                    </div>

                <?php endforeach; ?>
            <?php endif; ?>
        </div>



    </section>



</body>

</html>