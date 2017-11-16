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
                <li><span>han comentado en un evento en el grupo Segundo</span></li>
                <li><a href="{{route('docente.showChats')}}">Tienes mensajes nuevos</a></li>
								@foreach($sols as $sol)
										<li><img src="{{asset('assets/images/user.png')}}" />
											<span>{{$sol->acudiente->nombre}} {{$sol->acudiente->apellido}} ha solicitado entrar al {{$sol->grupo->nombre}}</span>
											<button class="button alt small fit" onclick="location.href = '{{route('docente.estadoSolicitud')}}';
												event.preventDefault(); document.getElementById('aceptarSolicitud').submit();">aceptar</button>
											<button class="button alt small fit" onclick="location.href = '{{route('docente.estadoSolicitud')}}';
												event.preventDefault(); document.getElementById('rechazarSolicitud').submit();">rechazar</button>
										</li>
										<form id="aceptarSolicitud" action="{{route('docente.estadoSolicitud')}}" method="POST" style="display: none;">
											  {{ csrf_field() }}
												<input type="hidden" name="aceptado" value=true>
												<input type="soli_id" name="solicitud_id" value="{{$sol->id}}">
												<input type="hidden" name="_method" value="PUT">
												<input type="hidden" name="_token" value="{{ csrf_token() }}">
									  </form>
										<form id="rechazarSolicitud" action="{{route('docente.estadoSolicitud')}}" method="POST" style="display: none;">
											  {{ csrf_field() }}
												<input type="hidden" name="aceptado" value=false>
												<input type="soli_id" name="solicitud_id" value="{{$sol->id}}">
												<input type="hidden" name="_method" value="PUT">
												<input type="hidden" name="_token" value="{{ csrf_token() }}">
									  </form>
								@endforeach
            </ul>
        </div>

        <!-- Menu de opciones desplegable -->
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

        <!-- Seccion lateral -->
        <aside id="usuario">

            <div id="infoPerfil">
                <div id="user">
                    <img src="{{asset('assets/images/user.png')}}" >
                    <h4>{{ Auth::guard('docente')->user()->nick }}</h4>
                </div>
            </div>
            <div id="contenedor">
                <div id="botones">
                    <a href="{{route('docente.inicio')}}" class="boton">
                        <h5>Eventos</h5>
                    </a>

                    <a href="{{route('docente.showChats')}}" class="active boton">
                        <h5>Mensajes</h5>
                    </a>
                </div>

                <div id="grupos">
                    <h4>Mis Grupos</h4>
										<ul>
											@if(count($grupos)!=0)
											@foreach($grupos as $index)
											<a href="{{ route('docente.showGroup', ['grupo' => $index])}}">
											<li><img  src="{{asset('assets/images/group-green.png')}}" >{{$index->nombre}}</li>
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
            <form class="input-button" method="POST" action="{{route('docente.home.mensajes.nuevoChat')}}">
							{{ csrf_field() }}
								<input type="text" name="acudiente" required>
                <button  type="submit" class="button alt">Buscar</button>
            </form>
            <div id="remitentes">
							@if(!is_null($chats))
								@foreach($chats as $chat)
								<a href="{{ url('docente/home/mensajes/chat', array('Chat'=>$chat->id)) }}">
									<div class="remitente">
											<img src="{{asset('assets/images/user.png')}}">
											<h1>{{$chat->acudiente->nombre}} {{$chat->acudiente->apellido}}</h1>
											<time>{{$chat->create_at}}</time>
											@if(!is_null($chat->mensajes->last()))
												<p>{{$chat->mensajes->last()->texto}}</p>
											@endif
									</div>
								</a>
								@endforeach
							@endif
            </div>
            </div>

            <!-- contenedor para ver la conversacion -->



            <div id="chat">
							@if(isset($chatCompleto))
								@foreach($chats as $chat)
									@if($chat->id == $chatCompleto)
		                <div id="header-chat">acudiente nombre acudiente apellido</div>
		                <div id="conversacion">
										@foreach($chat->mensajes as $mnj)
											@if(!is_null($mnj->docente_id))
											<div class="mensaje prop">
													<div class="clip2"></div>
													<div class="contenido">
															<p>{{$mnj->texto}}</p>
															<time>{{$mnj->created_at}}</time>
													</div>
											</div>
											@else
											<div class="mensaje remit">
			                    <div class="clip1"></div>
			                    <div class="contenido">
			                        <p>{{$mnj->texto}}</p>
			                        <time>{{$mnj->created_at}}</time>
			                    </div>
			                </div>
											@endif
										@endforeach
									@endif
								@endforeach
								</div>
								<form method="post" class="input-button" action="{{ route('docente.home.mensajes.chatear')}}">
									{{ csrf_field() }}
										<input type="hidden" name="docente" value="{{ Auth::guard('docente')->user()->id }}">
                    <input type="hidden" name="chat" value="{{$chatCompleto}}">
                    <textarea placeholder="Escribir mensaje..." name="texto"></textarea>
                    <button type="submit" class="button alt">Enviar</button>
                </form>
							@endif
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
