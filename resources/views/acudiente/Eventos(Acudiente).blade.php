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

            <form id="buscagrupo" name="busqueda" method="GET" action="{{ url('acudiente/home/buscar')}}">
                <input type="text" class="" name="texto"><button type="submit" class="button alt">Buscar</button>
            </form>
        </header>

        <!-- Ventana de la busqueda de un grupo -->

        <div id="busqueda">

            @if (isset($bG))
            @foreach($bG as $bGG)
            <ul>
                <li><img src="{{asset('assets/images/group-green.png')}}" ><h5>{{$bGG->nombre}}</h5>
                @foreach($bGG->docentes as $buscarDocentes)
                    <?php $docenteBuscado=$buscarDocentes; ?>
                @endforeach
                <h5>{{$docenteBuscado->nombre}} {{$docenteBuscado->apellido}}</h5> <button class="button alt small entrar">Entrar</button></li>
            </ul>
            @endforeach
            @endif
        </div>

        <div id="sistema">
            <ul>
                <li>Mi Perfil</li>
                <li>
                    <a href="{{ route('acudiente.logout') }}"
                        onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            Salir
                    </a>
                    <form id="logout-form" action="{{ route('acudiente.logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                    </form>
                </li>
                <li>Acerca de</li>
            </ul>
        </div>

        <aside id="usuario">
            <div id="infoPerfil">
                <div id="user">
                    <img src="{{asset('assets/images/user.png')}}" >
                    <h4>{{ Auth::guard('acudiente')->user()->nick }}</h4>
                </div>
            </div>
            <div id="contenedor">
                <div id="botones">
                    <a href="/acudiente/home"  class="active boton">
                        <h5>Eventos</h5>
                    </a>

                    <a href="/acudiente/home/mensajes" class="boton">
                        <h5>Mensajes
                            <span class="notif">0</span> <!-- si no hay notificaciones se oculta -->
                        </h5>
                    </a>
                </div>

                <div id="grupos">
                    <h4>Mis Grupos</h4>
                    <?php
                        $s=Auth::guard('acudiente')->user()->grupos;
                        $user=Auth::guard('acudiente')->user()->id;
                    ?>
                    <ul>
                        @foreach ($s as $ss)
                        <li><a href="{{ url('acudiente/home/grupo', array('Grupo'=>$ss)) }}"><img src="{{asset('assets/images/group-yellow.png')}}"/>{{$ss->nombre}}</a> </li><!-- modificar cuando se agregue a la base de datos -->
                        @endforeach
                    </ul>
                </div>
            </div>
        </aside>


        <!--imagen que no hay post-->
        <!--<div id="nopost"><img src="{{asset('assets/images/nopost.png')}}" ></div>-->

        <!-- Cuerpo de eventos -->
        <div id="main">

            <!-- Post-->
            @foreach ($s as $ss)
            @foreach ($ss->actividades->reverse() as $sss)
            <article class="cont post">
                <header>
                    <div class="meta">
                        @foreach ($ss->docentes as $doc)
                            @if($doc->id == $sss->docente_id)
                                <?php $nomdoc=$doc; ?>
                            @endif
                        @endforeach
                        <h4 class="nombre"> {{ $nomdoc->nombre }} {{ $nomdoc->apellido }} - {{$sss->asignatura->nombre}}</h4>
                        <h4 class="grupo"> {{ $ss->nombre }} </h4>
                        <time class="publicado" datetime="2015-11-01"> {{ $sss->created_at }} </time>
                    </div>
                </header>
                    <p> {{ $sss->comunicado }} </p>
                <div class="informacion">
                    <h5> 5 han visto esto</h5>
                    <ul id="comentarios">
                        <h5 class="verComentarios"> Comentarios <span>{{$sss->comentarios->count()}}</span></h5>
                        <ul class="comentarios">
	                        @foreach($sss->comentarios as $comentario)
	                             @if(!is_null($comentario->docente_id))
	                                    @foreach($ss->docentes->unique('id') as $doc)
	                                        @if($doc->id == $comentario->docente_id)
	                                          <li id="comentario">
	                                                 <time>{{$comentario->created_at}}</time> <h5>{{$doc->nombre}} {{$doc->apellido}}</h5>
	                                                 <p>{{$comentario->texto}}</p>
	                                          </li>
	                                      @endif
	                                    @endforeach
	                             @else
	                                 @foreach($ss->acudientes as $acu)
	                                     @if($acu->id == $comentario->acudiente_id)
	                                         <li id="comentario">
	                                                <time>{{$comentario->created_at}}</time> <h5>{{$acu->nombre}} {{$acu->apellido}}</h5>
	                                                <p>{{$comentario->texto}}</p>
	                                         </li>
	                                     @endif
	                                 @endforeach
	                             @endif
	                        @endforeach
                        </ul>
                        <?php
                            $act=$sss->id;
                        ?>
                        <div>
                            <h5>Escribe un comentario.</h5>
                            <form name="registro" method="GET" action="{{ url('acudiente/home/comentario', array('Acudiente'=>$user, 'Docente'=>$doc, 'Actividad'=>$act)) }}" id="comentario">
                            <textarea id="caja" name="caja"></textarea>
                            <ul>
                                <button type="submit" class="button alt">enviar</button>
                            </ul>
                            </form>
                        </div>
                    </ul>
                </div>
            </article>
            @endforeach
            @endforeach
        </div>

      <!-- Ventana Modal -->
        <div class="cuerpoModalAC">
            <div id="modalAC">
                @if (isset($bG))
                @foreach($bG as $bGG)
                <div id="modalHeader">¿Quieres unirte a este grupo? <span id="cross" class="icon-cross"></span> </div>
                <?php $grupoId=$bGG->id; ?>
                <div id="modalBody">
                    <div id="info">
                        <img src="{{asset('assets/images/group-green.png')}}" >
                        <h5>{{$bGG->nombre}}</h5>
                        <h5>{{$docenteBuscado->nombre}} {{$docenteBuscado->apellido}}</h5>
                    </div>
                    Ingresa el código de confirmación para solicitar que te agreguen</div>
                <div id="modalFooter">
                    <form name="codigoConfirmacion" method="GET" action="{{ url('acudiente/home/solicitud', array('Grupo'=>$grupoId, 'Acudiente'=>$user))}}"><input type="text" name="codigo" required><button class="button alt">Confirmar</button></form>
                </div>
                @endforeach
                @endif
            </div>

        </div>
    </body>

</html>
