document.addEventListener('DOMContentLoaded', function () {
    // Obtén el botón "Crear Servicio" y el formulario
    var mostrarFormularioBtn = document.getElementById('mostrarFormulario');
    var formularioAgregarServicios = document.getElementById('formularioAgregarServicios');
    
    // Agrega un evento click al botón "Crear Servicio"
    mostrarFormularioBtn.addEventListener('click', function () {
        // Muestra el formulario al hacer clic en el botón
        formularioAgregarServicios.style.display = 'block';
    });
    
    // Obtén el botón "Cerrar" del formulario
    var cerrarFormularioBtn = document.getElementById('cerrarFormulario');
    
    // Agrega un evento click al botón "Cerrar" del formulario
    cerrarFormularioBtn.addEventListener('click', function () {
        // Oculta el formulario al hacer clic en el botón "Cerrar"
        formularioAgregarServicios.style.display = 'none';
    });
});
