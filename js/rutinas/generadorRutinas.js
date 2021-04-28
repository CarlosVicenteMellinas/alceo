const select = document.getElementById("ejercicio");
const dificultad = document.getElementById("dificultadText");


function changeValues(data, data2 ,data3 ,data4, data5) {
    let cod = select.value;
    let ejercicio = getEjercicio(cod, data);
    dificultad.textContent = 'Dificultad: '+ejercicio[2];

    $("#gm").empty();
    $("#mat").empty();
    let codGM = getGM(cod, data3);
    let codMat = getMat(cod, data5);
    setGM(codGM, data2);
    setMat(codMat, data4);
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

function setGM(cod, data) {
    
    for (let co of cod) {
        for (let dato of data) {
            if (dato[0] == co) {
                anyadirG2M(dato[0], dato[1]);
            }
        }
    }
}

function getGM(cod, data) {
    let codGM = [];

    for (let dato of data) {
        if (dato[0] == cod) {
            codGM.push(dato[1])
        }
    }
    return codGM;
}

function setMat(cod, data) {
    
    for (let co of cod) {
        for (let dato of data) {
            if (dato[0] == co) {
                anyadirMaterial2(dato[0], dato[1]);
            }
        }
    }
}

function getMat(cod, data) {
    let codMat = [];

    for (let dato of data) {
        if (dato[0] == cod) {
            codMat.push(dato[1])
        }
    }
    return codMat;

}

function anyadirG2M(cod, name) {
    let htmlGM = `<div class="selectMaterial" data-value="${cod}">${name}</div>`;
    $("#gm").append(htmlGM);
    
}

function anyadirMaterial2(cod, name) {
    let htmlMat = `<div class="selectMaterial"  data-value="${cod}">${name}</div>`;
    $("#mat").append(htmlMat);
   
}

$(document).ready(function () {
    $("#popup-close").click(() => {
        $("#popup-wrapper").css("display", "none");
    });

    $("#popup-wrapper").click((e) => {
    if (e.target.className === "popup-wrapper") {
        $("#popup-wrapper").css("display", "none");
    }
    });

    $("#popup").click((ev) => {
        ev.stopPropagation();
    });

    $("body").click(() => {
        $("#popup-wrapper").css("display", "none");
    });

    $("#botonAnyadir").click((ev) => {
        ev.stopPropagation();
        $("#popup-wrapper").css("display", "block");
    });
});