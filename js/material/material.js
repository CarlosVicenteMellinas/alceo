const select = document.getElementById("material");
const nombre = document.getElementById("nombre");
const id = document.getElementById("id");

function changeValues(data) {
    let cod = select.value;
    let material = getMaterial(cod, data);
    id.value = material[0];
    nombre.value = material[1];
}

function setID(data) {
    let cod = select.value;
    let material = getMaterial(cod, data);
    id.value = material[0];
   
}

function getMaterial(cod, data) {
    let material;
    for (let dato of data) {
        if (dato[0] === cod) {
            material = dato;
        }
    }

    return material;
}