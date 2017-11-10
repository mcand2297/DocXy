<!DOCTYPE HTML>
<!--
	Alpha by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)

    Edited by Richard Camacho
-->
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width , user-scalable=no">
				<meta name="csrf-token" content="{{ csrf_token() }}">
				<meta name="theme-color" content="#3674d6" />
        <link href="assets/images/logo/logo.png" type="image/png" rel="shortcut icon">

      	<title>Bienvenido a DocXy</title>
		<link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="assets/icomoon/iconos.css">

	</head>
	<body class="landing">
		<div id="page-wrapper">

			<!-- Header -->
				<header id="header" class="alt">
					<h1>DocXy</h1>
				</header>

			<!-- Banner -->
				<section id="banner">
					<h2>Bienvenido a DocXy</h2>
					<p>La herramienta web para seguir el proceso educativo de los estudiantes</p>

                    <ul class="burbujas">
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>


				</section>

			<!-- Main -->
				<section id="main" class="container">

					<section class="box special">
						<header class="major">
							<h2>Eres miembro de la comunidad DocXy</h2>
							<p>Ingresa en tu perfil para saber que hay de nuevo en tus grupos</p>
						</header>
						<div id="login">
					    <form mane = "formulario" method="POST" action="{{ route('docente.login') }}">
					    {{ csrf_field() }}
					        <ul>
					            <h4>Correo Electrónico</h4> <input type="email" name="email" required>
					        </ul>
					        <ul>
					            <h4>Contraseña</h4><input type="password" name="password" required>
					        </ul>
					        <ul>
					            <button type="submit" class="button alt">Entrar como docente</button>
					        </ul>
					    </form>
					  </div>
						<br><br><br>
            <div id="social">
                <button id="facebook"> <img src="assets/images/iconos/FacebookIcon.png"/><h4></h4>Ingresar con Facebook</button>

                <button id="gmail"><img src="assets/images/iconos/GoogleIcon.png"/><h4></h4>Acceder con Google</button>
            </div>

					</section>

					<div class="row">
						<div class="6u">

							<section class="box special">
								<span class="image featured"><img src="assets/images/padre.jpg" alt="" /></span>
								<h3>Soy Acudiente</h3>
								<p>Registrate como acudiente para acceder a grupos del curso de tu hijo y enterarte de sus actividades más importantes.</p>
								<ul class="actions">
									<li><a href="{{ route('acudiente.showRegistrationForm') }}" class="button alt">Empezar</a></li>
								</ul>
							</section>

						</div>
						<div class="6u">

							<section class="box special">
								<span class="image featured"><img src="assets/images/profesor.jpg" alt="" /></span>
								<h3>Soy Maestro</h3>
								<p>Registrate como maestro para crear grupos de tus cursos y ponerte en contacto con los acudientes de tus estudiantes.</p>
								<ul class="actions">
									<li><a href="{{ route('docente.showRegistrationForm') }}" class="button alt">Empezar</a></li>
								</ul>
							</section>

						</div>
					</div>

				</section>

			<!-- CTA -->
				<section id="cta">

					<h2>Acerca de</h2>
					<p>DocXy es la manera fácil para que maestros y padres puedan conectarse, con el fin de crear nuevos canales de comunicación<br> para estar al tanto de las actividades escolares de sus hijos
                        y estudiantes</p>
				</section>

			<!-- Footer -->
				<footer id="footer">

					<ul class="copyright">
						<li>&copy; DocXy. All rights reserved.</li><li>Design: <a href="http://html5up.net">HTML5 UP.</a> Edited by Richard Camacho.</li>
					</ul>
				</footer>

		</div>

		<!-- Scripts -->
			<script type="text/javascript">

			</script>
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/jquery.scrollgress.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>
