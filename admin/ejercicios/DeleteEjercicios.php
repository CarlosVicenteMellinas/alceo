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
						<a href="../index.php" id="logo"><img src="../images/logo-alceo.png" width="9%"></a>

					<!-- Nav -->
						<nav id="nav">
							<ul>
								<li><a href="../index.php">Home</a></li>
                                <li><a href="../admin/index.php">Admin Home</a></li>
								<li><a href="#">Comunidad</a></li></li>
								<li class="current"><a href="../admin/ejercicios.php">Ejercicios</a></li>
								<li><a href="#">Grupos Musculares</a></li>
							</ul>
						</nav>
				</div>

            <!-- Eliminacion -->
                <div>
                    <h2 class="tituloForm">Ejercicios</h2>
                    <div id="alter">
                        <form id="selectForm" action="../controllers/ejercicioController.php" method="POST">
                            <label for="">Selecciona un ejercicio:</label>
                            <select id="ejercicio" onchange='<?php echo 'setID('.json_encode($ejercicios).')'; ?>'>
                                <option disabled selected>No seleccionado</option>
                                <?php 
                                    foreach ($options as $option) {
                                        echo $option;
                                    }
                                ?>
                            </select>
                            <br><br>
                            <input type="hidden" id="id" name="id" value="">
                            <input type="submit" id="eliminarEjercicio" name="eliminarEjercicio" value="Eliminar Ejercicio">
                        </form>
                    </div>
                </div>
        </div>

         <!-- Scripts -->
        <script src="../assets/js/jquery.min.js"></script>
        <script src="../assets/js/jquery.dropotron.min.js"></script>
        <script src="../assets/js/browser.min.js"></script>
        <script src="../assets/js/breakpoints.min.js"></script>
        <script src="../assets/js/util.js"></script>
        <script src="../assets/js/main.js"></script>
        <script src="../js/ejercicios/ejercicio.js"></script>

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