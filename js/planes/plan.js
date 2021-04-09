const select = document.getElementById("plan");
const nombre = document.getElementById("nombre");
const precio = document.getElementById("precio");
const id = document.getElementById("id");
const nombre2 = document.getElementById("nombre2");

function changeValues(data) {
    let cod = select.value;
    let plan = getPlan(cod, data);
    id.value = plan[0];
    nombre.value = plan[1];
    nombre2.value = plan[1];
    precio.value = plan[2];
}

function setID(data) {
    let cod = select.value;
    let plan = getPlan(cod, data);
    id.value = plan[0];
   
}

function getPlan(cod, data) {
    let plan;
    for (let dato of data) {
        if (dato[0] === cod) {
            plan = dato;
        }
    }

    return plan;
}