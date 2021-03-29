var form;
var nombre;
var nick;
var contrasena;
var contrasena2;
var email;
var plan;
var telf;
var boton;

function inicializarVar() {
    form = document.getElementById("signinForm");
    nombre = document.getElementById("nombre");
    nick = document.getElementById("nick");
    contrasena = document.getElementById("contrasena");
    contrasena2 = document.getElementById("contrasena2");
    email = document.getElementById("correo");
    plan = document.getElementById("plan");
    telf = document.getElementById("telefono");
    boton = document.getElementById("enviar");
}

function validarNombre(nombreUsuario) {
    return nombreUsuario.lenght =! 0;
}

function validarNick(nick) {
    return nick.lenght =! 0;
}

function validarContrasena(pass) {
    return pass.lenght =! 0;
}

function validarContrasenas(pass1, pass2) {
    return pass1 === pass2;
}  

function comprobar() {
    if (validarNombre(nombre.textContent)) {
        nombre.setCustomValidity('');
    } else {
        nombre.setCustomValidity('El nombre no es correcto');
    }
    if (validarNick(nick.textContent)) {
        nick.setCustomValidity('');
    } else {
        nick.setCustomValidity('El nickname no es correcto');
    }
    if (validarContrasena(contrasena.textContent)) {
        contrasena.setCustomValidity('');
    } else {
        contrasena.setCustomValidity('La contaseña no es válida');
    }
    if (validarContrasenas(contrasena.textContent, contrasena2.textContent)) {
        contrasena2.setCustomValidity('');
    } else {
        contrasena2.setCustomValidity('Las contraseñas no coinciden');
    }
}
//Tremendo coladero
function enviar() {
    comprobar();
    form.checkValidity()
    if (form.checkValidity()) {
        form.submit();
    }
}

$(document).ready(() => {
    inicializarVar();
    boton.onclick = enviar;

});