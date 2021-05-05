
function mostrarReactivos(opcionMultiple, verdaderoFalso, relacionColumna, idEvaluacion, idMateriaEvaluacion){

document.getElementById('opcionMultipleTable').innerHTML = opcionMultiple;
document.getElementById('verdaderoFalsoTable').innerHTML = verdaderoFalso;
document.getElementById('relacionColumnaTable').innerHTML = relacionColumna;
var modal = document.getElementById('myModal'); //I am assuming that this actually is unique
var btnContainer = document.getElementById("button-parent");

$("#opcionMultipleInput").attr({
    "max" : opcionMultiple,
    "min" : 0
 });

 $("#verdaderoFalsoInput").attr({
    "max" : verdaderoFalso,
    "min" : 0
 });

 $("#relacionColumnaInput").attr({
   "max" : relacionColumna,
   "min" : 0
});

 $("#idEvaluacionForm").attr({
    "value" : idEvaluacion
 });

 $("#idMateriaEvaluacionForm").attr({
   "value" : idMateriaEvaluacion
});

var span = document.getElementsByClassName("close")[0];

   modal.style.display = "block";

   span.onclick = function() {
      modal.style.display = "none";
  }

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
      if (event.target == modal) {
          modal.style.display = "none";
      }
  }
   // if you need to know which button was pressed then it's e.target
 
}