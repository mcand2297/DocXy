<!DOCTYPE HTML>

<html  lang="{{ app()->getLocale() }}">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width , user-scalable=no">
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
                <div title="Crear un nuevo grupo" id="agregarGrupo"><img src="images/iconos/GrupoPlus.png" /></div>
                <div title="Notificaciones" id="notificaciones"><img src="images/iconos/notificacion.png" /></div>
            </section>
        </header>

        <!-- Ventana de notificaciones -->

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
                    <a href="{{route('docente.inicio')}}" class="boton">
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

        <!-- Cuerpo de mensajes -->
        <div id="main">

            <!-- Cabecera de informacion de n grupo -->
            <div id="contGrupo">

                <div>
                    <div id="infoGrupo">
                        <img src="{{asset('assets/images/group-orange.png')}}" class="pic-grupo">

                        <h4>{{$grupo->nombre}}</h4>
                        <h5>{{$docenteResponsable->nombre}} {{$docenteResponsable->apellido}}</h5>
                    </div>

                    <img class="pic-banner" src="{{asset('assets/images/Cabeceras/01.jpg')}}"/>

                </div>
                <!-- para mostrar el estado en el grupo (PARTICIPANDO / MI GRUPO) -->
                    <h5 id="estado">Mi grupo</h5>
                    <ul class="actions">
											@if(Auth::guard('docente')->user()->id == $docenteResponsable->id)
                        <li><button id="eliminar" class="button alt" onclick="location.href = '{{route('docente.eliminarGrupo')}}';
													event.preventDefault(); document.getElementById('eliminarGrupo').submit();">Eliminar Grupo</button></li>
											@endif
                        <li><button id="participantes" class="button alt">Participantes</button></li>
                        <li><button id="estudiantes" class="button alt">Estudiantes</button></li>
                    </ul>
										<form id="eliminarGrupo" action="{{route('docente.eliminarGrupo')}}" method="post">
											{{ csrf_field() }}
												<input type="hidden" name="_method" value="DELETE">
												<input type="hidden" name="_token" value="{{ csrf_token() }}">
												<input type="hidden" name="grupo" value="{{$grupo->id}}">
										</form>
            </div>

            <!-- Caja de texto para excribir un nuevo evento -->
            <div class="contEvento">
                <form name="crear_actividad" action="{{ route('docente.crearActividad')}}" method="post">
									{{ csrf_field() }}
										<input type="hidden" name="grupo_id" value="{{$grupo->id}}">
                    <textarea name="comunicado" id="comunicado" placeholder="Comparte un nuevo evento"></textarea><br>
										<div class="select-wrapper">
												<select name="category" id="category" required >
														<option value="">Asignatura de la actividad</option>
														@foreach($asigsActv->unique('id') as $asig)
															<option value="{{$asig->id}}">{{$asig->nombre}}</option>
														@endforeach
												</select>
										</div><br>
                    <button class="button alt small ">Compartir</button>
                    <button class="button alt small " type="reset">Reset</button>
                </form>
            </div>
					@foreach($grupo->actividades->reverse() as $actividad)
            <article class="cont post">
							@foreach($grupo->docentes->unique('id') as $doc)
								@if($doc->id == $actividad->docente_id)
	                <header>
	                  <div class="meta">
	                      <h4 class="nombre">{{$doc->nombre}} {{$doc->apellido}}</h4>
	                      <h4 class="grupo">{{$actividad->asignatura->nombre}}</h4>
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
															 <li id="comentario">
																 	 <time>{{$comentario->created_at}}</time> <h4>{{$comentario->docente->nombre}} {{$comentario->docente->apellido}}</h4>
																	 <p>{{$comentario->texto}}</p>
															 </li>
															@else
																<li id="comentario">
																	<time>{{$comentario->created_at}}</time> <h4>{{$comentario->acudiente->nombre}} {{$comentario->acudiente->apellido}}</h4>
																	<p>{{$comentario->texto}}</p>
																</li>
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

                    <form>
                        <input type="text" placeholder="nombre del grupo...">
                        <button type="submit" class="button alt"> Listo</button>
                    </form>

                </div>
            </div>

        </div>

        <!-- Ventana Modal Participantes-->
        <div class="cuerpoModalDO pg">

            <div id="modalDO_pg">
                <div id="modalHeader">Listar Docentes<span id="cross_pg" class="icon-cross"></span> </div>

                <div id="modalBody">

                    <div id="tablaP" class="table-wrapper">
                        <table>
                            <tbody>
															@if(Auth::guard('docente')->user()->id == $docenteResponsable->id)
																@foreach($docentesGenerales as $docente)
																	<tr>
																			<td>{{$docente->nick}}</td>
																			<td>{{$docente->nombre}}</td>
																			<td>{{$docente->apellido}}</td>
																			@foreach($grupo->docentes->unique('id') as $docGrupo)
																				@if($docente->id == $docenteResponsable->id)
																					<td>Docente de grupo</td>
																				@elseif($docente->id == $docGrupo->id)
																					<td>Participante</td>
																				@else
																					<td></td>
																				@endif
																			@endforeach
																	</tr>
																@endforeach
															@else
																@foreach($grupo->docentes->unique('id') as $docente)
																<tr>
																	<td>{{$docente->nick}}</td>
																	<td>{{$docente->nombre}}</td>
																	<td>{{$docente->apellido}}</td>
																	@if($docente->id == $docenteResponsable->id)
																		<td>Docente de grupo</td>
																	@endif
																</tr>
																@endforeach
															@endif
                            </tbody>
                        </table>
                    </div>

										@if(Auth::guard('docente')->user()->id == $docenteResponsable->id)
										<form name="agregarDocente" method="post" action="{{route('docente.agregarDocente')}}">
											{{ csrf_field() }}
												<input type="hidden" name="grupo" value="{{$grupo->id}}">
												<input name="nick" type="text" placeholder="Agrega a un docente por nick"><br><br>
                          <div class="row uniform 50%">
                              <div class="12u">
                                  <div class="select-wrapper">
                                      <select name="category[]" id="category" multiple="multiple" size="5" required >
                                          <option disabled="disabled" value="">Asignaturas del docente</option>
																					@foreach($asigs as $asig)
																						<option value="{{$asig->id}}">{{$asig->nombre}}</option>
																					@endforeach
                                      </select>
                                  </div>
                              </div>
                          </div>
											<button type="submit" class="button alt"> Listo</button>
										</form>
										@endif
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
															@foreach($grupo->estudiantes as $estudiante)
																<tr>
																		<td>{{$estudiante->nombre}} {{$estudiante->apellido}}</td>
																		@if(!is_null($estudiante->acudiente))
																			<td>{{$estudiante->acudiente->nick}}</td>
																			<td>{{$estudiante->acudiente->nombre}} {{$estudiante->acudiente->apellido}}</td>
																			<td>{{$estudiante->acudiente->email}}</td>
																		@else
																		<td></td>
																		<td>Sin acudiente</td>
																		<td></td>
																		@endif
																</tr>
															@endforeach
                            </tbody>
                        </table>
                    </div>
										@if(Auth::guard('docente')->user()->id == $docenteResponsable->id)
											<form name="agregarEstudiante" method="post" action="{{route('docente.agregarEstudiante')}}">
												{{ csrf_field() }}
													<h5>Agrega a un estudiante</h5>
													<input name="grupo" type="hidden" name="grupo" value="{{$grupo->id}}">
													<input name="nombre" type="text" placeholder="Nombres"><br><br>
													<input name="apellido" type="text" placeholder="Apellidos">
													<button type="submit" class="button alt"> Listo</button>
											</form>
										@endif
                </div>
            </div>

        </div>

    </body>

</html>
