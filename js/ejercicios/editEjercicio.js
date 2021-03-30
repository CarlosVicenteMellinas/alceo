const select = document.getElementById("ejercicio");
const nombre = document.getElementById("nombre");
const dificultad = document.getElementById("dificultad");
const id = document.getElementById("id");

function changeValues(data) {
    let cod = select.value;
    let ejercicio = getEjercicio(cod, data);
    id.value = ejercicio[0];
    nombre.value = ejercicio[1];
    dificultad.value = ejercicio[2];
}

function getEjercicio(cod, data) {
    let ejercicio;
    for (let dato of data) {
        if (dato[0] === cod) {
            ejercicio = dato;
        }
    }

    return ejercicio;
}