<!DOCTYPE HTML>
<!--
	Arcana by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Alceo - Deporte y Salud en tu mano</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="/assets/css/main.css" />
		<link rel="icon" type="image/png" href="/images/logo-alceo.png">
	</head>
	<body class="is-preload">
		<?php
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $inactividad = 3600;
        if(!empty($_SESSION["timeout"])){
            $sessionTTL = time() - $_SESSION["timeout"];
            if($sessionTTL > $inactividad){
                session_destroy();
                header("Location: /paginas/area-usuario.php");
            }
        }
        if (!empty($respuesta)) {
        
        ?>
		<div id="page-wrapper">

        <div id="header">
				<!-- Logo -->
				<a href="/index.php" id="logo"><img src="/images/logo-alceo-completo.png"  width="20%"></a>

				<!-- Nav -->
					<nav id="nav">
						<ul>
						<?php if (!empty($_SESSION['usuario'])) { ?>
							<li><a href="/index.php">Home</a></li>
							<li><a href="/controllers/areaUsuarioController.php">Área de usuario</a></li>
							<li><a href="/controllers/rutinas/rutinasController.php">Rutinas</a></li>
							<li class="current"><a href="/paginas/contacto.php">Contacto</a></li>
						<?php } else { ?>
							<li><a href="/index.php">Home</a></li>
							<li><a href="/controllers/areaUsuarioController.php">Área de usuario</a></li>
							<li class="current"><a href="/paginas/contacto.php">Contacto</a></li>
						<?php } ?>
						</ul>
					</nav>
				</div>

			<!-- Banner -->
				<section id="banner">
					<header>
						<h2>Alceo: <em>Tu sitio de confianza para guardar tus rutinas y ejercicios favoritos</em></h2>
						<?php
                            if (!empty($_SESSION['usuario'])) {
                        ?>
						<form method="POST" action="/controllers/rutinas/rutinasController.php" id="formBotonGenerador">
							<button type="submit" name="generarRutina" id="generarRutina" class="button" value="Ir al generador">
							Ir al generador
							</button>
                        </form>
                        <?php
                            } else {
                        ?>
                        <a href="/controllers/areaUsuarioController.php" class="button">Ir al generador</a>
                        <?php } ?>
					</header>
				</section>
                <div class="respuestaMail">
                    <?php 
                        echo $respuesta;
                    ?>
                </div>
			<!-- Footer -->
				<div id="footer">
					<div class="container">
						<div class="row">
							<section class="col-3 col-6-narrower col-12-mobilep">
								<h3>MENÚ</h3>
								<ul class="links">
									<li><a href="/index.php">HOME</a></li>
									<li><a href="#">COMUNIDAD</a></li>
									<li><a href="/controllers/areaUsuarioController.php">ÁREA DE USUARIO</a></li>
									<li><a href="/contacto.php">>CONTACTO</a></li>
								</ul>
							</section>
							<section class="col-3 col-6-narrower col-12-mobilep">
								<h3>CONTACTO</h3>
								<ul class="links">
									<li><a href="tel:+34656698565">+34 656 698 565</a></li>
									<li><a href="mailto:info@alceo.com">info@alceo.com</a></li>
									<li>>IES Paco Mollá</li>
									<li>De 08:00 a 14:00 y de 16:00 a 18:00</li>
								</ul>
							</section>
							<section class="col-6 col-12-narrower">
								<h3>CONTÁCTANOS</h3>
								<form action="/controllers/contactoController.php" method="POST">
									<div class="row gtr-50">
										<div class="col-6 col-12-mobilep">
											<input type="text" name="name" id="name" placeholder="Name" />
										</div>
										<div class="col-6 col-12-mobilep">
											<input type="email" name="email" id="email" placeholder="Email" />
										</div>
										<div class="col-12">
											<textarea name="message" id="message" placeholder="Message" rows="5"></textarea>
										</div>
										<div class="col-12">
											<ul class="actions">
												<li><input type="submit" class="button alt" value="Send Message" /></li>
											</ul>
										</div>
									</div>
								</form>
							</section>
						</div>
					</div>
					<!-- Icons -->
						<ul class="icons">
							<li><a href="https://www.instagram.com/" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
							<li><a href="https://twitter.com/" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
							<li><a href="https://www.facebook.com/" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
							<li><a href="https://www.linkedin.com/" class="icon brands fa-linkedin-in"><span class="label">LinkedIn</span></a></li>
						</ul>

					<!-- Copyright -->
						<div class="copyright">
							<ul class="menu">
								<li>&copy; Alceo. All rights reserved</li><li>Design: Carlos Vicente Mellinas y Pascual Vicedo Guerra</li>
							</ul>
						</div>

				</div>

		</div>
        <?php
        } else {

        ?>
            <div>
                <h2 class="error">Error inesperado</h2>
                <a href="/index.php">Vuelta a la pagina principal</a>
            </div>
        <?php 

        }
        ?>

		<!-- Scripts -->
			<script src="/assets/js/jquery.min.js"></script>
			<script src="/assets/js/jquery.dropotron.min.js"></script>
			<script src="/assets/js/browser.min.js"></script>
			<script src="/assets/js/breakpoints.min.js"></script>
			<script src="/assets/js/util.js"></script>
			<script src="/assets/js/main.js"></script>

	</body>
</html>