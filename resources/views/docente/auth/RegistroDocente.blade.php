<!DOCTYPE HTML>

<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width , user-scalable=no">
        <meta name="theme-color" content="#2e63b7" />
        <link href="{{asset('assets/images/logo/logo.png')}}" type="image/png" rel="shortcut icon">

      	<title>Registro Docente</title>
		<link rel="stylesheet" href="{{asset('assets/css/main.css')}}" />
        <link rel="stylesheet" href="{{asset('assets/css/estiloRegistros.css')}}" />

        <script src="{{asset('assets/js/jquery.min.js')}}"></script>
        <script src="{{asset('assets/js/funciones.js')}}"></script>

	</head>

	<body id="bMaestro">

        <header class="major">
            <h2>Registrate en DocXy como Maestro</h2>
        </header>

        <section>

                    <div>
											<form name="registro" method="POST" action="{{ route('docente.register') }}" onsubmit="return validacion()" id="registroA">
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
	                            <div class="row uniform 50%">
	                                <div class="12u">
	                                    <div class="select-wrapper">
	                                        <select name="category" id="category" required>
	                                            <option value="">Asignatura que impartes</option>
																							@foreach($asig as $asigs)
																								<option value="{{$asigs['id']}}">{{$asigs['nombre']}}</option>
																							@endforeach
	                                        </select>
	                                    </div>
	                                </div>
	                            </div>
	                        </ul>

	                        <ul>
	                            <button type="submit" class="button alt">Listo</button>
	                        </ul>
                    </form>
                        <div id="social">
                            <button id="facebook"> <img src="{{asset('assets/images/iconos/FacebookIcon.png')}}"/><h4></h4>Ingresar con Facebook</button>

                            <button id="gmail"><img src="{{asset('assets/images/iconos/GoogleIcon.png')}}"/><h4></h4>Acceder con Google</button>
                        </div>
                    </div>
        </section>
    </body>
</html>
