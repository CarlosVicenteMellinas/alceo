const select = document.getElementById("ejercicio");
const dificultad = document.getElementById("dificultadText");
const repeticiones = document.getElementById("repeticiones");
const series = document.getElementById("series");
const descanso = document.getElementById("descanso");
const dificultad2 = document.getElementById("dificultad");
const duracion = document.getElementById("duracion");

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

function comprobarDatos() {
    valido = true;
    if (repeticiones.value === '') {
        valido = false;
    } else if (series.value === '') {
        valido = false;
    } else if (descanso.value === '') {
        valido = false;
    } else if (select.value === 'No seleccionado') {
        valido = false;
    }

    return valido;
}

function getSelectedEjercicio() {
    for (let option of select.children) {
        if (option.value === select.value) {
            return option.textContent;
        }
    }
}

function anyadirEjercicio() {
    let ejercicio = getSelectedEjercicio();
    let numEjercicios = 1;

    $("#ejerciciosAnyadidosDiv .ejerciciosAnyadidos").each(function() {
        numEjercicios++;
    });

    let htmlEjer = '<div class="ejerciciosAnyadidos">'+
        '<input type="hidden" value="'+ select.value +'" name="ejercicio-'+numEjercicios+'">'+
        '<input type="hidden" value="'+ repeticiones.value +'" name="repes-'+numEjercicios+'">'+
        '<input type="hidden" value="'+ series.value +'" name="series-'+numEjercicios+'">'+
        '<input type="hidden" value="'+ descanso.value +'" name="duracion-'+numEjercicios+'">'+
        '<p class="tituloEjer">'+ ejercicio +'</p>'+
        '<div><p>Repeticones</p><p>'+ repeticiones.value +' </p></div>'+
        '<div><p>Series</p><p>'+ series.value +'</p></div>'+
        '<div><p>Descanso</p><p>'+ descanso.value  +'"</p></div>'+
        '<div><p>Dificultad</p><p>'+ dificultad.textContent.split(':')[1] +'</p></div>'+
        '<div class="iconos-generador"><i class="far fa-edit ocultar editarEjercicio"></i><i class="far fa-trash-alt ocultar borrarEjercicio"></i></div>'+
    '</div>';
    $("#ejerciciosAnyadidosDiv").append(htmlEjer);

    $(".editarEjercicio").css("cursor", "pointer");
    $(".borrarEjercicio").css("cursor", "pointer");

    $(".editarEjercicio").click((ev) => {
        editarEjercicio(ev.target);
    });

    $(".borrarEjercicio").click((ev) => {
        borrarEjercicio(ev.target);
    });
}

function limpiarPopup() {
    repeticiones.value = "";
    series.value = "";
    descanso.value = "";
    dificultad.textContent = "Dificultad:";
    select.value = 0;
}

function calcularDificultad() {
    let dificultadTotal = 0;
    let ejerciciosTotales = 0;
    let duracionMinimaTotal = 0;

    $("#ejerciciosAnyadidosDiv .ejerciciosAnyadidos").each(function() {
        let datos = [];
        $(this).children("div").each(function () {
            datos.push($(this).children("p:last-of-type").text());
        });
        let duracionMinima = parseInt(datos[2]) * parseInt(datos[1]);
        duracionMinima += parseInt(datos[0]) * 5 * parseInt(datos[1]);
        dificultadTotal += parseInt(datos[3]);
        duracionMinimaTotal += duracionMinima;
        ejerciciosTotales++;
    });
    
    dificultad2.value = Math.floor(dificultadTotal/ejerciciosTotales);
    duracion.value = Math.floor(duracionMinimaTotal/60);
    duracion.min = Math.floor(duracionMinimaTotal/60);
}

function editarEjercicio(ejercicio) {
    console.log(ejercicio);
}

function borrarEjercicio(ejercicio) {
    console.log(ejercicio);
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

    $("#botonAnyadir2").click((ev) => {
        ev.stopPropagation();
        if (comprobarDatos()) {
            $("#popup-wrapper").css("display", "none");
            anyadirEjercicio();
            limpiarPopup();
            calcularDificultad();
        }
    });
});