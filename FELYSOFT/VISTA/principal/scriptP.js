document.addEventListener('DOMContentLoaded', function () {
    const agregarProductosBtn = document.getElementById('agregarProductosBtn');
    const actualizarProductosBtn = document.getElementById('updateProductbtn');
    // const formularioAgregarProductos = document.getElementById('formularioAgregarProductos');
    // const newProductbtn = document.getElementById('addNewProduct');
    //const cerrarFormulario = document.getElementById('cerrarFormulario');
    const closeForm = document.getElementById('closeForm');
    const formAddProduct = document.getElementById('formAddProduct');
    const formUpdateProduct = document.getElementById('formUpdateProduct');
    
    const overlay = document.createElement('div');
    overlay.className = 'overlay';
  
    agregarProductosBtn.addEventListener('click', function () {
      document.body.appendChild(overlay);
      formAddProduct.style.display = 'block';
    });

    closeForm.addEventListener('click', function () {
      document.body.removeChild(overlay);
      formAddProduct.style.display = 'none';
      event.preventDefault();
    });

    actualizarProductosBtn.addEventListener('click', function () {
      document.body.appendChild(overlay);
      formUpdateProduct.style.display = 'block';
    });

    closeForm.addEventListener('click', function () {
      document.body.removeChild(overlay);
      formUpdateProduct.style.display = 'none';
      event.preventDefault();
    });
  
    // cerrarFormulario.addEventListener('click', function () {
    //   document.body.removeChild(overlay);
    //   formularioAgregarProductos.style.display = 'none';
    //   event.preventDefault();
    // });

    // newProductbtn.addEventListener('click', function () {
    //   formularioAgregarProductos.style.display = 'none';
    //   document.body.appendChild(overlay);
    //   formAddProduct.style.display = 'block';
    // });

  });
  