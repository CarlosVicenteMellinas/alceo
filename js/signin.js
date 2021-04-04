var form;
var nombre;
var nick;
var contrasena;
var contrasena2;
var email;
var plan;
var telf;
var boton;

function insertarError(input, texto) {
    let error = document.createElement('p');
    error.className = 'error';
    error.textContent = texto;
    input.insertAdjacentElement('afterend',error);
}

function eliminarError(input) {
    let error = document.querySelector(`#${input.id} + .error`);
    if (error) {
        console.log(error);
        error.parentNode.removeChild(error);
    } 
}

function comprobarNick(nick) {
    if (nick.value.length < 20) {
        nick.setCustomValidity('');
        eliminarError(nick);
    } else {
        let texto = 'El nombre de usuario no puede tener una longitud superior a 20 caracteres'
        nick.setCustomValidity(texto);
        insertarError(nick, texto);
    }
}

function main() {
    form = document.getElementById("signinForm");
    nombre = document.getElementById("nombre");
    nick = document.getElementById("nick");
    contrasena = document.getElementById("contrasena");
    contrasena2 = document.getElementById("contrasena2");
    email = document.getElementById("correo");
    plan = document.getElementById("plan");
    telf = document.getElementById("telefono");
    boton = document.getElementById("enviar");

    nick.onchange = (ev) => comprobarNick(ev.target);
    
}

main();