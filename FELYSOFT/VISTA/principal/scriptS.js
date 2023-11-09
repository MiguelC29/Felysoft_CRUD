document.addEventListener('DOMContentLoaded', function () {
    var mostrarFormularioBtn = document.getElementById('mostrarFormulario');
    var formularioAgregarServicios = document.getElementById('formularioAgregarServicios');
    
    mostrarFormularioBtn.addEventListener('click', function () {
        formularioAgregarServicios.style.display = 'block';
    });
    
    var cerrarFormularioBtn = document.getElementById('cerrarFormulario');
    
    cerrarFormularioBtn.addEventListener('click', function () {
        formularioAgregarServicios.style.display = 'none';
        event.preventDefault();
    });
});
