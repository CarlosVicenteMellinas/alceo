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
					<a href="index.php" id="logo"><img src="/images/logo-alceo.png" width="9%"></a>

				<!-- Nav -->
					<nav id="nav">
						<ul>
							<li><a href="/index.php">Home</a></li>
							<li><a href="#">Comunidad</a></li>
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
						<a href="/controllers/areaUsuarioController.php" class="button">Ir al generador</a>
					</header>
				</section>

			<!-- Highlights -->
                <div class="generador-manual">
					<form method="POST" action="generadorManualController.php">
						<h2 id="titulo-generador">Generador Manual</h2>
						<div>
							<label for="objetivo">Objetivo:</label>
							<select id="objetivo" name="objetivo" required>
								<option selected disabled>No seleccionado</option>
								<?php 
									foreach ($options as $option) {
										echo $option;
									}
								?>
							</select>
						</div>
						</br>
						<div>
							<label for="nombre">Nombre:</label>
							<input type="text" id="nombre" name="nombre" required>
						</div>
						</br>
						<div>
							<label for="dificultad">Dificultad:</label>
							<input type="number" name="dificultad" id="dificultad" readonly required>
						</div>
						</br>
						<div>
							<label for="duracion">Duracion:</label>
							<input type="text" name="duracion" id="duracion" required>
						</div>
						<input type="hidden" name="fecha" id="fecha">
						<h3>Ejercicios:</h3>
						<div id="ejerciciosAnyadidos">
							<div>
								<input type="hidden" value="Muestra" name="ejercicio-1">
								<input type="hidden" value="Muestra" name="repes-1">
								<input type="hidden" value="Muestra" name="series-1">
								<input type="hidden" value="Muestra" name="duracion-1">
								<p>Ejercicio de muestra</p>
								<p>Repeticones de muestra</p>
								<p>Series de muestra</p>
								<p>Duracion de muestra</p>
								<p>Dificultad de muestra</p>
							</div>
							<div style="text-align:center; margin:auto">
								<div id="botonAnyadir" class="formatoBoton"><p>Añadir Ejercicio</p></div>
							</div>
						</div>
						<input type="submit" name="enviar" id="enviar" class="formatoBotonDerecha" value="Guardar Rutina">
						<div id="popup-wrapper">
							<div id="popup">
								<div id="popup-close">x</div>
								<div id="popup-content">
									<h2>Añade un ejercicio</h2>
									<label for="ejercicio">Ejercicio:</label>
									<select id="ejercicio" name="ejercicio" onchange='<?php echo 'changeValues('.json_encode($ejercicios).','.json_encode($gruposM2).','.json_encode($gruposMEjercicios).','.json_encode($materiales2).','.json_encode($materialEjercicio).')'; ?>'required>
										<option selected disabled>No seleccionado</option>
										<?php 
											foreach ($EjOptions as $option) {
												echo $option;
											}
										?>
									</select>
									<p id="dificultadText">Dificultad: </p>
									<label for="grupoM">Grupos Musculares: </label>
									<div id="gm"></div>
									<label for="material">Materiales: </label>
									<div id="mat"></div>
									<label for="repeticiones">Repeticiones: </label>
                            		<input type="number" min="1" max="50" id="repeticiones" name="repeticiones" required>
									<label for="series">Series: </label>
                            		<input type="number" min="1" max="10" id="series" name="series" required>	
									<label for="descanso">Descanso: </label>
                            		<input type="number" min="1" max="300" id="descanso" name="descanso" required>
									<div style="text-align:center; margin:auto">
										<div id="botonAnyadir2" class="formatoBoton"><p>Añadir</p></div>
									</div>		
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
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
			<script src="/js/rutinas/generadorRutinas.js"></script>
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