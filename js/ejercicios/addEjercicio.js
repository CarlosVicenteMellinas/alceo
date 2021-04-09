var Gbar, Mbar;

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
