const select = document.getElementById("objetivo");
const nombre = document.getElementById("nombre");
const id = document.getElementById("id");

function changeValues(data) {
    let cod = select.value;
    let objetivo = getObjetivo(cod, data);
    id.value = objetivo[0];
    nombre.value = objetivo[1];
}

function setID(data) {
    let cod = select.value;
    let objetivo = getObjetivo(cod, data);
    id.value = objetivo[0];
   
}

function getObjetivo(cod, data) {
    let objetivo;
    for (let dato of data) {
        if (dato[0] === cod) {
            objetivo = dato;
        }
    }

    return objetivo;
}