
const botones = document.querySelectorAll('.btnFiltro');
const productos = document.querySelectorAll('.producto');

botones.forEach(boton => {
  boton.addEventListener('click', () => {
    const categoria = boton.getAttribute('data-categoria');

    productos.forEach(producto => {
      if (categoria === 'todos' || producto.getAttribute('data-categoria') === categoria) {
        producto.style.display = 'block';
      } else {
        producto.style.display = 'none';
      }
    });
  });
});
function toggleOtroServicio(select) {
      const otroDiv = document.getElementById('otro-servicio-div');
      const otroInput = document.getElementById('otro_servicio');
      if (select.value === 'Otro') {
        otroDiv.style.display = 'block';
        otroInput.required = true;
      } else {
        otroDiv.style.display = 'none';
        otroInput.required = false;
        otroInput.value = ''; // limpiar si cambia de opción
      }
    }