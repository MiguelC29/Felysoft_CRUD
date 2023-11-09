document.addEventListener('DOMContentLoaded', function () {
    const agregarProductosBtn = document.getElementById('agregarProductosBtn');
    const formularioAgregarProductos = document.getElementById('formularioAgregarProductos');
    const cerrarFormulario = document.getElementById('cerrarFormulario');
    const closeForm = document.getElementById('closeForm');
    
    const newProductbtn = document.getElementById('addNewProduct');
    const formAddProduct = document.getElementById('formAddProduct');

    const overlay = document.createElement('div');
    overlay.className = 'overlay';
  
    agregarProductosBtn.addEventListener('click', function () {
      document.body.appendChild(overlay);
      formularioAgregarProductos.style.display = 'block';
    });
  
    cerrarFormulario.addEventListener('click', function () {
      document.body.removeChild(overlay);
      formularioAgregarProductos.style.display = 'none';
      event.preventDefault();
    });

    newProductbtn.addEventListener('click', function () {
      formularioAgregarProductos.style.display = 'none';
      document.body.appendChild(overlay);
      formAddProduct.style.display = 'block';
    });

    closeForm.addEventListener('click', function () {
      document.body.removeChild(overlay);
      formAddProduct.style.display = 'none';
      event.preventDefault();
    });

  });
  