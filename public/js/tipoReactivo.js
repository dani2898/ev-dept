var tipoPregunta = document.getElementById("tipoPregunta").value;
var edit = document.getElementById("edit").value;


if (edit == "true") {

    var idTema = document.getElementById("idTema").value;
    var idSubtema = document.getElementById("idSubtema").value;
    var idDominio = document.getElementById("idDominio").value;
    var idNivelDominio = document.getElementById("idNivelDominio").value;

    $("#tema").val(idTema);
    $("#subtema").val(idSubtema);
    $("#dominio").val(idDominio);
    $("#nivelDominio").val(idNivelDominio);


    
    switch (tipoPregunta) {
        case "1":
            var respuestaCorrecta = document.getElementById("respuestaCorrecta").value;
            var respuestaIncorrectaB = document.getElementById("incorrectaB").value;
            var respuestaIncorrectaC = document.getElementById("incorrectaC").value;
            var respuestaIncorrectaD = document.getElementById("incorrectaD").value;

            var tipoRespuestas ="<div class='form-group col-sm-12 ' style='margin: 0;'>" +
                "<label for='indicacionPregunta'>RESPUESTAS - INDICAR LA RESPUESTA CORRECTA EN EL INCISO A)</label>" +
                "</div>" +
                "<div class='form-group col-sm-6' style='margin: 0;'>" +
                "<label for='incisoA'>INCISO A)</label>" +
                "<input type='text' name='incisoA' id='incisoA' class='form-control' value='" +respuestaCorrecta +"' required>" +
                "</div>" +
                "<div class='form-group col-sm-6' style='margin: 0;'>" +
                "<label for='incisoB'>INCISO B)</label>" +
                "<input type='text' name='incisoB' id='incisoB' class='form-control' value='" +respuestaIncorrectaB +"' required>" +
                "</div>" +
                "<div class='form-group col-sm-6' style='margin: 0;'>" +
                "<label for='incisoC'>INCISO C)</label>" +
                "<input type='text' name='incisoC' id='incisoC' class='form-control' value='" +respuestaIncorrectaC +"' required>" +
                "</div>" +
                "<div class='form-group col-sm-6' style='margin: 0;'>" +
                "<label for='incisoD'>INCISO D)</label>" +
                "<input type='text' name='incisoD' id='incisoD' class='form-control' value='" +respuestaIncorrectaD +"' required>" +
                "</div>";
            var divInfo = (document.getElementById("respuestas").innerHTML = tipoRespuestas);
            break;

        case "2":
            var verdaderoFalso = document.getElementById("verdaderoFalso").value;
            if(verdaderoFalso=="Verdadero")
            var tipoRespuestas =
                "<div class='form-group col-sm-12' style='margin: 0;'>" +
                "<label for='indicacionPregunta'>RESPUESTAS - SELECCIONAR SI LA AFIRMACIÓN ES VERDADERA O FALSA</label>" +
                "</div>" +
                "<div class='form-group col-sm-6' style='margin: 0;' >" +
                "<input type='radio' name='verdaderoFalso' id='Verdadero' value='Verdadero' checked>" +
                "<label class='px-3' for='Verdadero' >Verdadero</label>" +
                "</div>" +
                "<div class='form-group col-sm-6' style='margin: 0;' class='px-3' >" +
                "<input type='radio' name='verdaderoFalso' id='Falso' value='Falso' >" +
                "<label class='px-3' for='Falso'> Falso</label>" +
                "</div>";
                else{
                    var tipoRespuestas =
                "<div class='form-group col-sm-12' style='margin: 0;'>" +
                "<label for='indicacionPregunta'>RESPUESTAS - SELECCIONAR SI LA AFIRMACIÓN ES VERDADERA O FALSA</label>" +
                "</div>" +
                "<div class='form-group col-sm-6' style='margin: 0;'>" +
                "<input type='radio' name='verdaderoFalso' id='Verdadero' value='Verdadero' class='px-3'>" +
                "<label class='px-3' for='Verdadero'>Verdadero</label>" +
                "</div>" +
                "<div class='form-group col-sm-6' style='margin: 0;'>" +
                "<input type='radio' name='verdaderoFalso' id='Falso' value='Falso' checked>" +
                "<label class='px-3' for='Falso'> Falso</label>" +
                "</div>";
                }
            var divInfo = (document.getElementById( "respuestas").innerHTML = tipoRespuestas);
            break;

        case "3":
            var relacionColumna = document.getElementById("relacionColumna").value;
            var tipoRespuestas =
                "<div class='form-group col-sm-12' style='margin: 0;'>" +
                "<label for='indicacionPregunta'>RESPUESTA</label>" +
                "</div>" +
                "<div class='form-group col-sm-12' style='margin: 0;'>" +
                "<input type='text' name='respuestaColumna' class='form-control' id='respuestaColumna' value='"+relacionColumna+"' required>" +
                "</div>";
            var divInfo = (document.getElementById(
                "respuestas"
            ).innerHTML = tipoRespuestas);
            break;
    }
} else {
    var arrayPreguntas = [];

    switch (tipoPregunta) {
        case "1":
            var tipoRespuestas =
                "<div class='form-group col-sm-12 ' style='margin: 0;'>" +
                "<label for='indicacionPregunta'>RESPUESTAS - INDICAR LA RESPUESTA CORRECTA EN EL INCISO A)</label>" +
                "</div>" +
                "<div class='form-group col-sm-6' style='margin: 0;'>" +
                "<label for='incisoA'>INCISO A)</label>" +
                "<input type='text' name='incisoA' id='incisoA' class='form-control' required>" +
                "</div>" +
                "<div class='form-group col-sm-6' style='margin: 0;'>" +
                "<label for='incisoB'>INCISO B)</label>" +
                "<input type='text' name='incisoB' id='incisoB' class='form-control' required>" +
                "</div>" +
                "<div class='form-group col-sm-6' style='margin: 0;'>" +
                "<label for='incisoC'>INCISO C)</label>" +
                "<input type='text' name='incisoC' id='incisoC' class='form-control' required>" +
                "</div>" +
                "<div class='form-group col-sm-6' style='margin: 0;'>" +
                "<label for='incisoD'>INCISO D)</label>" +
                "<input type='text' name='incisoD' id='incisoD' class='form-control' required>" +
                "</div>";
            var divInfo = (document.getElementById(
                "respuestas"
            ).innerHTML = tipoRespuestas);
            break;

        case "2":
            var tipoRespuestas =
                "<div class='form-group col-sm-12' style='margin: 0;'>" +
                "<label for='indicacionPregunta'>RESPUESTAS - SELECCIONAR SI LA AFIRMACIÓN ES VERDADERA O FALSA</label>" +
                "</div>" +
                "<div class='form-group col-sm-6' style='margin: 0;'>" +
                "<input type='radio' name='verdaderoFalso' id='Verdadero' value='Verdadero'>" +
                "<label class='px-3' for='Verdadero'>Verdadero</label>" +
                "</div>" +
                "<div class='form-group col-sm-6' style='margin: 0;'>" +
                "<input type='radio' name='verdaderoFalso' id='Falso' value='Falso' >" +
                "<label class='px-3' for='Falso'> Falso</label>" +
                "</div>";
            var divInfo = (document.getElementById(
                "respuestas"
            ).innerHTML = tipoRespuestas);
            break;

        case "3":
            var tipoRespuestas =
                "<div class='form-group col-sm-12' style='margin: 0;'>" +
                "<label for='indicacionPregunta'>RESPUESTA</label>" +
                "</div>" +
                "<div class='form-group col-sm-12' style='margin: 0;'>" +
                "<input type='text' name='respuestaColumna' class='form-control' id='respuestaColumna'  required>" +
                "</div>";
            var divInfo = (document.getElementById(
                "respuestas"
            ).innerHTML = tipoRespuestas);
            break;
    }
}
