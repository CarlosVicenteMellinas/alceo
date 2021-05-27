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
	    session_start();
        $inactividad = 3600;
        if(!empty($_SESSION["timeout"])){
            $sessionTTL = time() - $_SESSION["timeout"];
            if($sessionTTL > $inactividad){
                session_destroy();
                header("Location: /paginas/area-usuario.php");
            }
        } 
        ?>
		<div id="page-wrapper">

			<!-- Header -->
				<div id="header">
				<!-- Logo -->
					<a href="/index.php" id="logo"><img src="/images/logo-alceo-completo.png"  width="20%"></a>

				<!-- Nav -->
					<nav id="nav">
						<ul>
						<?php if (!empty($_SESSION['usuario'])) { ?>
							<li class="current"><a href="/index.php">Home</a></li>
							<li><a href="/controllers/areaUsuarioController.php">Área de usuario</a></li>
							<li><a href="/controllers/rutinas/rutinasController.php">Rutinas</a></li>
							<li><a href="/paginas/contacto.php">Contacto</a></li>
						<?php } else { ?>
							<li class="current"><a href="/index.php">Home</a></li>
							<li><a href="/controllers/areaUsuarioController.php">Área de usuario</a></li>
							<li><a href="/paginas/contacto.php">Contacto</a></li>
						<?php } ?>
						</ul>
					</nav>
				</div>

			<!-- Banner -->
				<section id="banner">
					<header>
						<h2>Alceo: <em>Tu sitio de confianza para guardar tus rutinas y ejercicios favoritos</em></h2>
						<a href="/controllers/areaUsuarioController.php" class="button">Ir al generador</a>
					</header>
				</section>

			<!-- Highlights -->
				<section class="wrapper style1">
					<div class="container">
						<div class="row gtr-200">
							<section class="col-4 col-12-narrower">
								<div class="box highlight">
									<i class="icon solid major fa-dumbbell"></i>
									<h3>Saca el máximo partido a tus entrenamientos</h3>
									<p>Descubre nuevos ejercicos que no conocías y añade tus pesos para ver tu mejora individual por ejercicio</p>
								</div>
							</section>
							<section class="col-4 col-12-narrower">
								<div class="box highlight">
									<i class="icon solid major fa-heartbeat"></i>
									<h3>Aumenta tu salud</h3>
									<p>Ajusta tu tiempo para tus entrenamientos y logra entrenar en cualquier lugar y con cualquier material. ¡No hay excusa!</p>
								</div>
							</section>
							<section class="col-4 col-12-narrower">
								<div class="box highlight">
									<i class="icon solid major fa-save"></i>
									<h3>Guarda tus rutinas y compartelas con el resto de usuarios</h3>
									<p>Centraliza todas tus rutinas y olvidate del papel. Comparte tus creaciones con todo el mundo y ayudemonos entre nuestra comunidad</p>
								</div>
							</section>
						</div>
					</div>
				</section>

			<!-- Gigantic Heading -->
				<section class="wrapper style2">
					<div class="container">
						<header class="major">
							<h2>No es solo un generador de Rutinas</h2>
							<p>Somos tus entrenadores personales</p>
						</header>
					</div>
				</section>

			<!-- Posts -->
				<section class="wrapper style1">
					<div class="container">
						<div class="row">
							<section class="col-6 col-12-narrower">
								<div class="box post">
									<a class="image left"><img src="images/gratuito.png" alt="" /></a>
									<div class="inner">
									<?php
										echo "<h3>".$plan1["nombre"]."</h3>";
										echo "<h2>".$plan1["precio"]." €</h2>";
									?>
										<p>Navega por la interfaz de toda nuestra página web y informate de las últimas noticias de nuestro foro.</p>
									</div>
								</div>
							</section>
							<section class="col-6 col-12-narrower">
								<div class="box post">
									<a class="image left"><img src="images/estandar.png" alt="" /></a>
									<div class="inner">
									<?php
										echo "<h3>".$plan2["nombre"]."</h3>";
										echo "<h2>".$plan2["precio"]." €</h2>";
									?>
										<p>Guarda una unica rutina, ideal para quien quiere probar nuestro sistema de creación de rutinas.</p>
									</div>
								</div>
							</section>
						</div>
						<div class="row">
							<section class="col-6 col-12-narrower">
								<div class="box post">
									<a class="image left"><img src="images/premium.png" alt="" /></a>
									<div class="inner">
									<?php
										echo "<h3>".$plan3["nombre"]."</h3>";
										echo "<h2>".$plan3["precio"]." €</h2>";
									?>
										<p¿>Quieres ir mas allá? Guarda hasta 4 rutinas con tu seguimiento de pesos y publica tus propios artículos en nuestra sección de blog y comenta en ellos.</p>
									</div>
								</div>
							</section>
							<section class="col-6 col-12-narrower">
								<div class="box post">
									<a class="image left"><img src="images/personal_trainer.png" alt="" /></a>
									<div class="inner">
									<?php
										echo "<h3>".$plan4["nombre"]."</h3>";
										echo "<h2>".$plan4["precio"]." €</h2>";
									?>
										<p>¿Eres un profesional del sector y te dedicas a ello? Guarda todas las rutinas que quieras, compartelas con otros usuarios individualizando la tabla de pesos y publica tus propios artículos en nuestra sección de blog y comenta en ellos.</p>
									</div>
								</div>
							</section>
						</div>
					</div>
				</section>

			<!-- CTA -->
				<section id="cta" class="wrapper style3">
					<div class="container">
						<header>
							<h2>¿Te hemos convencido? Tu nuevo estilo de vida a solo un click</h2>
							<a href="/controllers/areaUsuarioController.php" class="button">Ir al generador</a>
						</header>
					</div>
				</section>

			<!-- Footer -->
				<div id="footer">
					<div class="container">
						<div class="row">
							<section class="col-3 col-6-narrower col-12-mobilep">
								<h3>MENÚ</h3>
								<ul class="links">
									<li><a href="/index.php">Home</a></li>
									<li><a href="#">Comunidad</a></li>
									<li><a href="/controllers/areaUsuarioController.php">Área de usuario</a></li>
									<li><a href="/paginas/contacto.php">Contacto</a></li>
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
								<form>
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
								<li>&copy; Alceo. All rights reserved</li><li>Design: <a href="#">Carlos Vicente Mellinas y Pascual Vicedo Guerra</a></li>
							</ul>
						</div>

				</div>

		</div>

		<!-- Scripts -->
			<script src="/assets/js/jquery.min.js"></script>
			<script src="/assets/js/jquery.dropotron.min.js"></script>
			<script src="/assets/js/browser.min.js"></script>
			<script src="/assets/js/breakpoints.min.js"></script>
			<script src="/assets/js/util.js"></script>
			<script src="/assets/js/main.js"></script>

	</body>
</html>