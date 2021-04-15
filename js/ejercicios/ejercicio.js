const select = document.getElementById("ejercicio");
const id = document.getElementById("id");
const foto = document.getElementById("foto");
const video = document.getElementById("video");

function setID(data) {
    let cod = select.value;
    let ejercicio = getEjercicio(cod, data);
    id.value = ejercicio[0];
    
    if(!ejercicio[3]) {
        foto.value = '';
    } else {
        foto.value = ejercicio[3];
    }

    if(!ejercicio[4]) {
        video.value = '';
    } else {
        video.value = ejercicio[4];
    }
}

function getEjercicio(cod, data) {
    let ejercicio;
    for (let dato of data) {
        if (dato[0] === cod) {
            console.log(dato);
            ejercicio = dato;
        }
    }

    return ejercicio;
}