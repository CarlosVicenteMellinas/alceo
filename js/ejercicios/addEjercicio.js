var Gbar, ddgrupoM;

function buscar() {
    let nombreBuscar = $("#grupoM").val().toLowerCase();
    $("#ddgrupoM .gruposM").each(function () {
        if (nombreBuscar != "") {
            $("#ddgrupoM").css("display", "initial");
            if ($(this).text().toLowerCase().startsWith(nombreBuscar)) {
                $(this).css("display", "flex");
            } else {
                $(this).css("display", "none");
            }
        } else {
            $("#ddgrupoM").css("display", "none");
        }
    });
}

$(document).ready(function() {

});
