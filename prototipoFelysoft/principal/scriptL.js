document.addEventListener('DOMContentLoaded', function () {
    // Obtén el botón "Agregar Libro" y el formulario
    var mostrarFormularioBtn = document.getElementById('mostrarFormulario');
    var formularioAgregarLibros = document.getElementById('formularioAgregarLibros');
    
    // Agrega un evento click al botón "Agregar Libro"
    mostrarFormularioBtn.addEventListener('click', function () {
        // Muestra el formulario al hacer clic en el botón
        formularioAgregarLibros.style.display = 'block';
    });
    
    // Obtén el botón "Cerrar" del formulario
    var cerrarFormularioBtn = document.getElementById('cerrarFormulario');
    
    // Agrega un evento click al botón "Cerrar" del formulario
    cerrarFormularioBtn.addEventListener('click', function () {
        // Oculta el formulario al hacer clic en el botón "Cerrar"
        formularioAgregarLibros.style.display = 'none';
    });
});
