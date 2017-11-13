<!DOCTYPE HTML>

<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width , user-scalable=no">
        <meta name="theme-color" content="#44a977" />

        <link href="{{asset('assets/images/logo/logo.png')}}" type="image/png" rel="shortcut icon">


      	<title>DocXy Maestros</title>

		<link rel="stylesheet" href="{{asset('assets/css/main.css')}}" />
        <link rel="stylesheet" href="{{asset('assets/css/estiloPrincipal.css')}}" />
        <link rel="stylesheet" href="{{asset('assets/icomoon/iconos.css')}}">

        <script src="{{asset('assets/js/jquery.min.js')}}"></script>
        <script src="{{asset('assets/js/funciones.js')}}"></script>
	</head>

    <body>

        <!-- Header -->
        <header id="headerp">
            <h1>DocXy Maestros</h1>

            <section>
                <span id="menu" class="icon-circle-left"></span>
                <div title="Crear un nuevo grupo" id="agregarGrupo"><img src="{{asset('assets/images/iconos/GrupoPlus.png')}}" /></div>
                <div title="Notificaciones" id="notificaciones"><img src="{{asset('assets/images/iconos/notificacion.png')}}" /></div>
            </section>

        </header>

         <!-- Ventana de notificaciones -->
        <div id="notific">
            <ul>
                <li><img src="{{asset('assets/images/user.png')}}" /><span>Richard te ha agregado al grupo Grado Primero</span></li>
                <li><img src="{{asset('assets/images/user.png')}}" /><span>Jorge castro ha solicitado entrar al grupo Segundo</span><button class="button alt small fit">aceptar</button> <button class="button alt small fit">rechazar</button></li>
                <li><span>han comentado en un evento en el grupo Segundo</span></li>
                <li><a href="Mensajes(Maestro).html">Tienes mensajes nuevos</a></li>
                <li><img src="{{asset('assets/images/user.png')}}" /><span>Pablo Pupo ha solicitado entrar al grupo Segundo</span><button class="button alt small fit">aceptar</button> <button class="button alt small fit">rechazar</button></li>
                <li><img src="{{asset('assets/images/user.png')}}" /><span>Richard Camacho ha solicitado entrar al grupo Segundo</span><button class="button alt small fit">aceptar</button> <button class="button alt small fit">rechazar</button></li>
            </ul>
        </div>

        <div id="sistema">
            <ul>
                <li>Mi Perfil</li>
                <li><a href="{{ route('docente.logout') }} " onclick="event.preventDefault();
												 document.getElementById('logout-form').submit();">Salir</a></li>
							  <form id="logout-form" action="{{ route('docente.logout') }}" method="POST" style="display: none;">
									  {{ csrf_field() }}
							  </form>
                <li>Acerca de</li>
            </ul>
        </div>

        <aside id="usuario">

            <div id="infoPerfil">
                <div id="user">
                    <img src="{{asset('assets/images/user.png')}}" >
                    <h4>{{ Auth::guard('docente')->user()->nick }}</h4>
                </div>
            </div>
            <div id="contenedor">
                <div id="botones">
                    <a href="{{route('docente.inicio')}}"  class="active boton">
                        <h5>Eventos</h5>
                    </a>

                    <a href="{{route('docente.showChats')}}" class="boton">
                        <h5>Mensajes
                            <span class="notif">50</span>
                        </h5>
                    </a>
                </div>

                <div id="grupos">
                    <h4>Mis Grupos</h4>
                    <ul>
												@if(count($grupos)!=0)
												@foreach($grupos as $index)
                        <li>
                        	<a href="{{route('docente.showGroup', array('grupo'=>$index))}}"><img  src="{{asset('assets/images/group-green.png')}}" >{{$index->nombre}}</a>
                        </li>
												@endforeach
												@else
												<h4>No tiene grupos</h4>
												@endif
										</ul>
                </div>
            </div>
        </aside>


        <!--imagen que no hay post-->
        <!--<div id="nopost"><img src="images/nopost.png" ></div>-->

        <!-- Cuerpo de eventos -->
        <div id="main">

            <!-- Post-->
				@foreach($grupos as $grupo)
					@foreach($grupo->actividades as $actividad)
            <article class="cont post">
							@foreach($grupo->docentes->unique('id') as $doc)
								@if($doc->id == $actividad->docente_id)
	                <header>
	                    <div class="meta">
	                        <h4 class="nombre">{{$doc->nombre}} {{$doc->apellido}} - {{$actividad->asignatura->nombre}}</h4>
	                        <h4 class="grupo">{{$grupo->nombre}}</h4>
													<time class="publicado" datetime="2015-11-01">{{$actividad->created_at}}</time>
	                    </div>
	                </header>
								@endif
							@endforeach
                  <p>{{$actividad->comunicado}}</p>

                <div class="informacion">
                    <h5> 5 han visto esto</h5>

                    <div id="comentarios">
                        <h5 class="verComentarios"> Comentarios <span>{{$actividad->comentarios->count()}}</span></h5>

                        <ul class="comentarios">
													@foreach($actividad->comentarios as $comentario)
														 @if(!is_null($comentario->docente_id))
														 		@foreach($grupo->docentes->unique('id') as $doc)
																	@if($doc->id == $comentario->docente_id)
																	  <li id="comentario">
																			 <time>{{$comentario->created_at}}</time> <h5>{{$doc->nombre}} {{$doc->apellido}}</h5>
																			 <p>{{$comentario->texto}}</p>
																	  </li>
																  @endif
																@endforeach
														 @else
															 @foreach($grupo->acudientes as $acu)
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

                        <div>
                            <h5>Escribe un comentario.</h5>
														<form id="enviarComentario"  action="{{route('docente.crearComentario')}}" method="post">
															{{ csrf_field() }}
															<input type="hidden" id="actividad" name="actividad" value="{{$actividad->id}}">
															<textarea id="texto" name="texto"></textarea>
															<button type="submit" class="button alt">Enviar</button>
														</form>
                        </div>

                    </div>
                </div>
            </article>
					@endforeach
				@endforeach
      </div>

        <!-- Ventana Modal Crear grupo-->
        <div class="cuerpoModalDO cng">

            <div id="modalDO_cng">
                <div id="modalHeader">Crea un nuevo grupo<span id="cross_cng" class="icon-cross"></span> </div>

                <div id="modalBody">
                    <div> <h5>Foto de grupo</h5>
                        <img src="{{asset('assets/images/group-blue.png')}}"/>
                        <img src="{{asset('assets/images/group-black.png')}}"/>
                        <img src="{{asset('assets/images/group-green.png')}}"/>
                        <img src="{{asset('assets/images/group-orange.png')}}"/>
                        <img src="{{asset('assets/images/group-pink.png')}}"/>
                        <img src="{{asset('assets/images/group-purple.png')}}"/>
                        <img src="{{asset('assets/images/group-red.png')}}"/>
                        <img src="{{asset('assets/images/group-yellow.png')}}"/>

                    </div>

                    <form name="registro" method="POST" action="{{ route('docente.crearGrupo') }}">
										{{ csrf_field() }}
												<ul >
														<input type="hidden" id="docente_id" name="docente_id" value="{{ Auth::guard('docente')->user()->id }}">
												</ul>
												<ul>
														<input id='nombre' name="nombre" type="text" placeholder="nombre del grupo...">
												</ul>
                        <ul>
                        		<input id="codigo_ingreso" name="codigo_ingreso" type="text" placeholder="codigo de ingreso del grupo...">
                        </ul>
                        <ul>
													<div class="row uniform 50%">
	                            <div class="12u">
	                                <div class="select-wrapper">
	                                    <select name="category[]" id="category" multiple="multiple" required size="5">
	                                        <option value="">Asignatura del docente</option>
																					@foreach($asigs as $asig)
																						<option value="{{$asig->id}}">{{$asig->nombre}}</option>
																					@endforeach
	                                    </select>
	                                </div>
	                            </div>
	                        </div>
                        </ul>
                        <button type="submit" class="button alt"> Listo</button>
                    </form>

                </div>
            </div>

        </div>
    </body>

</html>
