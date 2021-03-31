const select = document.getElementById("grupoM");
const nombre = document.getElementById("nombre");
const id = document.getElementById("id");

function changeValues(data) {
    let cod = select.value;
    let grupoM = getGrupoM(cod, data);
    id.value = grupoM[0];
    nombre.value = grupoM[1];
}

function setID(data) {
    let cod = select.value;
    let grupoM = getEjercicio(cod, data);
    id.value = grupoM[0];
   
}

function getGrupoM(cod, data) {
    let grupoM;
    for (let dato of data) {
        if (dato[0] === cod) {
            grupoM = dato;
        }
    }

    return grupoM;
}