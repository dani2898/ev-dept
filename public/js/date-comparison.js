$("#btn-nvaEvaluacion").on("click", function (event) {
    if ($(this).closest("form")[0].checkValidity()) {
        event.preventDefault
            ? event.preventDefault()
            : (event.returnValue = false);

        if ($("#inicioRecoleccion").val() > $("#finRecoleccion").val()) {
            alert("Elegir periodo de recolección valido.");
        } else if ($("#inicioAplicacion").val() > $("#finAplicacion").val()) {
            alert("Elegir periodo de aplicación valido.");
        } else {
            $("#formNuevaEvaluacion").submit();
        }
    }
});
