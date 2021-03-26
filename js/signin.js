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
    console.log("Funciona");
}

function validar() {
    validarNombre(nombre.textContent);
}

$(document).ready(() => {
    inicializarVar();
    form.onsubmit(validar);

});