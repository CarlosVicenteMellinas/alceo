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
		<link rel="stylesheet" href="../assets/css/main.css" />
	</head>
	<body class="is-preload">
        <?php 
        session_start();
        if (!empty($_SESSION['usuario'])) {
            if ($_SESSION['usuario'] === 'admin') {
        ?>
		<div id="page-wrapper">

			<!-- Header -->
				<div id="header">

					<!-- Logo -->
						<a href="../index.php" id="logo"><img src="..//images/logo-alceo.png" width="9%"></a>

					<!-- Nav -->
						<nav id="nav">
							<ul>
								<li class="current"><a href="../index.php">Home</a></li>
                                <li><a href="index.php">Admin Home</a></li>
								<li><a href="#">Comunidad</a></li></li>
								<li><a href="ejercicios.php">Ejercicios</a></li>
								<li><a href="#">Grupos Musculares</a></li>
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

            <!-- Creacion -->
                <div>
                    <h2>Ejercicios</h2>
                    <div id="insert">
                        <form id="insertForm" action="../controllers/ejercicioController.php" method="POST">
                            <label for="nombre">Nombre: </label>
                            <input type="text" id="nombre" name="nombre" required>
                            <?php if (!empty($nombreError)) {echo '<p class="error">'.$nombreError.'</p>';}?>

                            <label for="dificultad">Dificultad: </label>
                            <input type="number" min="1" max="5" id="dificultad" name="dificultad" required>
                            
                            <label for="foto">Foto: </label>
                            <input type="file" id="foto" name="foto">
                            <?php if (!empty($fotoError)) {echo '<p class="error">'.$nombreError.'</p>';}?>

                            <label for="video">Video: </label>
                            <input type="file" id="video" name="video">
                            <?php if (!empty($videoError)) {echo '<p class="error">'.$nombreError.'</p>';}?>

                            <input type="submit" id="crearEjercicio" value="Crear Ejercicio">
                        </form>
                    </div>
                </div>

            <!-- Modificacion -->

            <!-- Eliminación -->
        </div>

         <!-- Scripts -->
        <script src="../assets/js/jquery.min.js"></script>
        <script src="../assets/js/jquery.dropotron.min.js"></script>
        <script src="../assets/js/browser.min.js"></script>
        <script src="../assets/js/breakpoints.min.js"></script>
        <script src="../assets/js/util.js"></script>
        <script src="../assets/js/main.js"></script>

        <?php 
            } else {

        ?>
            <div>
                <h2 class="error">Acceso no autorizado</h2>
                <a href="../index.php">Vuelta a la pagina principal</a>
            </div>
        <?php 
            }
        } else {
        ?>
        <div>
                <h2 class="error">Tienes que iniciar sesion para acceder</h2>
                <a href="../index.php">Vuelta a la pagina principal</a>
            </div>

        <?php } ?>
       
	</body>
</html>