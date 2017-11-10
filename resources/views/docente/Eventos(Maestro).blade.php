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

                    <a href="Mensajes(Maestro).html" class="boton">
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
            <article class="cont post">

                <header>
                    <div class="meta">
                        <h4 class="nombre">Richard Camacho</h4>
                        <h4 class="grupo">Segundo</h4>
                        <time class="publicado" datetime="2015-11-01">2017-11-12 22:26:01</time>
                    </div>
                </header>

                    <p>Mauris neque quam, fermentum ut nisl vitae, convallis maximus nisl. Sed mattis nunc id lorem euismod placerat. Vivamus porttitor magna enim, ac accumsan tortor cursus at. Phasellus sed ultricies mi non congue ullam corper. Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.</p>

                <div class="informacion">
                    <h5> 5 han visto esto</h5>

                    <div id="comentarios">
                        <h5 class="verComentarios"> Comentarios <span>3</span></h5>

                        <ul class="comentarios">
                            <li id="comentario">
                                <time>27-10-2017 3:46 pm</time> <h1>Pablo Emilio Pupo Marchena</h1>
                                <p>En este bloque se tendran los comentarios que pueden hacer los padres en cada una de las publicaciones hechas por los maestros, estoy viendo si no se daña el diseño escribiendo partes largas de texto :|</p>

                            </li>
                            <li id="comentario">
                                <time>27-10-2017 4:46 pm</time> <h1>Jorge Castro</h1>
                                <p>En este bloque se tendran los comentarios que pueden hacer lo spadres en cada una de las publicaciones hechas por los maestros, estoy vinedo si no se daña el dieño escribiendo partes largas de texto :|</p>
                            </li>
                            <li id="comentario">
                                <time>28-10-2017 6:40 pm</time> <h1>Jorge Castro</h1>
                                <p>En este bloque se tendran los comentarios que pueden hacer lo spadres en cada una de las publicaciones hechas por los maestros, estoy vinedo si no se daña el dieño escribiendo partes largas de texto :|</p>
                            </li>
                        </ul>

                        <div>
                            <h5>Escribe un comentario.</h5>
                            <textarea id="caja"></textarea> <button class="button alt">Enviar</button>
                        </div>

                    </div>
                </div>
            </article>

            <article class="cont post">

                <header>
                    <div class="meta">
                        <h4 class="nombre">Richard Camacho</h4>
                         <h4 class="grupo">Primero</h4>
                        <time class="publicado" datetime="2015-11-01">2017-11-12 22:20:19</time>
                    </div>
                </header>

                    <p>Mauris neque quam, fermentum ut nisl vitae, convallis maximus nisl. Sed mattis nunc id lorem euismod placerat. Vivamus porttitor magna enim, ac accumsan tortor cursus at. Phasellus sed ultricies mi non congue ullam corper. Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla. Cras vehicula tellus eu ligula viverra, ac fringilla turpis suscipit. Quisque vestibulum rhoncus ligula.</p>

                <div class="informacion">
                    <h5> 5 han visto esto</h5>

                    <div id="comentarios">
                        <h5 class="verComentarios"> Comentarios <span>1</span></h5>

                        <ul class="comentarios">
                            <li id="comentario">
                                <time>27-10-2017 3:46 pm</time> <h1>Pablo Emilio Pupo Marchena</h1>
                                <p>En este bloque se tendran los comentarios que pueden hacer los padres en cada una de las publicaciones hechas por los maestros, estoy viendo si no se daña el diseño escribiendo partes largas de texto :|</p>

                            </li>
                        </ul>

                        <div>
                            <h5>Escribe un comentario.</h5>
                            <textarea id="caja"></textarea> <button class="button alt">Enviar</button>
                        </div>
                    </div>

                </div>

            </article>

            <article class="cont post">
                <header>
                    <div class="meta">
                        <h4 class="nombre">Richard Camacho</h4>
                         <h4 class="grupo">Segundo</h4>
                        <time class="publicado" datetime="2015-11-01">2017-10-02 12:01:19</time>
                    </div>
                </header>
                    <p>Mauris neque quam, fermentum ut nisl vitae, convallis maximus nisl. Sed mattis nunc id lorem euismod placerat. Vivamus porttitor magna enim, ac accumsan tortor cursus at. Phasellus sed ultricies mi non congue ullam corper. Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla. Cras vehicula tellus eu ligula viverra, ac fringilla turpis suscipit. Quisque vestibulum rhoncus ligula.</p>

                <div class="informacion">
                    <h5> 5 han visto esto</h5>

                    <div id="comentarios">
                        <h5 class="verComentarios"> Comentarios <span>0</span></h5>

                        <ul class="comentarios">
                        </ul>

                        <div>
                            <h5>Escribe un comentario.</h5>
                            <textarea id="caja"></textarea> <button class="button alt">Enviar</button>
                        </div>

                    </div>
                </div>

            </article>

            <article class="cont post">
                <header>
                    <div class="meta">
                        <h4 class="nombre">Richard Camacho</h4>
                         <h4 class="grupo">Tercero</h4>
                        <time class="publicado" datetime="2015-11-01">2017-10-02 12:01:19</time>
                    </div>
                </header>
                    <p>Mauris neque quam, fermentum ut nisl vitae, convallis maximus nisl. Sed mattis nunc id lorem euismod placerat. Vivamus porttitor magna enim, ac accumsan tortor cursus at. Phasellus sed ultricies mi non congue ullam corper. Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla. Cras vehicula tellus eu ligula viverra, ac fringilla turpis suscipit. Quisque vestibulum rhoncus ligula.</p>

                <div class="informacion">
                    <h5> 5 han visto esto</h5>

                    <div id="comentarios">
                        <h5 class="verComentarios"> Comentarios <span>0</span></h5>

                        <ul class="comentarios">
                        </ul>

                        <div>
                            <h5>Escribe un comentario.</h5>
                            <textarea id="caja"></textarea> <button class="button alt">Enviar</button>
                        </div>

                    </div>
                </div>

            </article>

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
                        <button type="submit" class="button alt"> Listo</button>
                    </form>

                </div>
            </div>

        </div>
    </body>

</html>
