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
				<a href="index.php" id="logo"><img src="/images/logo-alceo-completo.png"  width="20%"></a>

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
						<?php
						if (!empty($mensaje)) {
                        	echo $mensaje;
                    	}
						?>
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
							<label for="duracion">Duración (Minutos):</label>
							<input type="number" name="duracion" id="duracion" required>
						</div>
						</br>
						<div>
							<label for="dificultad">Dificultad:</label>
							<input type="number" name="dificultad" id="dificultad" readonly required>
						</div>
						</br>
						<input type="hidden" name="fecha" id="fecha" value=<?php echo date('Y-m-d');?>>
						<h3>Ejercicios:</h3>
						<div id="divEjerciciosRutina">
							<div id="ejerciciosAnyadidosDiv"></div>
							<div style="text-align:center; margin:auto">
									<div id="botonAnyadir" class="formatoBoton"><p>Añadir Ejercicio</p></div>
							</div>
						</div>
						<br>
						<div class="divAlCentro">
						<input type="submit" name="enviar" id="enviar" class="formatoBotonDerecha" value="Guardar Rutina">
						</div>
						<div id="popup-wrapper">
							<div id="popup">
								<div id="popup-close">x</div>
								<div id="popup-content">
									<h2>Añade un ejercicio</h2>
									
									<label for="ejercicio">Ejercicio:</label>
									<select id="ejercicio" name="ejercicio" onchange='<?php echo 'changeValues('.json_encode($ejercicios).','.json_encode($gruposM2).','.json_encode($gruposMEjercicios).','.json_encode($materiales2).','.json_encode($materialEjercicio).')'; ?>'required>
										<option value="0" selected disabled>No seleccionado</option>
										<?php 
											foreach ($EjOptions as $option) {
												echo $option;
											}
										?>
									</select>
									<br>
									<p id="dificultadText">Dificultad: </p>
									<label for="grupoM">Grupos Musculares: </label>
									<div id="gm"></div>
									<br>
									<label for="material">Materiales: </label>
									<div id="mat"></div>
									<br>
									<div class="item-popup">
									<label for="repeticiones">Repeticiones: </label>
                            		<input type="number" min="1" max="50" id="repeticiones" name="repeticiones">
									</div>
									<div class="item-popup">
									<label for="series">Series: </label>
                            		<input type="number" min="1" max="10" id="series" name="series">	
									</div>
									<div class="item-popup">
									<label for="descanso">Descanso: </label>
                            		<input type="number" min="1" max="300" id="descanso" name="descanso">
									</div>
									<div style="text-align:center; margin:auto">
										<div id="botonAnyadir2" class="formatoBoton"><p>Añadir</p></div>
									</div>		
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
					<!-- Copyright -->
						<div class="copyright" style="marign: auto; text-align: center; padding-top:60px">
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