<!DOCTYPE HTML>

<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width , user-scalable=no">
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

            <!--<form id="buscagrupo" name="busqueda" method="GET" action="{{ url('acudiente/home/buscar')}}">
                <input type="text" class="" name="texto"><button type="submit" class="button alt">Buscar</button>
            </form>-->
        </header>

        <!-- Ventana de la busqueda de un grupo -->


        <div id="busqueda">
            @if (isset($bG))
            {{dd($bG)}}
            <ul>
                <li><img src="{{asset('assets/images/group-green.png')}}" ><h5>Pablo</h5> <h5>Pablo Pupo</h5> <button class="button alt small entrar">Entrar</button></li>
            </ul>
            @endif
        </div>
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

                    <a href="/acudiente/home/mensajes" class="boton">
                        <h5>Mensajes
                            <span class="notif">50</span>
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
                        <li><a href="{{ url('acudiente/home/grupo', array('Grupo'=>$ss)) }}"><img src="{{asset('assets/images/group-red.png')}}"/>{{$ss->nombre}}</a> </li><!-- modificar cuando se agregue a la base de datos -->
                        @endforeach
                    </ul>
                </div>
            </div>
        </aside>

        <!-- Cuerpo de mensajes -->
        <div id="main">
            <div id="contGrupo">
                <div>
                    <div id="infoGrupo">
                        <img src="{{asset('assets/images/group-orange.png')}}" class="pic-grupo">
                        <h4>{{$grupo->nombre}}</h4>
                        <h5>{{$docenteResponsable->nombre}} {{$docenteResponsable->apellido}}</h5>
                    </div>
                    <img class="pic-banner" src="{{asset('assets/images/Cabeceras/01.jpg')}}"/>
                </div>
                <!-- para mostrar el estado en el grupo (POR CONFIRMAR / PARTICIPANDO) -->
                    <h5 id="estado">Participando</h5>
                    <ul class="actions">
                        <li><button class="button alt">Dejar Grupo</button></li>
                        <li><button id="participantes" class="button alt">Participantes</button></li>
                        <li><button id="estudiantes" class="button alt">Estudiantes</button></li>
                    </ul>
            </div>
            @foreach($grupo->actividades->reverse() as $act)
            <article class="cont post">
                <header>
                    <div class="meta">
                        <h4 class="nombre">{{$docenteResponsable->nombre}} {{$docenteResponsable->apellido}}</h4>
                        <h4 class="grupo">{{$act->asignatura->nombre}}</h4>
                        <time class="publicado" datetime="2015-11-01">{{ $act->created_at }}</time>
                    </div>
                </header>
                    <p>{{$act->comunicado}}</p>
                    <div class="informacion">
                    <h5> 5 han visto esto</h5>
                    <div id="comentarios">
                        <h5 class="verComentarios"> Comentarios <span>{{$act->comentarios->count()}}</span></h5>
                        <ul class="comentarios">
                            @foreach($act->comentarios as $comentario)
	                            @if(!is_null($comentario->docente_id))
		                            @foreach($grupo->docentes->unique('id') as $docente)
			                            @if($docente->id == $comentario->docente_id)
			                                <li id="comentario">
			                                    <time>{{$comentario->created_at}}</time> <h5>{{$docente->nombre}} {{$docente->apellido}}</h5>
			                                    <p>{{$comentario->texto}}</p>
			                                </li>
			                            @endif
	                            	@endforeach
	                            @else
		                            @foreach($grupo->acudientes as $acudiente)
			                            @if($acudiente->id == $comentario->acudiente_id)
			                                <li id="comentario">
			                                    <time>{{$comentario->created_at}}</time> <h5>{{$acudiente->nombre}} {{$acudiente->apellido}}</h>
			                                    <p>{{$comentario->texto}}</p>
			                                </li>
			                            @endif
		                            @endforeach
	                            @endif
                            @endforeach
                        </ul>
                        <?php
                            $acti=$grupo->id;
                            $docR=$docenteResponsable->id;
                        ?>
                        <div>
                            <h5>Escribe un comentario.</h5>
                            <form name="registro" method="GET" action="{{ url('acudiente/home/comentario', array('Acudiente'=>$user, 'Docente'=>$docR, 'Actividad'=>$acti)) }}" id="comentario">
                            <textarea id="caja" name="caja"></textarea>
                            <ul>
                                <button type="submit" class="button alt">enviar</button>
                            </ul>
                            </form>
                        </div>
                    </div>
                </div>
            </article>
            @endforeach
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
        <!-- Ventana Modal Participantes-->
        <div class="cuerpoModalDO pg">

            <div id="modalDO_pg">
                <div id="modalHeader">Participantes de este grupo<span id="cross_pg" class="icon-cross"></span> </div>

                <div id="modalBody">

                    <div id="tablaP" class="table-wrapper">
                        <table>
                            <tbody>
                                <tr>
                                    <td>Richard</td>
                                    <td>Camacho</td>
                                    <td>Profesor</td>
                                </tr>
                                <tr>
                                    <td>Pablo</td>
                                    <td>Pupo</td>
                                    <td>Acudiente</td>
                                </tr>
                                <tr>
                                    <td>Jorge</td>
                                    <td>Castro</td>
                                    <td>Acudiente</td>
                                </tr>
                                <tr>
                                    <td>Pablo</td>
                                    <td>Pupo</td>
                                    <td>Acudiente</td>
                                </tr>
                                <tr>
                                    <td>Pablo</td>
                                    <td>Pupo</td>
                                    <td>Profesor</td>
                                </tr>
                                <tr>
                                    <td>Pablo</td>
                                    <td>Pupo</td>
                                    <td>Acudiente</td>
                                </tr>
                                <tr>
                                    <td>Pablo</td>
                                    <td>Pupo</td>
                                    <td>Acudiente</td>
                                </tr>
                                <tr>
                                    <td>Pablo</td>
                                    <td>Pupo</td>
                                    <td>Acudiente</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <form>
                    </form>

                </div>
            </div>

        </div>

        <!-- Ventana Modal estudiantes-->
        <div class="cuerpoModalDO est">

            <div id="modalDO_est">
                <div id="modalHeader">Estudiantes<span id="cross_est" class="icon-cross"></span> </div>
                <div id="modalBody">
                    <div id="tabla_est" class="table-wrapper">
                        <table>
                            <tbody>
                                @foreach($estudiante as $estu)
                                @if(is_null($estu->acudiente_id))
                                <?php $idEstu=$estu->id; ?>
                                    <tr>
                                        <td>{{$estu->nombre}} {{$estu->apellido}}</td>
                                        <td><a href="{{ url('acudiente/home/estudiante', array('Acudiente'=>$user, 'Id'=>$idEstu)) }}"><img src="{{asset('assets/images/agregar.png')}}" width="30" height="30"/></a><td>
                                    </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <form>
                    </form>

                </div>
            </div>

        </div>

    </body>

</html>
