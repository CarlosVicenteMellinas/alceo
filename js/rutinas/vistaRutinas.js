function limpiarPopup() {
    repeticiones.value = "";
    series.value = "";
    descanso.value = "";
    dificultad.textContent = "Dificultad:";
    select.value = 0;
}

$(document).ready(function () {
    $("#popup-close").click(() => {
        $("#popup-wrapper").css("display", "none");
        $("#videoEjercicio").css("display", "none");
        $("#imagenEjercicio").css("display", "none");
    });

    $("#popup-wrapper").click((e) => {
    if (e.target.className === "popup-wrapper") {
        $("#popup-wrapper").css("display", "none");
        $("#videoEjercicio").css("display", "none");
        $("#imagenEjercicio").css("display", "none");
    }
    });

    $("#popup").click((ev) => {
        ev.stopPropagation();
    });

    $("body").click(() => {
        $("#popup-wrapper").css("display", "none");
        $("#videoEjercicio").css("display", "none");
        $("#imagenEjercicio").css("display", "none");
    });

    $(".multimedia-activo.fa-file-video").click(function (ev) {
        ev.stopPropagation();
        $("#popup-wrapper").css("display", "block");
        $("#videoEjercicio").css("display", "block");
        $("#videoEjercicio").attr("src", "/video/ejercicio/" + $(this).data("value"));
    });

    $(".multimedia-activo.fa-image").click(function (ev) {
        ev.stopPropagation();
        $("#popup-wrapper").css("display", "block");
        $("#imagenEjercicio").css("display", "block");
        $("#imagenEjercicio").attr("src", "/images/ejercicio/" + $(this).data("value"));
    });

});