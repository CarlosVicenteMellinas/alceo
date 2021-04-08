const select = document.getElementById("ejercicio");
const nombre = document.getElementById("nombre");
const dificultad = document.getElementById("dificultad");
const id = document.getElementById("id");

var Gbar, ddgrupoM;

function changeValues(data, data2 ,data3) {
    let cod = select.value;
    let ejercicio = getEjercicio(cod, data);
    id.value = ejercicio[0];
    nombre.value = ejercicio[1];
    dificultad.value = ejercicio[2];

    $("#gm").empty();
    let codGM = getGM(cod, data3);
    setGM(codGM, data2);
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

function anyadirG2M(cod, name) {
    let htmlGM = `<input type="text" class="selectGM" readonly 
    value="${cod}:${name}"
    name="grupoM-${cod}"</div>`;
    $("#gm").append(htmlGM);
    $(".selectGM").click(function () { $(this).remove()});
}

function anyadirGM(gm) {
    let htmlGM = `<input type="text" class="selectGM" readonly 
    value="${gm.dataset.value}:${gm.textContent}"
    name="grupoM-${gm.dataset.value}"</div>`;
    $("#gm").append(htmlGM);
    $(".selectGM").click(function () { $(this).remove()});
}

function buscarGM() {
    let nombreBuscar = $("#grupoM").val().toLowerCase();
    $("#ddgrupoM .gruposM").each(function () {
        $("#ddgrupoM").css("display", "initial");
        if ($(this).text().toLowerCase().startsWith(nombreBuscar) && $(this).data("disabled") != "true") {
            $(this).css("display", "flex");
        } else {
            $(this).css("display", "none");
        }
    });
}

function mostrarGM() {
    $("#ddgrupoM").css("display", "initial");
    $(".gruposM").css("display", "flex");
    $(".gruposM").data("disabled", "false");
    let gruposM = [];

    $("#gm .selectGM").each(function () {
        let grupoM = $(this).val().split(':')[1];
        $("#ddgrupoM .gruposM").each(function () {
            if ($(this).text() === grupoM) {
                gruposM.push($(this));
            }
        });
    })

    for (let grupoM of gruposM) {
        grupoM.css("display", "none");
        grupoM.data("disabled", "true");
    }
}

$(document).ready(function() {
    Gbar = document.getElementById("grupoM");
    ddgrupoM = document.getElementById("ddgrupoM");

    $(".gruposM").click((ev) => (anyadirGM(ev.target)));
    $("body").click((ev) => ev.target == Gbar ? mostrarGM() :  $("#ddgrupoM").css("display", "none"))

    $(document).on(
        {
          focus: () => mostrarGM(),
        },
        "#grupoM",
    );
});