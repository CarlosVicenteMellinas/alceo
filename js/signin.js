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
        error.parentNode.removeChild(error);
    } 
}

function comprobarNick(nick) {
    nick.setCustomValidity('');
    eliminarError(nick);

    if (nick.value.length > 20) {
        let texto = 'El nombre de usuario no puede tener una longitud superior a 20 caracteres'
        nick.setCustomValidity(texto);
        insertarError(nick, texto);
    }
}

function comprobarContrasena(contrasena) {
    contrasena.setCustomValidity('');
    eliminarError(contrasena);

    if (contrasena.value.length < 8) {
        let texto = 'La contraseña debe de tener una longitud superior a 8 caracteres';
        contrasena.setCustomValidity(texto);
        insertarError(contrasena, texto);
    } else if (contrasena.value.length > 200) {
        let texto = 'La contraseña no puede tener una longitud superior a 200 caracteres';
        contrasena.setCustomValidity(texto);
        insertarError(contrasena, texto);
    }  else if (!/[a-z]/.test(contrasena.value)) {
        let texto = 'La contraseña debe de tener al menos una letra minúscula';
        contrasena.setCustomValidity(texto);
        insertarError(contrasena, texto);
    }  else if (!/[A-Z]/.test(contrasena.value)) {
        let texto = 'La contraseña debe de tener al menos una letra mayúscula';
        insertarError(contrasena, texto);
    }  else if (!/[0-9]/.test(contrasena.value)) {
        let texto = 'La contraseña debe de tener al menos un caracter numérico';
        contrasena.setCustomValidity(texto);
        insertarError(contrasena, texto);
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
    contrasena.onchange = (ev) => comprobarContrasena(ev.target);

}

main();