var Gbar, ddgrupoM;

function anyadirGM(gm) {
    let htmlGM = `<input type="text" class="selectGM" readonly 
    value="${gm.dataset.value}:${gm.textContent}"</div>`;
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
    console.log(gruposM);
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
