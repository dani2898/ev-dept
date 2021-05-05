$("#tema").change(function () {
    var idTema = $(this).val();
    var urlForm =  $("a[name=urlForm]").attr('href');
    if (idTema) {
        $.ajax({
            type: "GET",
            url: urlForm+"?idTema=" + idTema,
            success: function (res) {
                if (res) {
                    $("#subtema").empty();
                    $("#subtema").append('<option value="" disabled selected hidden>Seleccionar una opción</option>');
                    $.each(res, function (key, value) {
                        $("#subtema").append(
                            '<option value="' + key + '">' + value + "</option>"
                        );
                    });
                } else {
                    $("#subtema").empty();
                }
            },
        });
    } 
});


$("#dominio").change(function () {
    var idDominio = $(this).val();
    var urlDominio =  $("a[name=urlDominio]").attr('href');
    if (idDominio) {
        $.ajax({
            type: "GET",
            url: urlDominio+"?idDominio=" + idDominio,
            success: function (res) {
                if (res) {
                    $("#nivelDominio").empty();
                    $("#nivelDominio").append('<option value="" disabled selected hidden>Seleccionar una opción</option>');
                    $.each(res, function (key, value) {
                        $("#nivelDominio").append(
                            '<option value="' + key + '">' + value + "</option>"
                        );
                    });
                } else {
                    $("#nivelDominio").empty();
                }
            },
        });
    } 
});
