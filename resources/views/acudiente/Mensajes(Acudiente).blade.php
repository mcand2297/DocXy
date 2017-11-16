<!DOCTYPE HTML>

<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width , user-scalable=no">
        <meta name="theme-color" content="#44a977" />

        <link href="{{asset('assets/images/logo/logo.png')}}" type="image/png" rel="shortcut icon">

      	<title>DocXy Acudientes</title>

		<link rel="stylesheet" href="{{asset('assets/css/main.css')}}" />
        <link rel="stylesheet" href="{{asset('assets/css/estiloPrincipal.css')}}" />
        <link rel="stylesheet" href="{{asset('assets/icomoon/iconos.css')}}">

        <script src="{{asset('assets/js/jquery.min.js')}}"></script>
        <script src="{{asset('assets/js/funciones.js')}}"></script>
	</head>

    <body>

        <!-- Header -->
        <header id="headerp">
            <h1>DocXy Acudientes</h1>

            <section>
                <span id="menu" class="icon-circle-left"></span>
            </section>

            <!--<form id="buscagrupo">
                <input type="text" class=""><button type="submit" class="button alt">Buscar</button>
            </form>-->
        </header>

        <!-- Ventana de la busqueda de un grupo -->
        <div id="busqueda">
            @if (isset($bG))
            <ul>
                <li><img src="{{asset('assets/images/group-green.png')}}" ><h5>Primer grado: Olga Gonzales</h5> <h5>Pablo Pupo</h5> <button class="button alt small entrar">Entrar</button></li>

                <li><img src="{{asset('assets/images/group-red.png')}}" ><h5>Universidad de Cartgena</h5> <h5>Jorge Castro</h5> <button class="button alt small entrar">Entrar</button></li>

                <li><img src="{{asset('assets/images/group-orange.png')}}" ><h5>Grupo</h5> <h5>Profesor</h5> <button class="button alt small entrar">Entrar</button></li>
            </ul>
            @endif
        </div>

        <!-- Menu de opciones desplegable -->
        <div id="sistema">
            <ul>
                <li>Mi Perfil</li>
                <li><a href="{{ route('acudiente.logout') }}"
                        onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            Salir
                    </a>
                    <form id="logout-form" action="{{ route('acudiente.logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                    </form></li>
                <li>Acerca de</li>
            </ul>
        </div>

        <!-- Seccion lateral -->
        <aside id="usuario">

            <div id="infoPerfil">
                <div id="user">
                    <img src="{{asset('assets/images/user.png')}}" >
                    <h4>{{ Auth::guard('acudiente')->user()->nick }}</h4>
                </div>
            </div>
            <div id="contenedor">
                <div id="botones">
                    <a href="/acudiente/home" class="boton">
                        <h5>Eventos</h5>
                    </a>

                    <a href="/acudiente/home/mensajes" class="active boton">
                        <h5>Mensajes
                            <span class="notif">5</span>
                        </h5>
                    </a>
                </div>

                <div id="grupos">
                    <h4>Mis Grupos</h4>
                     <?php
                        use App\Http\Controllers\Acudiente\GrupoController;
                        $s=Auth::guard('acudiente')->user()->grupos;
                        $user=Auth::guard('acudiente')->user()->id;
                        $chat=Auth::guard('acudiente')->user()->chats->reverse();
                        $chatid=0;
                    ?>

                    <ul>
											@if(count($s)!=0)
												@foreach ($s as $ss)
												<a href="{{ url('acudiente/home/grupo', array('Grupo'=>$ss)) }}">
													<li><img src="{{asset('assets/images/group-red.png')}}"/>{{$ss->nombre}}</li><!-- modificar cuando se agregue a la base de datos -->
												</a>
												@endforeach
											@else
											<h4>No tiene grupos</h4>
											@endif
                    </ul>
                </div>
            </div>
        </aside>



            <!-- Cuerpo de contenedor para mostrar los contactos-->
            <div id="contactos">
            <form class="input-button" method="POST" action="{{route('acudiente.home.nuevoChat')}}">
                <input type="text" name="docente" required>
                <button class="button alt">Buscar</button>
            </form>
            <div id="remitentes">
                @foreach($chat as $chats)
                    <?php $buscarDocente = GrupoController::buscarDocente($chats->docente_id);
                    $buscarMesaje = GrupoController::buscarMensaje($chats->id)->reverse();
                    $nume=0?>
                    @foreach($buscarMesaje as $mess)
                        @if($chats->id == $mess->chat_id)
                            <?php $nume++; ?>
                        @endif
                        @if($nume!=1)
                        @else
												<a href="{{ url('acudiente/home/chat', array('Chat'=>$chats->id)) }}">
                        <div class="remitente">
                            <img src="{{asset('assets/images/user.png')}}">
                            <h1>{{$buscarDocente->nombre}} {{$buscarDocente->apellido}}</h1>
                            <time>{{$buscarDocente->create_at}}</time>
                            <p>{{$mess->texto}}</p>
                        </div>
												</a>
                        @endif
                    @endforeach
                @endforeach
            </div>
        </div>

            <!-- contenedor para ver la conversacion -->
            <div id="chat">
                @if(isset($chatCompleto))
                 @foreach($chat as $chats)
                 @if($chats->id == $chatCompleto)
                 <?php $buscarDocente = GrupoController::buscarDocente($chats->docente_id);
                    $buscarMesaje = GrupoController::buscarMensaje($chats->id);
                    $chatid=$chats->id;?>
                <div id="header-chat">{{$buscarDocente->nombre}} {{$buscarDocente->apellido}}</div>
                <div id="conversacion">
                @foreach($buscarMesaje as $mess)
                @if(is_null($mess->acudiente_id))
                <div class="mensaje remit">
                    <div class="clip1"></div>
                    <div class="contenido">
                        <p>{{$mess->texto}}</p>
                        <time>10:57</time>
                    </div>
                </div>
                @else
                <div class="mensaje prop">
                    <div class="clip2"></div>
                    <div class="contenido">
                        <p>{{$mess->texto}}</p>
                        <time>10:59</time>
                    </div>
                </div>
                @endif
                @endforeach
                @endif
                @endforeach
                @endif
            </div>
                <form method="get" class="input-button" action="{{ url('acudiente/home/chatear', array('Acudiente'=>$user, 'Chat'=>$chatid)) }}">
                    <textarea placeholder="Escribir mensaje..." name="texto"></textarea>
                    <button class="button alt">Enviar</button>
                </form>
        </div>


        <!-- Ventana Modal -->
        <div class="cuerpoModalAC">

            <div id="modalAC">
                <div id="modalHeader">¿Quieres unirte a este grupo? <span id="cross" class="icon-cross"></span> </div>

                <div id="modalBody">
                    <div id="info">
                        <img src="{{asset('assets/images/group-green.png')}}" >
                        <h5>Primer grado: Olga Gonzales</h5>
                        <h5>Pablo Pupo</h5>
                    </div>
                    Ingresa el código de confirmación para solicitar que te agreguen</div>
                <div id="modalFooter">
                    <form><input type="text" required><button class="button alt">Confirmar</button></form>
                </div>
            </div>

        </div>

    </body>

</html>
