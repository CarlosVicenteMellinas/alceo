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

function comprobarNombre(nombre) {
    nombre.setCustomValidity('');
    eliminarError(nombre);

    if (nombre.value === '') {
        let texto = "El nombre no puede estar vacío";
        nombre.setCustomValidity(texto);
        insertarError(nombre, texto);
    }
}

function comprobarNick(nick) {
    nick.setCustomValidity('');
    eliminarError(nick);

    if (nick.value === '') {
        let texto = "El nombre de usuario no puede estar vacío";
        nick.setCustomValidity(texto);
        insertarError(nick, texto);
    } else if (/\s/.test(nick.value)) {
        let texto = 'El nombre de usuario no puede contener espacios';
        nick.setCustomValidity(texto);
        insertarError(nick, texto);
    } else if (nick.value.length > 20) {
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

function comprobarContrasena2(contrasena2, contrasena) {
    contrasena2.setCustomValidity("");
    eliminarError(contrasena2);

    if (contrasena2.value !== contrasena) {
        let texto = "Las contraseñas no coinciden";
        contrasena2.setCustomValidity(texto);
        insertarError(contrasena2, texto); 
    }
}

function comprobarEmail(email) {
    email.setCustomValidity("");
    eliminarError(email);
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    if (email.value === "") {
        let texto = "El correo electrónico no puede estar vacío";
        email.setCustomValidity(texto);
        insertarError(email, texto);
    } else if (!re.test(String(email.value).toLowerCase())) {
        let texto = "El formato del email no es correcto";
        email.setCustomValidity(texto);
        insertarError(email, texto);
    }
}

function comprobarTelf(telf) {
    telf.setCustomValidity("");
    eliminarError(telf);

    if (!/^[0-9]{9}$/.test(telf.value)) {
        let texto = "El formato del teléfono no es correcto";
        telf.setCustomValidity(texto);
        insertarError(telf, texto);
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

    nombre.onchange = (ev) => comprobarNombre(ev.target);
    nick.onchange = (ev) => comprobarNick(ev.target);
    contrasena.onchange = (ev) => comprobarContrasena(ev.target);
    contrasena2.onchange = (ev) => comprobarContrasena2(ev.target, contrasena.value);
    email.onchange = (ev) => comprobarEmail(ev.target);
    telf.onchange = (ev) => comprobarTelf(ev.target);
}

main();