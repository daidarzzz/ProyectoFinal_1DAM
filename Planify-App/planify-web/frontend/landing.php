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

<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Landing</title>
  <link rel="stylesheet" href="./css/buttons.css">
  <link rel="stylesheet" href="./css/header.css">
  <link rel="stylesheet" href="./css/landing.css" />

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
      <button class="menu-hamburger" id="menuToggle">☰</button>
      <div class="links-buttons" id="navContent">
        <div class="links">
          <a href="./home.php">Home</a>
          <a href="./communityPlans.php">Community plans</a>
          <a href="./landing.php">Landing</a>
        </div>
        <div class="buttons-nav">
          <button class="but-login" id="user"><a href="./account.php"><?php echo $user['nombre']; ?></a></button>
          <button class="but-login logout"><a href="../backend/logout.php" style="text-decoration: none; color: inherit;">Log out</a></button>
        </div>
      </div>
    </nav>
  </header>

    <main>
      <div class="tituloPrincipal">
        <br />
        <h1>Your <span class="aurora">dream plan</span> <br />made easy</h1>
      </div>

      <div class="main-buttons">
        <div>
          <button class="start-planning-button">
            <span>Start Planning</span>
          </button>
        </div>
        <div>
          <button class="view-plans-button"><span>View my plans</span></button>
        </div>
      </div>

      <section class="como-funciona">

        <h2>How does it work?</h2>
        <div class="circulos">
          <div class="crear-viaje secFunciona">
            <div class="circulo">1</div>
            <h3>Create your trip</h3>
            <p>Define the destination and dates for your next getaway.</p>
          </div>
          <div class="anyadir-actividades secFunciona">
            <div class="circulo">2</div>
            <h3>Add activities</h3>
            <p>Search for museums, restaurants, and points of interest.</p>
          </div>
          <div class="organizar-timeline secFunciona">
            <div class="circulo">3</div>
            <h3>Organize on your TimeLine</h3>
            <p>Drag your plans to the day you will do them.</p>
          </div>
          <div class="comparte secFunciona">
            <div class="circulo">4</div>
            <h3>Share or publish</h3>
            <p>Share your plans with your friends and inspire others.</p>
          </div>
        </div>

      </section>


      <section class="community-plans">
        <div>
          <h2 class="title-community">Get inspired by real trips</h2>
          <p class="community-plans-content">
            Discover the routes taken by our community and add them to your
            plans.
          </p>
          <div class="photo-community">
            <div class="tokio caja-community">
              <h4>Japan</h4>
              <p>7 days in Tokyo</p>
            </div>
            <div class="roma caja-community">
              <h4>Italy</h4>
              <p>Getaway to Rome</p>
            </div>
            <div class="paris caja-community">
              <h4>France</h4>
              <p>Romantic Paris</p>
            </div>
          </div>
        </div>
      </section>


      <section class="ads">
        <div class="ads-todo">
          <div class="title-ads">
            <h2>Boost your business with Planify</h2>
          </div>
          <div class="content-ads">
            Attract thousands of customers looking for unique experiences to your
            business. Sign up on <b>Planify</b>, publish your business on Planify,
            and create customized activities to get noticed by customers.
          </div>
          <div class="button-ads">
            <button class="but-ads">
              <span>Become an advertiser</span>
            </button>
          </div>
        </div>

        <div class="svg-ads">
          <svg class="icon-planify" viewBox="0 0 6.35 6.35" xmlns="http://www.w3.org/2000/svg">
            <g id="SVGRepo_iconCarrier">
              <g id="layer1">
                <path
                  d="M 3.7952208,0.0066805 C 3.6382726,0.0165918 3.4856556,0.05861054 3.3446009,0.14000564 2.9684613,0.35705367 2.7902036,0.78519635 2.7740931,1.2407136 2.75798,1.6962396 2.8922296,2.2034334 3.1704522,2.6850698 3.4486721,3.1667065 3.8218908,3.5383657 4.2246501,3.7521884 4.6274068,3.9660022 5.0866785,4.0240134 5.4628181,3.8069654 5.8389657,3.589912 6.0166995,3.1643583 6.03281,2.7088411 6.0489231,2.2533151 5.9151895,1.7435373 5.6369669,1.2619009 5.3587469,0.78026451 4.9850124,0.41118901 4.582253,0.19736651 4.3305311,0.06373261 4.0567984,-0.00983637 3.7952208,0.0066805 Z m 0.5038434,1.2485026 c 0.053951,0.00398 0.106336,0.012933 0.1570963,0.026872 0.2030413,0.05575 0.3755417,0.1863508 0.4728396,0.3576007 0.194601,0.3425003 0.1026345,0.8572334 -0.3343461,1.1110434 A 0.26458299,0.26458299 0 0 1 4.2334369,2.6550976 0.26458299,0.26458299 0 0 1 4.3290388,2.2938794 C 4.5555274,2.1623293 4.5373347,2.0194284 4.4701147,1.9011385 4.4029052,1.7828385 4.298871,1.6970556 4.063421,1.8329255 A 0.26458299,0.26458299 0 0 1 3.7022012,1.7352572 0.26458299,0.26458299 0 0 1 3.7978031,1.3740387 C 3.9636281,1.2783464 4.1372132,1.2432539 4.2990642,1.2551831 Z"
                  fill="#ff5b61" />
                <path
                  d="M 2.4573181,1.1554474 1.2434388,2.6571648 c -0.068794,0.085165 -0.078039,0.203903 -0.023257,0.2986897 l 0.7420716,1.2831257 c 0.054549,0.094429 0.1614435,0.1457209 0.2692347,0.129191 L 4.1398988,4.0689648 C 3.6781029,3.8097766 3.2513829,3.3787653 2.9306709,2.8235628 2.6098107,2.2681317 2.4507934,1.6848062 2.4573154,1.1554474 Z"
                  fill="#ff5b61" />
                <path
                  d="m 1.3800524,2.5613588 a 0.26460945,0.26460945 0 0 0 -0.10742,0.0352 l -0.33008,0.18945 c -0.62403,0.3601 -0.76385,1.02592 -0.5,1.47461 0.26385,0.44869 0.90874,0.65633 1.52539,0.30274 a 0.26460945,0.26460945 0 0 0 0.002,0 l 0.33008,-0.19141 a 0.26460945,0.26460945 0 0 0 0.0957,-0.36133 l -0.76171,-1.31836 a 0.26460945,0.26460945 0 0 0 -0.25391,-0.13086 z"
                  fill="#ff5b61" />
                <path
                  d="M 2.6655743,4.4317334 A 0.33343293,0.33343293 0 0 1 2.5415508,4.5593742 L 2.1255544,4.8007031 a 0.33343293,0.33343293 0 0 1 -0.0031,0 C 1.753402,5.0123182 1.3779609,5.0602559 1.0481049,4.9960399 l 0.5389853,0.9348267 a 0.26460945,0.26460945 0 0 0 0.00413,0.00568 c 0.2121985,0.34299 0.7000082,0.545024 1.1404997,0.3028239 a 0.26460945,0.26460945 0 0 0 0.00619,-0.00206 C 3.13762,6.0066499 3.2751901,5.4886796 3.0443518,5.0890595 Z"
                  fill="#ff5b61" />
              </g>
            </g>
          </svg>
        </div>
      </section>

      <section class="price-clientes">
        <div>
          <h2>A plan for every traveler</h2>
          <p>Pricing</p>

          <div class="planes">

            <div class="client-free caja">
              <h2>Free plan</h2>
              <h1 class="precio">0€ <span class="mes">/month</span></h1>
              <ul class="beneficios-lista">
                <li>✅ 3 Active trips</li>
                <li>✅ Basic community</li>
              </ul>
              <div class="ultimo">
                <button class="but-prices">Start for free</button>
              </div>
            </div>


            <div id="premium" class="client-premium caja">

              <h2>Premium plan</h2>
              <h1 class="precio">9€ <span class="mes">/month</span></h1>
              <ul class="beneficios-lista">
                <li>✅ Unlimited trips</li>
                <li>✅ No ads</li>
                <li>✅ Offline maps</li>
              </ul>
              <div class="ultimo">
                <button class="but-prices">Try Premium</button>
              </div>
            </div>


            <div class="client-anunciant caja">
              <h2>Advertiser plan</h2>
              <h1 class="precio" style="font-size: 2.5em !important;">Business</h1>
              <ul class="beneficios-lista">
                <li>✅ Advertise your business</li>
                <li>✅ Pro statistics</li>
              </ul>
              <div class="ultimo">
                <button class="but-prices">Contact us</button>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="join-us">
        <div>
          <h2>Start planning your trip now</h2>
          <div>
            <button class="join-us-button"><span>Start for free</span></button>
          </div>
          <p class="join-p">Join over 50,000 fellow travelers</p>
        </div>
      </section>
    </main>

    <footer></footer>
    <script src="./js/header.js"></script>
    <script src="./js/header.js"></script>

</body>

</html>