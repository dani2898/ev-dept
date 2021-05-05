$("#btn-agregarPregunta").on("click", function (event) {
    const tipoPregunta = document.querySelector("#tipoPregunta");
    const listadoPreguntas = document.querySelector("#preguntasCapturadas");
    const inputPreguntas = document.querySelector("#inputPreguntas");

    if ($(this).closest("form")[0].checkValidity()) {
        event.preventDefault
            ? event.preventDefault()
            : (event.returnValue = false);

    agregarPregunta();
}
    
    function agregarPregunta() {

        const pregunta = document.querySelector("#pregunta");
        const dominio = document.querySelector("#dominio");
        const tema = document.querySelector("#tema");
        const subtema = document.querySelector("#subtema");
        const nivelDominio = document.querySelector("#nivelDominio");
        let preguntaObject = {};
        switch (tipoPregunta.value) {
            case "1":
                const incisoA = document.querySelector("#incisoA");
                const incisoB = document.querySelector("#incisoB");
                const incisoC = document.querySelector("#incisoC");
                const incisoD = document.querySelector("#incisoD");

                preguntaObject = {
                    pregunta: pregunta.value,
                    respuestas: [
                        incisoA.value,
                        incisoB.value,
                        incisoC.value,
                        incisoD.value,
                    ],
                    dominio: dominio.value,
                    tema: tema.value,
                    subtema: subtema.value,
                    nivelDominio:  nivelDominio.value
                };
                incisoA.value = "";
                incisoB.value = "";
                incisoC.value = "";
                incisoD.value = "";
                break;
            case "2":
                const verdaderoFalso = document.querySelector(
                    'input[name="verdaderoFalso"]:checked'
                ).value;
                var verdaderoFalsoContrario="";
                if(verdaderoFalso=="Verdadero") {verdaderoFalsoContrario="Falso";}
                else {verdaderoFalsoContrario = "Verdadero";}
                preguntaObject = {
                    pregunta: pregunta.value,
                    respuestas: [
                        verdaderoFalso,
                        verdaderoFalsoContrario
                    ],
                    dominio: dominio.value,
                    tema: tema.value,
                    subtema: subtema.value,
                    nivelDominio: nivelDominio.value
                };
                if (verdaderoFalso == "Verdadero") {
                    var radioButton = document.getElementById("Verdadero");
                    radioButton.checked = false;
                } else {
                    var radioButton = document.getElementById("Falso");
                    radioButton.checked = false;
                }
                break;
            case "3":
                const respuestaColumna = document.querySelector(
                    "#respuestaColumna"
                );
                preguntaObject = {
                    pregunta: pregunta.value,
                    respuestas: respuestaColumna.value,
                    dominio: dominio.value,
                    tema: tema.value,
                    subtema: subtema.value,
                    nivelDominio: nivelDominio.value
                };
                respuestaColumna.value = "";
                break;
        }
        pregunta.value = "";
        dominio.value = "";
        tema.value = "";
        subtema.value = "";
        nivelDominio.value = "";

        arrayPreguntas.push(preguntaObject);
        mostrarPreguntas();
       

    }

    function mostrarPreguntas() {
        const ultimoRegistro = arrayPreguntas[arrayPreguntas.length - 1];
        const trPregunta = document.createElement("tr");
        const tdNumero = document.createElement("td");
        const tdPregunta = document.createElement("td");
        const tdRespuesta = document.createElement("td");

        tdNumero.innerText = arrayPreguntas.length;
        tdPregunta.innerText = ultimoRegistro.pregunta;
        if (tipoPregunta.value == "1" || tipoPregunta.value == "2") {
            tdRespuesta.innerText = ultimoRegistro.respuestas[0];
        } else {
            tdRespuesta.innerText = ultimoRegistro.respuestas;
        }

        trPregunta.appendChild(tdNumero);
        trPregunta.appendChild(tdPregunta);
        trPregunta.appendChild(tdRespuesta);

        listadoPreguntas.appendChild(trPregunta);
    }

});


$("#btnCapturas").on("click", function (event) {
    event.preventDefault();
    let mat_ev_id = $("input[name=mat_ev_id]").val();
    let tipoPregunta = $("input[name=tipoPregunta]").val();
    let arrayCapturas = arrayPreguntas;
    var urlguardarReactivos =  $("a[name=urlGuardarReactivos]").attr('href');
    $.ajax({
      url: urlguardarReactivos,
      type:"POST",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data:{
        mat_ev_id: mat_ev_id,
        tipoPregunta:tipoPregunta,
        arrayCapturas:arrayCapturas
      },
      dataType: "json",
      success: function(res){
         window.location=res.url;
      },
     });
});
