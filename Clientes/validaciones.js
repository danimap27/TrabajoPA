document.addEventListener("DOMContentLoaded", function() {
    var formulario = document.querySelector('form');

    formulario.addEventListener('submit', function(event) {
        if (!validarFormulario()) {
            event.preventDefault();
        }
    });
  
    function validarFormulario() {
        var nombre = document.querySelector('input[name="nombre"]').value;
        var apellido = document.querySelector('input[name="apellido"]').value;
        var dni = document.querySelector('input[name="dni"]').value;
        var idAgente = document.querySelector('input[name="idAgente"]').value;

        if (nombre.trim() === '' || apellido.trim() === '' || dni.trim() === '' || idAgente.trim() === '') {
            alert('Por favor, complete todos los campos del formulario.');
            return false;
        }


        return true;
    }
});
