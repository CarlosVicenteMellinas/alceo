const select = document.getElementById("ejercicio");
const nombre = document.getElementById("nombre");
const dificultad = document.getElementById("dificultad");
const id = document.getElementById("id");
const nombre2 = document.getElementById("nombre2");

var Gbar, Mbar;

function changeValues(data, data2 ,data3 ,data4, data5) {
    let cod = select.value;
    let ejercicio = getEjercicio(cod, data);
    id.value = ejercicio[0];
    nombre.value = ejercicio[1];
    nombre2.value = ejercicio[1];
    dificultad.value = ejercicio[2];

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
    let htmlGM = `<input type="text" class="selectGM" readonly 
    value="${cod}:${name}"
    name="grupoM-${cod}"</div>`;
    $("#gm").append(htmlGM);
    $(".selectGM").click(function () { $(this).remove()});
}

function anyadirMaterial2(cod, name) {
    let htmlMat = `<input type="text" class="selectMaterial" readonly 
    value="${cod}:${name}"
    name="material-${cod}"</div>`;
    $("#mat").append(htmlMat);
    $(".selectMaterial").click(function () { $(this).remove()});
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

function anyadirMaterial(material) {
    let htmlMaterial = `<input type="text" class="selectMaterial" readonly 
    value="${material.dataset.value}:${material.textContent}"
    name="material-${material.dataset.value}"</div>`;
    $("#mat").append(htmlMaterial);
    $(".selectMaterial").click(function () { $(this).remove()});
}

function buscarMaterial() {
    let nombreBuscar = $("#material").val().toLowerCase();
    $("#ddmaterial .materiales").each(function () {
        $("#ddmaterial").css("display", "initial");
        if ($(this).text().toLowerCase().startsWith(nombreBuscar) && $(this).data("disabled") != "true") {
            $(this).css("display", "flex");
        } else {
            $(this).css("display", "none");
        }
    });
}

function mostrarMaterial() {
    $("#ddmaterial").css("display", "initial");
    $(".materiales").css("display", "flex");
    $(".materiales").data("disabled", "false");
    let materiales = [];

    $("#mat .selectMaterial").each(function () {
        let material = $(this).val().split(':')[1];
        $("#ddmaterial .materiales").each(function () {
            if ($(this).text() === material) {
                materiales.push($(this));
            }
        });
    })

    for (let material of materiales) {
        material.css("display", "none");
        material.data("disabled", "true");
    }
}

$(document).ready(function() {
    Gbar = document.getElementById("grupoM");
    Mbar = document.getElementById("material");

    $(".gruposM").click((ev) => (anyadirGM(ev.target)));
    $(".materiales").click((ev) => (anyadirMaterial(ev.target)));
    $("body").click((ev) => {
        if (ev.target == Gbar )  {
            mostrarGM();
        } else if (ev.target == Mbar) {
            mostrarMaterial();
        }else { 
            $("#ddgrupoM").css("display", "none");
            $("#ddmaterial").css("display", "none");
        }
    });

    $(document).on(
        {
          focus: () => mostrarGM(),
        },
        "#grupoM",
        {
            focus: () => mostrarMaterial(),
        },
        "#material",
    );
});