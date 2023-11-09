document.addEventListener('DOMContentLoaded', function () {
    const agregarGastosBtn = document.getElementById('agregarGastosBtn');
    const formularioAgregarGastos = document.getElementById('formularioAgregarGastos');
    const cerrarFormulario = document.getElementById('cerrarFormulario');
    const overlay = document.createElement('div');
    overlay.className = 'overlay';
  
    agregarGastosBtn.addEventListener('click', function () {
      document.body.appendChild(overlay);
      formularioAgregarGastos.style.display = 'block';
    });
  
    cerrarFormulario.addEventListener('click', function () {
      document.body.removeChild(overlay);
      formularioAgregarGastos.style.display = 'none';
      event.preventDefault();
    });
});