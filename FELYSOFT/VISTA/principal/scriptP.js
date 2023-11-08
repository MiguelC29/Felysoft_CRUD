document.addEventListener('DOMContentLoaded', function () {
    const agregarProductosBtn = document.getElementById('agregarProductosBtn');
    const formularioAgregarProductos = document.getElementById('formularioAgregarProductos');
    const cerrarFormulario = document.getElementById('cerrarFormulario');
    const overlay = document.createElement('div');
    overlay.className = 'overlay';
  
    agregarProductosBtn.addEventListener('click', function () {
      document.body.appendChild(overlay);
      formularioAgregarProductos.style.display = 'block';
    });
  
    cerrarFormulario.addEventListener('click', function () {
      document.body.removeChild(overlay);
      formularioAgregarProductos.style.display = 'none';
    });
  });
  