<!DOCTYPE HTML>

<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width , user-scalable=no">
        <meta name="theme-color" content="#44a977" />
        
        <link href="images/logo/logo.png" type="image/png" rel="shortcut icon">
        
      	<title>DocXy Maestros</title>
        
		<link rel="stylesheet" href="assets/css/main.css" />
        <link rel="stylesheet" href="assets/css/estiloPrincipal.css" />
        <link rel="stylesheet" href="icomoon/iconos.css">
        
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/funciones.js"></script>
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
        <div id="notific">
            <ul>
                <li><img src="images/user.png" /><span>Richard te ha agregado al grupo Grado Primero</span></li>
                <li><img src="images/user.png" /><span>Jorge castro ha solicitado entrar al grupo Segundo</span><button class="button alt small fit">aceptar</button> <button class="button alt small fit">rechazar</button></li>
                <li><span>han comentado en un evento en el grupo Segundo</span></li>
                <li><a href="Mensajes(Maestro).html">Tienes mensajes nuevos</a></li>
                <li><img src="images/user.png" /><span>Pablo Pupo ha solicitado entrar al grupo Segundo</span><button class="button alt small fit">aceptar</button> <button class="button alt small fit">rechazar</button></li>
                <li><img src="images/user.png" /><span>Richard Camacho ha solicitado entrar al grupo Segundo</span><button class="button alt small fit">aceptar</button> <button class="button alt small fit">rechazar</button></li>
            </ul>
        </div>
        
        <!-- Menu de opciones desplegable -->
        <div id="sistema">
            <ul>
                <li>Mi Perfil</li>
                <li>Salir</li>
                <li>Acerca de</li>
            </ul>
        </div>
        
        <!-- Seccion lateral -->
        <aside id="usuario">
            
            <div id="infoPerfil">
                <div id="user">
                    <img src="images/user.png" >
                    <h4>Nombre del Usuario</h4>
                </div>
            </div>
            <div id="contenedor">
                <div id="botones">
                    <a href="Eventos(MAestro).html" class="boton">
                        <h5>Eventos</h5>
                    </a>
                    
                    <a class="active boton">
                        <h5>Mensajes</h5>
                    </a>
                </div>
                
                <div id="grupos">
                    <h4>Mis Grupos</h4>
                    <ul>
                        <li><img src="images/group-green.png" >Primero</li>
                        <li><img src="images/group-orange.png" >Segundo</li>
                        <li><img src="images/group-red.png" >Tercero</li>
                    </ul>
                </div>
            </div>
        </aside>
        
        
        
            <!-- Cuerpo de contenedor para mostrar los contactos-->
            <div id="contactos">
            
            <form class="input-button">
                <input type="text" required>
                <button class="button alt">Buscar</button>
            </form>
                
            <div id="remitentes">
                
                
                <div class="remitente">
                    <img src="images/user.png" >
                    <h1>Nombre del usuario</h1>
                    <time>8:36</time>
                    <p>este es un mensaje corto.</p>

                </div>
                
                <div class="remitente">
                    <img src="images/user.png" >
                    <h1>Nombre del usuario</h1>
                    <time>8:36</time>
                    <p>este es un mensaje largo a ver si se desborda el contenedor de dicho mensaje.</p>

                </div>

                <div class="remitente">
                    <img src="images/user.png" >
                    <h1>Nombre del usuario</h1>
                    <time>8:36</time>
                    <p>este es un mensaje largo a ver si se desborda el contenedor de dicho mensaje.</p>

                </div>

                <div class="remitente">
                    <img src="images/user.png" >
                    <h1>Nombre del usuario</h1>
                    <time>8:36</time>
                    <p>este es un mensaje largo a ver si se desborda el contenedor de dicho mensaje.</p>

                </div>
            </div>
                
        </div>
        
            <!-- contenedor para ver la conversacion -->
            <div id="chat">
                
                <div id="header-chat">Pablo Pupo</div>
                <div id="conversacion">

                <div class="mensaje remit">
                    <div class="clip1"></div>
                    <div class="contenido">
                        <p>Este es el texto que se va a visualizar en el bloque de un mensaje. del amigo que esta escribiendo a distancia, por lo que veo se ve bien, sigo escribiendo, falta hacerlo responsive.</p>
                        <time>10:57</time>
                    </div>
                </div>

                <div class="mensaje prop">
                    <div class="clip2"></div>
                    <div class="contenido">
                        <p>Este es el texto corto del que envia.</p>
                        <time>10:59</time>
                    </div>
                </div>

                <div class="mensaje remit">
                    <div class="clip1"></div>
                    <div class="contenido">
                        <p>Este es el texto corto del que recibe.</p>
                        <time>10:57</time>
                    </div>
                </div>

                 <div class="mensaje remit">
                    <div class="clip1"></div>
                    <div class="contenido">
                        <p>Este es el texto que se va a visualizar en el bloque de un mensaje. del amigo que esta escribiendo a distancia, por lo que veo se ve bien, sigo escribiendo.</p>
                        <time>10:57</time>
                    </div>
                </div>

                 <div class="mensaje remit">
                    <div class="clip1"></div>
                    <div class="contenido">
                        <p>Este es el texto que se va a visualizar en el bloque de un mensaje. del amigo que esta escribiendo a distancia, por lo que veo se ve bien, sigo escribiendo.</p>
                        <time>10:57</time>
                    </div>
                </div>

                <div class="mensaje prop">
                    <div class="clip2"></div>
                    <div class="contenido">
                        <p>Este es el texto que se va a visualizar en el bloque de un mensaje. este responde</p>
                        <time>10:59</time>
                    </div>
                </div>

                <div class="mensaje prop">
                    <div class="clip2"></div>
                    <div class="contenido">
                        <p>Este es el texto que se va a visualizar en el bloque de un mensaje. este responde</p>
                        <time>10:59</time>
                    </div>
                </div>

                <div class="mensaje prop">
                    <div class="clip2"></div>
                    <div class="contenido">
                        <p>Este es el texto que se va a visualizar en el bloque de un mensaje. este responde</p>
                        <time>10:59</time>
                    </div>
                </div>

                <div class="mensaje prop">
                    <div class="clip2"></div>
                    <div class="contenido">
                        <p>Este es el texto que se va a visualizar en el bloque de un mensaje. este responde</p>
                        <time>10:59</time>
                    </div>
                </div>
            </div>

            <form class="input-button">
                <textarea placeholder="Escribir mensaje..."></textarea>
                <button class="button alt">Enviar</button>
            </form>
                
        </div>
        
        <!-- Ventana Modal Crear grupo-->  
        <div class="cuerpoModalDO cng">
        
            <div id="modalDO_cng">
                <div id="modalHeader">Crea un nuevo grupo<span id="cross_cng" class="icon-cross"></span> </div>
                
                <div id="modalBody">
                    <div> <h5>Foto de grupo</h5>
                        <img src="images/group-blue.png"/>
                        <img src="images/group-black.png"/>
                        <img src="images/group-green.png"/>
                        <img src="images/group-orange.png"/>
                        <img src="images/group-pink.png"/>
                        <img src="images/group-purple.png"/>
                        <img src="images/group-red.png"/>
                        <img src="images/group-yellow.png"/>
                        
                    </div>
                    
                    <form>
                        <input type="text" placeholder="nombre del grupo...">
                        <button type="submit" class="button alt"> Listo</button>
                    </form>
                    
                </div>
            </div>
            
        </div>
        
    </body>
    
</html>