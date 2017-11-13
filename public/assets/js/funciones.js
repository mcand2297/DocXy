/*Funcion para desplegar el pequeño menú de las opciones laterales*/
$(document).ready(function () {

    var menu = 1;
    $("#menu").click(function () {
        if (menu == 1) {
            $("#sistema").css({"right" : "1%"});
            $("#menu").css({"transform" : "rotate(180deg)"});
            menu = 0;
        } else {
            $("#sistema").css({"right" : "-120%"});
            $("#menu").css({"transform" : "rotate(0deg)"});
            menu = 1;
        }
    });

});

/*Funcion para desplegar las notificaciones*/
$(document).ready(function () {

    var notif = 1;
    $("#notificaciones").click(function () {
        if (notif == 1) {
            $("#notific").css({"display" : "block"});
            notif = 0;
        } else {
            $("#notific").css({"display" : "none"});
            notif = 1;
        }
    });

});


/*Funcion para desplegar el bloque de los comentarios Escritorio*/
$(document).ready(function () {

    var bloque = 1;
    $(".verComentarios").click(function () {
        if (bloque == 1) {
            $(".comentarios").css({"display" : "block"});
            bloque = 0;
        } else {
            $(".comentarios").css({"display" : "none"});
            bloque = 1;
        }
    });

});

/*Funcion activada por los botones de un grupo que se busca*/
$(document).ready(function () {

  $('.entrar').click(function(){
		$('#modalAC').fadeIn('slow');
        $(".cuerpoModalAC").css({"display" : "block"});

	});

	$('#cross').click(function(){
		$('#modalAC').fadeOut('slow');
		$(".cuerpoModalAC").css({"display" : "none"});
	});
});

/*Funcion activada por el boton crear grupo nuevo*/
$(document).ready(function () {

  $('#agregarGrupo').click(function(){
		$('#modalDO_cng').fadeIn('slow');
        $(".cng").css({"display" : "block"});

	});

	$('#cross_cng').click(function(){
		$('#modalDO_cng').fadeOut('slow');
		$(".cng").css({"display" : "none"});
	});
});

/*Funcion activada por el boton ver participantes*/
$(document).ready(function () {

  $('#participantes').click(function(){
		$('#modalDO_pg').fadeIn('slow');
        $(".pg").css({"display" : "block"});

	});

	$('#cross_pg').click(function(){
		$('#modalDO_pg').fadeOut('slow');
		$(".pg").css({"display" : "none"});
	});
});

/*Funcion activada por el boton ver estudiantes*/
$(document).ready(function () {

  $('#estudiantes').click(function(){
		$('#modalDO_est').fadeIn('slow');
        $(".est").css({"display" : "block"});

	});

	$('#cross_est').click(function(){
		$('#modalDO_est').fadeOut('slow');
		$(".est").css({"display" : "none"});
	});
});

/*funcion para validar los valores que el usuario digita en los campos
del formulario.*/
function validacion() {

    var nombre = document.registro.nick.value;
    var email = document.registro.email.value;
    //uso de una expresion regular para comprobar direcciones de correo y nombre.
    var exp_e = /^[a-z][\w.-]+@\w[\w.-]+\.[\w.-]+[a-z][a-z]$/i;
    var exp_n = /[^a-zA-Z ]/;
    var contr1 = document.registro.contrasena1.value;
    var contr2 = document.registro.contrasena2.value;

    //si el nombre de usuario es muy corto.
    if (nombre.length <= 5) {
        alert('Nick de Usuario muy corto');
        $("#nick").css({"border-color" : "#f00c0c"});
        return false;
    }else{
       $("#nick").css({"border-color": "#d3d3d3"});
    }

    /*Evaluando el nombre con la expresion regular. El nombre de usuario solo
      tendrá letras y espacios*/
    if (exp_n.test(nombre)) {
        alert('Solo letras en el Nombre de Usuario');
        $("#nombre").css({"border-color" : "#f00c0c"});
        return false;
    }else{
       $("#nombre").css({"border-color" : "#d3d3d3"});
    }

    //si el formato de correo electronico es incorrecto.
    if (!exp_e.test(email)) {
        alert('Correo Electrónico no valido');
        $("#email").css({"border-color" : "#f00c0c"});
        return false;
    }else{
       $("#email").css({"border-color" : "#d3d3d3"});
    }

    //si la contraseña del usuario es muy corta.
    if (contr1.length <6) {
        alert('Contraseña muy corta');
        $("#contrasena1").css({"border-color" : "#f00c0c"});
        return false;
    }else{
       $("#contrasena1").css({"border-color" : "#d3d3d3"});
    }

    //si las contraseñas son diferentes
    if (contr2 != contr1) {
        alert('Contraseñas diferentes');
        $("#contrasena2").css({"border-color" : "#f00c0c"});
        return false;
    }
}
