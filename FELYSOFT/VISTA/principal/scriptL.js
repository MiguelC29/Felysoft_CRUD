document.addEventListener('DOMContentLoaded', function () {
    //LIBROS
    // Obtén el botón "Agregar Libro" y el formulario
    const mostrarFormularioBtn = document.getElementById('mostrarFormularioLibros');
    const formularioAgregarLibros = document.getElementById('formularioAgregarLibros');
    // Obtén el botón "Cerrar" del formulario
    const cerrarFormularioBtn = document.getElementById('cerrarFormularioL');
      //AUTORES
      const agregarAutorBtn = document.getElementById('mostrarFormuAutorbtn');
      const formularioAgregarAutor = document.getElementById('formularioAgregarAutor');
      const cerrarFormularioAutorBtn = document.getElementById('cerrarFormularioA');
      const overlay = document.createElement('div');
      overlay.className = 'overlay'; 

    // Agrega un evento click al botón "Agregar Libro"
    mostrarFormularioBtn.addEventListener('click', function () {
        // Muestra el formulario al hacer clic en el botón
        document.body.appendChild(overlay);
        formularioAgregarLibros.style.display = 'block';
    });
       // Agrega un evento click al botón "Cerrar" del formulario
       cerrarFormularioBtn.addEventListener('click', function () {
        // Oculta el formulario al hacer clic en el botón "Cerrar"
        document.body.removeChild(overlay);
        formularioAgregarLibros.style.display = 'none';
        event.preventDefault();
    });
   
    agregarAutorBtn.addEventListener('click', function () {
        document.body.appendChild(overlay);
        formularioAgregarAutor.style.display = 'block';
    });

    cerrarFormularioAutorBtn.addEventListener('click', function () {
        document.body.removeChild(overlay);
        formularioAgregarAutor.style.display = 'none';
        event.preventDefault();
    });
});