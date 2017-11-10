<!DOCTYPE HTML>

<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width , user-scalable=no">
				<!-- CSRF Token soluciona el problema de expire la pagina-->
				<meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="theme-color" content="#44a977" />
        <link href="{{asset('assets/images/logo/logo.png')}}" type="image/png" rel="shortcut icon">

      	<title>Registro Acudiente</title>
				<link rel="stylesheet" href="{{asset('assets/css/main.css')}}" />
        <link rel="stylesheet" href="{{asset('assets/css/estiloRegistros.css')}}" />

        <script src="{{asset('assets/js/jquery.min.js')}}"></script>
        <script src="{{asset('assets/js/funciones.js')}}"></script>

	</head>

	<body id="bAcudiente">

        <header class="major">
            <h2>Registrate en DocXy como Acudiente</h2>
        </header>

        <section>


            <form name="registro" method="POST" action="{{ route('acudiente.register') }}" onsubmit="return validacion()" id="registroA">
						{{ csrf_field() }}<!-- CSRF field soluciona el problema de expire la pagina-->
								<ul>
										<h5>Nick</h5><input id="nick" name="nick" type="text" required>
								</ul>
                <ul>
                    <h5>Nombre</h5><input id="nombre" name="nombre" type="text" required>
                </ul>
								<ul>
                    <h5>Apellido</h5><input id="apellido" name="apellido" type="text" required>
                </ul>
                <ul>
                    <h5>Correo Electrónico</h5> <input id="email" name="email" type="text" required>
                </ul>
                <ul>
                    <h5>Contraseña</h5><input id="password" name="password"  type="password" required>
                </ul>
                <ul>
                    <h5>Repetir Contraseña</h5><input id="password-confirm" name="password_confirmation" type="password" required>
                </ul>
                <ul>
                    <button type="submit" class="button alt">Listo</button>
                </ul>
            </form>

                <div id="social">
                    <button id="facebook"> <img src="{{asset('assets/images/iconos/FacebookIcon.png')}}"/><h4></h4>Ingresar con Facebook</button>

                    <button id="gmail"><img src="{{asset('assets/images/iconos/GoogleIcon.png')}}"/><h4></h4>Acceder con Google</button>
                </div>

        </section>
    </body>
</html>
