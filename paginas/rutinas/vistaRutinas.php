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
        if (!empty($_SESSION['usuario'])) {
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
							<li><a href="/index.php">Home</a></li>
							<li><a href="/controllers/areaUsuarioController.php">Área de usuario</a></li>
							<li class="current"><a href="/controllers/rutinas/rutinasController.php">Rutinas</a></li>
							<li><a href="/paginas/contacto.php">Contacto</a></li>
						</ul>
					</nav>
				</div>

			<!-- Banner -->
				<section id="banner">
					<header>
						<h2>Alceo: <em>Tu sitio de confianza para guardar tus rutinas y ejercicios favoritos</em></h2>
						<form method="POST" action="/controllers/rutinas/rutinasController.php" id="formBotonGenerador">
							<button type="submit" name="generarRutina" id="generarRutina" class="button" value="Ir al generador">
							Ir al generador
							</button>
                        </form>
					</header>
				</section>

			<!-- Highlights -->
                <?php
                if (!empty($rutina)) {

                ?>

                <div>
                    <h2 id="titulo-generador"><?php echo $rutina['nombre']; ?></h2>
					<div class="container">
						<div class="row gtr-200">
                        <section class="col-6 col-12-narrower">
                        <div class="cuadrados-flotantes">
								<div class="box highlight">
								<p>Duración: <?php echo $rutina['duracion']; ?></p>
								</div>
                                </div>
							</section>
                        <section class="col-6 col-12-narrower">
								<div class="box highlight">
                                <p>Fecha: <?php echo $rutina['fecha']; ?></p>
								</div>
							</section>
						</div>
					</div>
					<div class="container">
						<div class="row gtr-200">
                        <section class="col-6 col-12-narrower">
                        <div class="cuadrados-flotantes">
								<div class="box highlight">
								<p>Dificultad: <?php echo $rutina['dificultad']; ?></p>
								</div>
                                </div>
							</section>
                        <section class="col-6 col-12-narrower">
								<div class="box highlight">
                                <p>Objetivo: <?php echo $objetivo; ?></p>
								</div>
							</section>
						</div>
					</div>	
                </div>
				<section class="wrapper style1">
                <div class="tabla"> 
                    <table id="ejercicios">
                        <tr><td>Nombre</td><td>Series</td><td>Repeticiones</td><td>Descanso</td><td>Dificultad</td><td>Multimedia</td></tr>
						<?php
						foreach ($ejercicios as $ejercicio) {
							echo $ejercicio;
						}
						?>
                    </table>
                </div>
				<br>
				<div class="divAlCentro">
					<form action="/controllers/rutinas/vistaRutinasController.php" method="POST">
						<input type="hidden" name="idBorrarRutina" id="idBorrarRutina" value=<?php echo $rutina['cod']; ?>>
						<input type="submit" name="deleteForm" id="deleteForm" value="Borrar Rutina">
					</form>
				</div>
				<div id="popup-wrapper">
							<div id="popup">
								<div id="popup-close">x</div>
								<div id="popup-content">
									<video id="videoEjercicio" controls>
										Your browser does not support the video tag.
									</video>
									<img id="imagenEjercicio" src="" alt="Imagen del ejercicio" height="500">
								</div>
							</div>
						</div>
                <?php
                }
                ?>
					
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

		<!-- Scripts -->
			<script src="/assets/js/jquery.min.js"></script>
			<script src="/assets/js/jquery.dropotron.min.js"></script>
			<script src="/assets/js/browser.min.js"></script>
			<script src="/assets/js/breakpoints.min.js"></script>
			<script src="/assets/js/util.js"></script>
			<script src="/assets/js/main.js"></script>
			<script src="/js/rutinas/vistaRutinas.js"></script>
        
        <?php    
            } else {
        ?>
        <div>
                <h2 class="error">Tienes que iniciar sesion para acceder</h2>
                <a href="/index.php">Vuelta a la pagina principal</a>
            </div>

        <?php } ?>
	</body>
</html>