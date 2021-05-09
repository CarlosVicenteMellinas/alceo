function enviarFormulario(form) {
    form.submit();
}

$(document).ready(function () {
    $(".botonRutina div").click((ev) => {
        ev.stopPropagation();
        enviarFormulario(ev.target.parentNode);
    });

    $(".botonRutina h3").click((ev) => {
        ev.stopPropagation();
        enviarFormulario(ev.target.parentNode.parentNode);
    });

    $(".botonRutina i").click((ev) => {
        ev.stopPropagation();
        enviarFormulario(ev.target.parentNode.parentNode);
    });
});