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
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="is-preload">
		<div id="page-wrapper">

			<!-- Header -->
				<div id="header">

					<!-- Logo -->
						<a href="index.php" id="logo"><img src="./images/logo-alceo.png" width="9%"></a>

					<!-- Nav -->
						<nav id="nav">
							<ul>
								<li class="current"><a href="index.php">Home</a></li>
								<li><a href="#">Comunidad</a></li></li>
								<li><a href="/paginas/area-usuario.html">Área de usuario</a></li>
								<li><a href="#">Contacto</a></li>
							</ul>
						</nav>

				</div>

			<!-- Banner -->
				<section id="banner">
					<header>
						<h2>Alceo: <em>Tu sitio de confianza para guardar tus rutinas y ejercicios favoritos</em></h2>
						<a href="#" class="button">Ir al generador</a>
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
									<a href="#" class="image left"><img src="images/pic01.png" alt="" /></a>
									<div class="inner">
									<?php
										$link = mysqli_connect('172.18.0.2', 'dbAdmin', 'C0nTr@s3ñ4', 'AlceoBD');
										echo "<h3>Hola que ase</h3>";
										echo "<h2>0.00 €</h2>";
										mysqli_close($link);
									?>
										<p>Duis neque nisi, dapibus sed mattis et quis, nibh. Sed et dapibus nisl amet mattis, sed a rutrum accumsan sed. Suspendisse eu.</p>
									</div>
								</div>
							</section>
							<section class="col-6 col-12-narrower">
								<div class="box post">
									<a href="#" class="image left"><img src="images/pic01.png" alt="" /></a>
									<div class="inner">
									<?php
										$link = mysqli_connect('172.18.0.2', 'dbAdmin', 'C0nTr@s3ñ4', 'AlceoBD');
										echo $nombre = mysqli_query($link, 'SELECT nombre FROM PLANES WHERE cod=1');
										echo "<h3>$nombre</h3>";
										echo "<h2>0.00 €</h2>";
										mysqli_close($link);
									?>
										<p>Guarda una unica rutina, ideal para quien quiere probar nuestro sistema de creación de rutinas.</p>
									</div>
								</div>
							</section>
						</div>
						<div class="row">
							<section class="col-6 col-12-narrower">
								<div class="box post">
									<a href="#" class="image left"><img src="images/pic01.png" alt="" /></a>
									<div class="inner">
									<?php
										$link = mysqli_connect('172.18.0.2', 'dbAdmin', 'C0nTr@s3ñ4', 'AlceoBD');
										echo "<h3>Hola que ase</h3>";
										echo "<h2>0.00 €</h2>";
										mysqli_close($link);
									?>
										<p¿>Quieres ir mas allá? Guarda hasta 4 rutinas con tu seguimiento de pesos y publica tus propios artículos en nuestra sección de blog y comenta en ellos.</p>
									</div>
								</div>
							</section>
							<section class="col-6 col-12-narrower">
								<div class="box post">
									<a href="#" class="image left"><img src="images/pic01.png" alt="" /></a>
									<div class="inner">
									<?php
										$link = mysqli_connect('172.18.0.2', 'dbAdmin', 'C0nTr@s3ñ4', 'AlceoBD');
										echo "<h3>Hola que ase</h3>";
										echo "<h2>0.00 €</h2>";
										mysqli_close($link);
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
							<a href="#" class="button">Ir al generador</a>
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
									<li><a href="#">HOME</a></li>
									<li><a href="#">COMUNIDAD</a></li>
									<li><a href="#">ÁREA DE USUARIO</a></li>
									<li><a href="#">CONTACTO</a></li>
								</ul>
							</section>
							<section class="col-3 col-6-narrower col-12-mobilep">
								<h3>CONTACTO</h3>
								<ul class="links">
									<li><a href="#">+34 656 698 565</a></li>
									<li><a href="#">info@alceo.com</a></li>
									<li><a href="#">IES Paco Mollá</a></li>
									<li><a href="#">De 08:00 a 14:00 y de 16:00 a 18:00</a></li>
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
							<li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
							<li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
							<li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
							<li><a href="#" class="icon brands fa-linkedin-in"><span class="label">LinkedIn</span></a></li>
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
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>