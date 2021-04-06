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
		session_start();
        if (!empty($_SESSION['usuario'])) {
			$inactividad = 3600;
			if(isset($_SESSION["timeout"])){
				$sessionTTL = time() - $_SESSION["timeout"];
				if($sessionTTL > $inactividad){
					session_destroy();
					header("Location: /paginas/area-usuario.php");
				}
			}
            if ($_SESSION['usuario'] === 'admin') {
        ?>
		<div id="page-wrapper">

			<!-- Header -->
				<div id="header">

					<!-- Logo -->
						<a href="/index.php" id="logo"><img src="/images/logo-alceo.png" width="9%"></a>

					<!-- Nav -->
						<nav id="nav">
							<ul>
								<li><a href="/index.php">Home</a></li>
                                <li><a href="/admin/index.php">Admin Home</a></li>
								<li class="current"><a href="/controllers/ejercicioController.php">Ejercicios</a></li>
								<li><a href="/controllers/grupoM/grupoMController.php">Grupos Musculares</a></li>
                                <li><a href="/controllers/material/materialController.php">Material</a></li>
                                <li><a href="/controllers/objetivo/objetivoController.php">Objetivo</a></li>

							</ul>
						</nav>
				</div>

            <!-- Modificacion -->
                <div>
                    <h2 class="tituloForm">Ejercicios</h2>
                    <div id="alter">
                        <form id="selectForm">
                            <label for="">Selecciona un ejercicio:</label>
                            <select id="ejercicio" onchange='<?php echo 'changeValues('.json_encode($ejercicios).')'; ?>'>
                                <option disabled selected>No seleccionado</option>
                                <?php 
                                    foreach ($options as $option) {
                                        echo $option;
                                    }
                                ?>
                            </select>
                        </form>
                        <form id="alterForm" action="/controllers/ejercicioController.php" method="POST">
                            <label for="nombre">Nombre: </label>
                            <input type="text" id="nombre" name="nombre" required>
                            <?php if (!empty($nombreError)) {echo '<p class="error">'.$nombreError.'</p>';}?>

                            <label for="dificultad">Dificultad: </label>
                            <input type="number" min="1" max="5" id="dificultad" name="dificultad" required>
                            
                            <label for="foto">Foto: </label>
                            <input type="file" id="foto" name="foto">
                            <?php if (!empty($fotoError)) {echo '<p class="error">'.$fotoError.'</p>';}?>

                            <label for="video">Video: </label>
                            <input type="file" id="video" name="video">
                            <?php if (!empty($videoError)) {echo '<p class="error">'.$videoError.'</p>';}?>
                            <br><br>
                            <input type="hidden" id="id" name="id" value="">
                            <input type="submit" id="editarEjercicio" name="editarEjercicio" value="Editar Ejercicio">
                        </form>
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
        <script src="/js/ejercicios/ejercicio.js"></script>

        <?php 
            } else {

        ?>
            <div>
                <h2 class="error">Acceso no autorizado</h2>
                <a href="/index.php">Vuelta a la pagina principal</a>
            </div>
        <?php 
            }
        } else {
        ?>
        <div>
                <h2 class="error">Tienes que iniciar sesion para acceder</h2>
                <a href="/index.php">Vuelta a la pagina principal</a>
            </div>

        <?php } ?>

	</body>
</html>