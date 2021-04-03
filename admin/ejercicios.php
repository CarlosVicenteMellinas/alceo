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
			$inactividad = 600;
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
								<li><a href="#">Comunidad</a></li></li>
								<li class="current"><a href="/controllers/ejercicioController.php">Ejercicios</a></li>
								<li><a href="/controllers/grupoM/grupoMController.php">Grupos Musculares</a></li>
							</ul>
						</nav>
				</div>

            <!-- Creacion -->
                <div>
                    <h2 class="tituloForm">Ejercicios</h2>
                    <div id="forms">
                        <form id="addForm" action="/controllers/ejercicioController.php" method="POST">
                            <input type="submit" id="addForm" name="addForm" value="Crear Ejercicio">
                            <label for="addForm">Añade un nuevo ejercicio</label>
                        </form>
                        <form id="editForm" action="/controllers/ejercicioController.php" method="POST">
                            <input type="submit" name="editForm" id="editForm" value="Editar Ejercicio">
                            <label for="editForm">Edita un ejercicio ya existente</label>
                        </form>
                        <form id="deleteForm" action="/controllers/ejercicioController.php" method="POST">
                            <input type="submit" name="deleteForm" id="deleteForm" value="Borrar Ejercicio">
                            <label for="deleteForm">Elimina un ejercicio</label>
                        </form>
                    </div>
                </div>
                <div class="tabla"> 
                    <h3>Ejercicios disponibles:</h3>
                    <table id="ejercicios">
                        <tr><td>Cod</td><td>Nombre</td><td>Dificultad</td><td>Foto</td><td>Video</td></tr>
                        <?php
                        foreach ($ejercicios as $ejercicio) {
                            echo $ejercicio;
                        }
                        ?>
                    </table>
                </div>
        </div>

         <!-- Scripts -->
        <script src="/assets/js/jquery.min.js"></script>
        <script src="/assets/js/jquery.dropotron.min.js"></script>
        <script src="/assets/js/browser.min.js"></script>
        <script src="/assets/js/breakpoints.min.js"></script>
        <script src="/assets/js/util.js"></script>
        <script src="/assets/js/main.js"></script>

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