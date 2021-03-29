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
		<div id="page-wrapper">

			<!-- Header -->
				<div id="header">

					<!-- Logo -->
						<a href="../index.php" id="logo"><img src="../images/logo-alceo.png" width="9%"></a>

					<!-- Nav -->
						<nav id="nav">
							<ul>
								<li><a href="../index.php">Home</a></li>
								<li><a href="#">Comunidad</a></li></li>
								<li  class="current"><a href="/paginas/area-usuario.php">Área de usuario</a></li>
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

            <!-- Formulario Login -->
                <?php if(!empty($_SESSION['usuario'])) {
                    echo '<h1>Tamoh logueado: '.$_SESSION['usuario'].'</h1>'
                }
                ?>
                <div id="loginSignin">
                    <div id="login">
                        <form id="loginForm" action="../controllers/loginController.php" method="POST">
                            <label for="loginNombre">Usuario: </label>
                            <input type="text" id="loginNombre" name="loginNombre" required>
                            <?php if (!empty($usuarioError)) {echo '<p class="error">'.$usuarioError.'</p>';} ?>

                            <label for="loginContrasena">Contraseña: </label>
                            <input type="password" id="loginContrasena" name="loginContrasena" required>
                            <?php if (!empty($contrasenaError)) {echo '<p class="error">'.$contrasenaError.'</p>';} ?>
                            
                            <input type="submit" id="loginButton" value="Iniciar Sesión">
                        </form>
                    </div>
                    <p><em>¿Has olvidado tu contraseña?</em> Pues haber estudiado porque aún no tenemos esta función disponible :)</p>
                    <div id="signin">
                        <form id="signin" action="signin.php" method="POST">
                            <input type="submit" id="signinButton" value="Crear cuenta">
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
			<script src="../assets/js/jquery.min.js"></script>
			<script src="../assets/js/jquery.dropotron.min.js"></script>
			<script src="../assets/js/browser.min.js"></script>
			<script src="../assets/js/breakpoints.min.js"></script>
			<script src="../assets/js/util.js"></script>
			<script src="../assets/js/main.js"></script>

	</body>
</html>