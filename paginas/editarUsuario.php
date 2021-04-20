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
        $inactividad = 3600;
        if(!empty($_SESSION["timeout"])){
            $sessionTTL = time() - $_SESSION["timeout"];
            if($sessionTTL > $inactividad){
                session_destroy();
                header("Location: /paginas/area-usuario.php");
            }
        }             
        if(!empty($_SESSION['usuario'])) { 
        ?>
		<div id="page-wrapper">

			<!-- Header -->
				<div id="header">
                <!-- Logo -->
                    <a href="../index.php" id="logo"><img src="/images/logo-alceo.png" width="9%"></a>

                <!-- Nav -->
                    <nav id="nav">
                        <ul>
                            <li><a href="/index.php">Home</a></li>
                            <li><a href="#">Comunidad</a></li>
                            <li class="current"><a href="/controllers/areaUsuarioController.php">Área de usuario</a></li>
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
            <!-- Area Usuario -->
            <div style="text-align:center; margin:auto; padding: 30px 0px 30px 0px">
                <img class="foto_perfil" width="150" src="/images/logo-alceo.png">
                <?php echo '<h1>Nick: '.$_SESSION['usuario'].'</h1>'; ?>
            </div>
            <div id="editPerfil">
                <form id="editUserForm" method="POST" action="/controllers/editarUsuarioController.php">
                    <label for="nombre" >Nombre Completo: </label>
                    <input type="text" id="nombre" name="nombre" value=<?php echo '"'.$usuario['nombre'].'"' ?> required>
                    <input type="hidden" id="nombre2" name="nombre2" value=<?php echo '"'.$usuario['nombre'].'"' ?>>
                    <?php if (!empty($nombreError)) {echo '<p class="error">'.$nombreError.'</p>';} ?>

                    <label for="nick" >Nombre de Usuario: </label>
                    <input type="text" id="nick" name="nick" value=<?php echo '"'.$usuario['nickname'].'"' ?> required>
                    <input type="hidden" id="nick2" name="nick2" value=<?php echo '"'.$usuario['nickname'].'"' ?>>
                    <?php if (!empty($nickError)) {echo '<p class="error">'.$nickError.'</p>';} ?>
                    
                    <label for="contrasena">Contraseña Actual: </label>
                    <input type="password" id="contrasena" name="contrasena" required>
                    <?php if (!empty($contasenaError)) {echo '<p class="error">'.$contasenaError.'</p>';} ?>

                    <label for="Ncontrasena">Nueva Contraseña: </label>
                    <input type="password" id="Ncontrasena" name="Ncontrasena">
                    <?php if (!empty($NcontasenaError)) {echo '<p class="error">'.$NcontasenaError.'</p>';} ?>
                    
                    <label for="Ncontrasena2">Vuelve a introducir la nueva contraseña: </label>
                    <input type="password" id="Ncontrasena2" name="Ncontrasena2">
                    
                    <label for="correo">Correo Electronico: </label>
                    <input type="email" id="correo" name="correo" value=<?php echo '"'.$usuario['correo'].'"' ?> required>
                    <input type="hidden" id="correo2" name="correo2" value=<?php echo '"'.$usuario['correo'].'"' ?>>
                    <?php if (!empty($emailError)) {echo '<p class="error">'.$emailError.'</p>';} ?>

                    <label for="telefono">Telefono: </label>                        
                    <input type="tel" id="telefono" name="telefono" pattern="[0-9]{9}" value=<?php echo '"'.$usuario['telefono'].'"' ?>>
                    <label for="plan">Plan</label>
                    <select id="plan" name="plan" required>
                        <?php 
                            foreach ($options as $option) {
                                echo $option;
                            }
                        ?>
                    </select>
                    <br><br>
                    <input type="hidden" id="id" name="id" value=<?php echo $usuario['cod'] ?>>
                    <input type="submit" id="editar" name='editar' value="Editar perfil">
                </form>
            </div>
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
		<!-- Scripts -->
			<script src="/assets/js/jquery.min.js"></script>
			<script src="/assets/js/jquery.dropotron.min.js"></script>
			<script src="/assets/js/browser.min.js"></script>
			<script src="/assets/js/breakpoints.min.js"></script>
			<script src="/assets/js/util.js"></script>
			<script src="/assets/js/main.js"></script>

    <?php 
        } else {
            header("Location: /paginas/fail.php");
        }
    ?>
	</body>
</html>
